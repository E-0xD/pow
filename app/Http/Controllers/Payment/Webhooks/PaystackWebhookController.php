<?php

namespace App\Http\Controllers\Payment\Webhooks;

use App\Enums\UserSubscriptionStatus;
use App\Http\Controllers\Controller;
use App\Livewire\Subscription\SubscriptionStatus;
use App\Models\UserSubscription;
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

            if ($event == 'charge.success' && !isset($payload['plan']['id'])) {
                $this->handleChargeSuccess($payload);
            }

            if ($event == 'subscription.create') {
                $this->handleSubscriptionActivation($payload);
            }

            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error('Paystack webhook error: ' . $th->getMessage());
            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        }
    }

    /**
     * Handle charge success - both initial purchase and renewals
     * Creates recurring subscription if coupon was applied (charge-only scenario)
     * Also manages subscription statuses: cancels active, fails other pending
     */
    protected function handleChargeSuccess(array $payload)
    {
        $email = $payload['customer']['email'] ?? null;
        $userId = $payload['metadata']['user_id'] ?? null;
        $planCode = $payload['metadata']['plan_code'] ?? null;
        $freeMonths = (int) ($payload['metadata']['free_months'] ?? 0);
        $extraMonths = (int) ($payload['metadata']['extra_months'] ?? 0);

        if (!$email || !$userId) {
            Log::warning('Missing required data in charge.success', [
                'email' => $email,
                'user_id' => $userId
            ]);
            return;
        }

        // Get latest pending subscription for this user
        $subscription = UserSubscription::where('user_id', $userId)
            ->where('status', UserSubscriptionStatus::PENDING)
            ->latest('id')
            ->first();

        // If no pending subscription, get the latest one
        if (!$subscription) {
            $subscription = UserSubscription::where('user_id', $userId)
                ->latest('id')
                ->first();
        }

        // Cancel any active subscriptions for this user
        UserSubscription::where('user_id', $userId)
            ->where('status', UserSubscriptionStatus::ACTIVE)
            ->update(['status' => UserSubscriptionStatus::CANCELLED]);

        // Mark any other pending subscriptions as failed
        UserSubscription::where('user_id', $userId)
            ->where('status', UserSubscriptionStatus::PENDING)
            ->where('id', '!=', $subscription?->id)
            ->update(['status' => UserSubscriptionStatus::FAILED]);

        if (!$subscription) {
            Log::warning("UserSubscription not found for user {$userId}");
            return;
        }

        // Update transaction status
        if ($subscription->transaction) {
            $subscription->transaction->update(['status' => 'Successful']);
        }

        $subscription->update([
            'processor_email_token' => $email
        ]);

        // If coupon was applied, plan_code won't be in the charge payload
        // Create delayed recurring subscription to start after free/extra months
        if ($planCode && ($freeMonths > 0 || $extraMonths > 0)) {
            $this->createRecurringSubscription(
                $payload,
                $planCode,
                $freeMonths,
                $extraMonths
            );
        }

        Log::info("Charge successful for user {$userId}");
    }

    /**
     * Handle subscription activation - triggered after initial charge or Paystack subscription created
     * Also manages subscription statuses: cancels active, fails other pending
     */
    protected function handleSubscriptionActivation(array $payload)
    {
        $email = $payload['customer']['email'] ?? null;
        $subscriptionCode = $payload['subscription_code'] ?? null;
        $nextPaymentDate = $payload['next_payment_date'] ?? null;

        if (!$email || !$subscriptionCode) {
            Log::warning('Missing required data in subscription.create', [
                'email' => $email,
                'subscription_code' => $subscriptionCode
            ]);
            return;
        }

        // Find latest PENDING subscription first
        $subscription = UserSubscription::where('processor_email_token', $email)
            ->where('status', UserSubscriptionStatus::PENDING)
            ->latest('id')
            ->first();

        // If no pending subscription found, try other methods
        if (!$subscription) {
            $subscription = UserSubscription::where('processor_email_token', $email)
                ->orWhere(function ($query) use ($email) {
                    $query->whereHas('user', function ($q) use ($email) {
                        $q->where('email', $email);
                    });
                })
                ->latest('id')
                ->first();
        }

        if ($subscription) {
            // Cancel any active subscriptions for this user
            UserSubscription::where('user_id', $subscription->user_id)
                ->where('status', UserSubscriptionStatus::ACTIVE)
                ->update(['status' => UserSubscriptionStatus::CANCELLED]);

            // Mark any other pending subscriptions as failed
            UserSubscription::where('user_id', $subscription->user_id)
                ->where('status', UserSubscriptionStatus::PENDING)
                ->where('id', '!=', $subscription->id)
                ->update(['status' => UserSubscriptionStatus::FAILED]);
        }

        if (!$subscription) {
            Log::warning("UserSubscription not found for email {$email}");
            return;
        }

        // Calculate expiration date from next payment date
        $expiresAt = $nextPaymentDate ? Carbon::parse($nextPaymentDate) : now()->addMonth();

        // Update subscription with Paystack details
        $subscription->update([
            'status' => UserSubscriptionStatus::ACTIVE,
            'purchased_at' => now(),
            'expires_at' => $expiresAt,
            'processor_subscription_code' => $subscriptionCode,
            'processor_email_token' => $email
        ]);

        if ($subscription->transaction) {
            $subscription->transaction->update(['status' => 'Successful']);
        }

        Log::info("Subscription activated for user {$subscription->user_id}", [
            'expires_at' => $expiresAt,
            'subscription_code' => $subscriptionCode
        ]);
    }

    /**
     * Create delayed recurring subscription (for coupon scenarios)
     * Starts after initial charge + free/extra months
     */
    protected function createRecurringSubscription(
        array $payload,
        string $planCode,
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

        $subscriptionStartDate = now()->addDays($startDays);

        $subPayload = [
            'customer' => $payload['customer']['customer_code'],
            'plan' => $planCode,
            'start_date' => $subscriptionStartDate->toIso8601String(),
        ];

        $response = Http::withToken(config('paystack.secret'))
            ->post(config('paystack.url') . 'subscription', $subPayload);

        if ($response->successful()) {
            Log::info('Recurring subscription created successfully', [
                'subscription_code' => $response->json('data.subscription_code'),
                'start_date' => $subscriptionStartDate
            ]);
        } else {
            Log::error('Failed to create recurring subscription', [
                'response' => $response->json(),
                'payload' => $subPayload
            ]);
        }
    }
}
