<?php

namespace App\Http\Controllers\Payment\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\PortfolioSubscription;
use App\Models\Plan;
use App\Enums\PortfolioStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class PolarWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        // Safely decode incoming JSON
        $data = $request->json()->all();

        // Log for debugging
        Log::info('Polar Webhook received:', $data);

        switch ($data['type'] ?? null) {
            case 'subscription.created':
            case 'subscription.updated':
               
                $subscriptionId = $data['data']['metadata']['uid'] ?? null;
                if (!$subscriptionId) {
                    Log::warning('No subscription UID found in webhook payload.');
                    break;
                }

                $portfolioSubscription = PortfolioSubscription::find($subscriptionId);
                if (!$portfolioSubscription) {
                    Log::warning("PortfolioSubscription not found for UID {$subscriptionId}");
                    break;
                }

                $plan = Plan::find($portfolioSubscription->plan_id);

                $portfolioSubscription->update([
                    'status' => 'active',
                    'purchased_at' => now(),
                    'expires_at' => Carbon::now()->addDays((int) $plan->duration),
                ]);

                if ($portfolioSubscription->transaction) {
                    $portfolioSubscription->transaction->update(['status' => 'Successful']);
                }

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
    }
}
