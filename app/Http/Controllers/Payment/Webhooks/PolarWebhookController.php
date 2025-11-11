<?php

namespace App\Http\Controllers\Payment\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\PortfolioSubscription;
use App\Models\Plan;
use App\Enums\PortfolioStatus;
use App\Enums\PortfolioSubscriptionStatus;
use App\Services\EmailService;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpFoundation\Response;

class PolarWebhookController extends Controller
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

            // Safely decode incoming JSON
            $data = $request->json()->all();

            // Log for debugging
            Log::info('Polar Webhook received:', $data);

            switch ($data['type'] ?? null) {
                case 'subscription.created':
                case 'subscription.updated':

                    $subscriptionId = $data['data']['metadata']['subscription_id'] ?? null;
                    if (!$subscriptionId) {
                        Log::warning('No subscription Id found in webhook payload.');
                        break;
                    }

                    $portfolioSubscription = PortfolioSubscription::find($subscriptionId);
                    if (!$portfolioSubscription) {
                        Log::warning("PortfolioSubscription not found for Id {$subscriptionId}");
                        break;
                    }

                    $plan = Plan::find($portfolioSubscription->plan_id);

                    $portfolioSubscription->update([
                        'status' => PortfolioSubscriptionStatus::ACTIVE,
                        'purchased_at' => now(),
                        'expires_at' => Carbon::now()->addDays((int) $plan->duration),
                    ]);

                    if ($portfolioSubscription->transaction) {
                        $portfolioSubscription->transaction->update(['status' => 'Successful']);
                    }

                    $message = $this->messageService->getPaymentSuccessMessage($portfolioSubscription->user,$portfolioSubscription->transaction->amount, $portfolioSubscription->transaction->reference,  $portfolioSubscription->portfolio->title);

                    $this->emailService->send(
                        $portfolioSubscription->user->email,
                        $message['subject'],
                        $message['payload']
                    );

                    Log::info("Subscription {$subscriptionId} activated successfully.");
                    break;

                case 'subscription.canceled':
                    // Handle cancellations
                    Log::info('Subscription canceled event received.');
                    break;

                default:
                    Log::info('Unhandled Polar webhook type: ' . ($data['type'] ?? 'unknown'));
                    break;
            }

            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        }
    }
}
