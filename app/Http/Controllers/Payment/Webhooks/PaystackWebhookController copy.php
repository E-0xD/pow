<?php

namespace App\Http\Controllers\Payment\Webhooks;

use App\Enums\PortfolioSubscriptionStatus;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PortfolioSubscription;
use App\Services\CouponService;
use App\Services\EmailService;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class PaystackWebhookController extends Controller
{
    protected $emailService;
    protected $messageService;
    protected $couponService;

    public function __construct()
    {
        $this->emailService = new EmailService();
        $this->messageService = new MessageService(new Agent());
        $this->couponService = new CouponService();
    }

    public function __invoke(Request $request)
    {
        try {
            $data = $request->json()->all();

            Log::info('Paystack Webhook Received:', $data);

            $event = $data['event'] ?? null;
            $payload = $data['data'] ?? [];

            switch ($event) {
                case 'charge.success':
                case 'subscription.create':
                case 'subscription.enable':
                    $subscriptionId = $payload['metadata']['subscription_id'] ?? null;

                    if (!$subscriptionId) {
                        Log::warning('No subscription ID found in metadata.');
                        break;
                    }

                    $portfolioSubscription = PortfolioSubscription::find($subscriptionId);
                    if (!$portfolioSubscription) {
                        Log::warning("PortfolioSubscription {$subscriptionId} not found.");
                        break;
                    }

                    $plan = Plan::find($portfolioSubscription->plan_id);

                    $freeMonths = $payload['metadata']['free_months'] ?? 0;
                    $extraMonths = $payload['metadata']['extra_months'] ?? 0;
                    $expiresDays = (int) $plan->duration + ($extraMonths * 30) + ($freeMonths * 30);

                    $portfolioSubscription->update([
                        'status' => PortfolioSubscriptionStatus::ACTIVE,
                        'purchased_at' => now(),
                        'expires_at' => Carbon::now()->addDays($expiresDays),
                        'processor_subscription_code' => $payload['subscription_code'] ?? null,
                        'processor_email_token' => $payload['email_token'] ?? null
                    ]);

                    // Apply coupon benefits if any
                    $couponCode = $payload['metadata']['coupon_code'] ?? null;
                    if ($couponCode) {
                        $coupon = $this->couponService->findValidCoupon($couponCode);
                        $this->couponService->applyCouponBenefitsToSubscription($coupon, $portfolioSubscription);
                    }

                    if ($portfolioSubscription->transaction) {
                        $portfolioSubscription->transaction->update(['status' => 'Successful']);
                    }

                    // If no subscription_code, it means discounted payment
                    if (!isset($payload['subscription_code'])) {
                        $freeMonths = (int) ($payload['metadata']['free_months'] ?? 0);
                        $extraMonths = (int) ($payload['metadata']['extra_months'] ?? 0);
                        $planDuration = (int) $payload['metadata']['plan_duration'] ?? 30;

                        // Calculate when the NEXT payment should actually occur
                        // This is AFTER the current paid period + free/extra months
                        $startDays = $planDuration; // Start with the plan duration they just paid for

                        if ($freeMonths > 0) {
                            $startDays += $freeMonths * 30;
                        }

                        if ($extraMonths > 0) {
                            $startDays += $extraMonths * 30;
                        }

                        Log::info("Calculated start days: {$startDays}");

                        // The subscription should start AFTER all the benefits
                        $subscriptionStartDate = now()->addDays($startDays);
                        $ISOstartDate = $subscriptionStartDate->toIso8601String(); // Use ISO 8601 format

                        Log::info("Subscription start date: {$ISOstartDate}");

                        $subPayload = [
                            'customer' => $payload['customer']['customer_code'],
                            'plan' => $payload['metadata']['plan_code'],
                            'start_date' => $ISOstartDate,
                        ];

                        $subResponse = Http::withToken(config('paystack.secret'))
                            ->post(config('paystack.url') . 'subscription', $subPayload);

                        Log::info('Subscription creation response', ['response' => $subResponse->json() ?: []]);

                        if ($subResponse->successful()) {
                            $subData = $subResponse->json('data');
                            $portfolioSubscription->update([
                                'processor_subscription_code' => $subData['subscription_code'],
                            ]);
                            Log::info("Subscription created with start date: {$ISOstartDate}, subscription_code: {$subData['subscription_code']}");
                        } else {
                            Log::error('Failed to create subscription', [
                                'response' => $subResponse->json() ?: [],
                                'payload' => $subPayload
                            ]);
                        }
                    }
                    $message = $this->messageService->getPaymentSuccessMessage(
                        $portfolioSubscription->user,
                        $portfolioSubscription->transaction->amount,
                        $portfolioSubscription->transaction->reference,
                        $portfolioSubscription->portfolio->title
                    );

                    $this->emailService->send(
                        $portfolioSubscription->user->email,
                        $message['subject'],
                        $message['payload']
                    );

                    Log::info("Paystack Subscription {$subscriptionId} activated.");
                    break;

                case 'invoice.payment_failed':
                    Log::warning('Subscription payment failed', $payload);
                    break;


                case 'subscription.disable':
                    Log::info('Subscription disabled by Paystack', $payload);
                    break;


                default:
                    Log::info("Unhandled Paystack event: {$event}");
                    break;
            }

            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);
            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        }
    }
}
