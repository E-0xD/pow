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

            Log::info($event);

            if ($event == 'charge.success') {
                $this->handleChargeSuccess($payload);
            };

            if ($event == 'subscription.create') {

                $this->handleSubscriptionActivation($payload);
            }


            // 'subscription.enable'
            // 'invoice.payment_failed'
            // subscription.disable


            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);
            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        }
    }

    /**
     * Handle one-time charge success (discounted/one-time payments)
     */
    protected function handleChargeSuccess(array $payload)
    {
        $subscriptionId = $payload['metadata']['subscription_id'] ?? null;

        if (!$subscriptionId) {
            Log::warning('No subscription ID found in charge.success metadata.');
            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        }

        $portfolioSubscription = PortfolioSubscription::find($subscriptionId);

        if (!$portfolioSubscription) {
            Log::warning("PortfolioSubscription {$subscriptionId} not found.");
            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        }

        $freeMonths = (int) ($payload['metadata']['free_months'] ?? 0);
        $extraMonths = (int) ($payload['metadata']['extra_months'] ?? 0);


        // Update transaction status
        if ($portfolioSubscription->transaction) {
            $portfolioSubscription->transaction->update(['status' => 'Successful']);
        }

        $portfolioSubscription->update([
            'processor_email_token' => $payload['customer']['email']
        ]);

        // Create recurring subscription if this was a discounted payment

        if (!array_key_exists('plan_code', $payload['plan'])) {
            $this->createRecurringSubscription($payload, $freeMonths, $extraMonths);
        }

        // Send success email
        $this->sendPaymentSuccessEmail($portfolioSubscription);

        Log::info("Charge successful for PortfolioSubscription {$subscriptionId}");
    }

    /**
     * Handle subscription activation events (create/enable)
     */
    protected function handleSubscriptionActivation(array $payload)
    {

        $customerEmail = $payload['customer']['email'] ?? null;

        if (!$customerEmail) {
            Log::warning('No email ID found in subscription event metadata.');
            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        }

        $portfolioSubscription = PortfolioSubscription::where('processor_email_token', $customerEmail)->first();
        if (!$portfolioSubscription) {
            Log::warning("PortfolioSubscription not found.");
            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        }


        // Update subscription with Paystack subscription details
        $portfolioSubscription->update([
            'status' => PortfolioSubscriptionStatus::ACTIVE,
            'purchased_at' => now(),
            'expires_at' => Carbon::parse($payload['next_payment_date']),
            'processor_subscription_code' => $payload['subscription_code'] ?? null,
            'processor_email_token' => $payload['email_token'] ?? null
        ]);


        // Update transaction status
        if ($portfolioSubscription->transaction) {
            $portfolioSubscription->transaction->update(['status' => 'Successful']);
        }


        Log::info("Subscription activated via Paystack subscription.");
    }

    /**
     * Create a recurring subscription with delayed start date
     */
    protected function createRecurringSubscription(
        array $payload,
        int $freeMonths,
        int $extraMonths
    ) {
        $planDuration = (int) ($payload['metadata']['plan_duration'] ?? 30);


        $startDays = $planDuration;

        if ($freeMonths > 0) {
            $startDays += $freeMonths * 30;
        }

        if ($extraMonths > 0) {
            $startDays += $extraMonths * 30;
        }

        Log::info("Calculated subscription start days: {$startDays}");

        $subscriptionStartDate = now()->addDays($startDays);
        $ISOstartDate = $subscriptionStartDate->toIso8601String();

        Log::info("Subscription start date: {$ISOstartDate}");

        $subPayload = [
            'customer' => $payload['customer']['customer_code'],
            'plan' => $payload['metadata']['plan_code'],
            'start_date' => $ISOstartDate,
        ];

        $subResponse = Http::withToken(config('paystack.secret'))->post(config('paystack.url') . 'subscription', $subPayload);

        Log::info('Subscription creation request sent');

        if ($subResponse->successful()) {
            Log::info('Subscription creation request successful');
        } else {
            Log::error('Failed to create recurring subscription', [
                'response' => $subResponse->json() ?: [],
                'payload' => $subPayload
            ]);
        }
    }

    /**
     * Send payment success email to user
     */
    protected function sendPaymentSuccessEmail(PortfolioSubscription $portfolioSubscription)
    {
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
    }
}
