<?php

namespace App\Http\Controllers\Payment\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\PortfolioSubscription;
use App\Models\Plan;
use App\Enums\PortfolioSubscriptionStatus;
use App\Services\EmailService;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class PaystackWebhookController extends Controller
{
    protected $emailService;
    protected $messageService;

    public function __construct()
    {
        $this->emailService = new EmailService();
        $this->messageService = new MessageService(new Agent());
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

                    $portfolioSubscription->update([
                        'status' => PortfolioSubscriptionStatus::ACTIVE,
                        'purchased_at' => now(),
                        'expires_at' => Carbon::now()->addDays((int) $plan->duration),
                        'processor_subscription_code' => $payload['subscription_code'] ?? null,
                        'processor_email_token' => $payload['email_token'] ?? null
                    ]);

                    if ($portfolioSubscription->transaction) {
                        $portfolioSubscription->transaction->update(['status' => 'Successful']);
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
            Log::error($th);
            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        }
    }
}
