<?php

namespace App\Services;

use App\Enums\BillingCycle;
use App\Enums\UserSubscriptionStatus;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SubscriptionService
{
    /**
     * Create a new user subscription
     */
    public function createSubscription(
        User $user,
        Plan $plan,
        BillingCycle $billingCycle,
        ?string $processorCode = null,
        ?string $processorToken = null
    ): UserSubscription {


        $expiresAt = now()->addDays($billingCycle->durationInDays());

        $subscription = UserSubscription::create([
            'plan_id' => $plan->id,
            'user_id' => $user->id,
            'billing_cycle' => $billingCycle,
            'purchased_at' => now(),
            'expires_at' => $expiresAt,
            'status' => UserSubscriptionStatus::PENDING,
            'processor_subscription_code' => $processorCode,
            'processor_email_token' => $processorToken,
        ]);

        Log::info("Subscription created", [
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'subscription_id' => $subscription->id,
        ]);

        return $subscription;
    }

    /**
     * Activate a subscription (after successful payment)
     */
    public function activateSubscription(User $user,UserSubscription $subscription): void
    {

      // Check if user already has an active subscription
        $existingSubscription = $user->subscriptions()
            ->where('status', UserSubscriptionStatus::ACTIVE)
            ->first();

        if ($existingSubscription) {
            // Upgrade or switch plan
            $existingSubscription->update([
                'status' => UserSubscriptionStatus::CANCELLED,
            ]);
        }

        $subscription->update([
            'status' => UserSubscriptionStatus::ACTIVE,
        ]);

        Log::info("Subscription activated", [
            'subscription_id' => $subscription->id,
            'user_id' => $subscription->user_id,
        ]);
    }

    /**
     * Cancel a subscription
     */
    public function cancelSubscription(UserSubscription $subscription): void
    {
        $subscription->update([
            'status' => UserSubscriptionStatus::CANCELLED,
        ]);

        Log::info("Subscription cancelled", [
            'subscription_id' => $subscription->id,
            'user_id' => $subscription->user_id,
        ]);
    }

    /**
     * Get the user's current active subscription
     */
    public function getActiveSubscription(User $user): ?UserSubscription
    {
        return $user->subscriptions()
            ->where('status', UserSubscriptionStatus::ACTIVE)
            ->where('expires_at', '>', now())
            ->first();
    }

    /**
     * Check if user has access to a feature on their current plan
     */
    public function userHasFeature(User $user, string $feature): bool
    {
        $subscription = $this->getActiveSubscription($user);

        if (!$subscription) {
            // User has free tier if no active subscription
            $freePlan = Plan::where('tier', 'free')->first();
            if ($freePlan) {
                return $freePlan->hasFeature($feature);
            }
            return false;
        }

        return $subscription->plan->hasFeature($feature);
    }

    /**
     * Get user's feature limit on current plan
     */
    public function getUserFeatureLimit(User $user, string $feature): int|bool
    {
        $subscription = $this->getActiveSubscription($user);

        if (!$subscription) {
            $freePlan = Plan::where('tier', 'free')->first();
            if ($freePlan) {
                return $freePlan->getFeatureLimit($feature);
            }
            return 0;
        }

        return $subscription->plan->getFeatureLimit($feature);
    }

    /**
     * Get available plans for purchase
     */
    public function getAvailablePlans(): array
    {
        $plans = Plan::active()->get();
        $grouped = [];

        foreach ($plans as $plan) {
            if (!isset($grouped[$plan->tier])) {
                $grouped[$plan->tier] = [];
            }
            $grouped[$plan->tier][] = $plan;
        }

        return $grouped;
    }

    /**
     * Get plan pricing for a specific tier and cycle
     */
    public function getPlanPricing(string $tier, BillingCycle $cycle): ?array
    {
        $plan = Plan::where('tier', $tier)
            ->where('billing_cycle', $cycle->value)
            ->active()
            ->first();

        if (!$plan) {
            return null;
        }

        $config = $plan->getConfig();
        $pricing = $config['pricing'][$cycle->value] ?? null;

        if (!$pricing) {
            return null;
        }

        return array_merge($pricing, [
            'plan_id' => $plan->id,
            'tier' => $tier,
            'billing_cycle' => $cycle->value,
        ]);
    }

    /**
     * Check if subscription is within grace period
     */
    public function isWithinGracePeriod(UserSubscription $subscription): bool
    {
        return $subscription->isWithinGracePeriod();
    }

    /**
     * Handle subscription expiration
     */
    public function handleExpiredSubscriptions(): void
    {
        $graceDays = config('plans.grace_period_days', 7);
        $gracePeriodEnd = now()->subDays($graceDays);

        // Find subscriptions that have expired beyond the grace period
        $expiredSubscriptions = UserSubscription::where('expires_at', '<', $gracePeriodEnd)
            ->where('status', UserSubscriptionStatus::ACTIVE)
            ->get();

        foreach ($expiredSubscriptions as $subscription) {
            $subscription->update([
                'status' => UserSubscriptionStatus::EXPIRED,
            ]);

            Log::info("Subscription marked as expired", [
                'subscription_id' => $subscription->id,
                'user_id' => $subscription->user_id,
            ]);
        }
    }

    /**
     * Renew a subscription (for auto-renewal)
     */
    public function renewSubscription(UserSubscription $subscription): bool
    {
        try {
            $daysToAdd = $subscription->billing_cycle->durationInDays();
            $newExpiresAt = $subscription->expires_at->addDays($daysToAdd);

            $subscription->update([
                'expires_at' => $newExpiresAt,
                'status' => UserSubscriptionStatus::RENEWED,
            ]);

            Log::info("Subscription renewed", [
                'subscription_id' => $subscription->id,
                'user_id' => $subscription->user_id,
                'new_expires_at' => $newExpiresAt,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error("Failed to renew subscription", [
                'subscription_id' => $subscription->id,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Get subscription renewal date
     */
    public function getNextRenewalDate(UserSubscription $subscription): Carbon
    {
        return $subscription->expires_at->copy();
    }

    /**
     * Validate if user can access a resource based on their subscription
     */
    public function validateUserAccess(User $user, string $requiredFeature): bool
    {
        return $this->userHasFeature($user, $requiredFeature);
    }

    /**
     * Get user's tier name (for display)
     */
    public function getUserTierName(User $user): string
    {
        $subscription = $this->getActiveSubscription($user);

        if (!$subscription) {
            return 'Free';
        }

        return $subscription->plan->getConfig()['name'] ?? 'Unknown';
    }

    /**
     * Calculate subscription statistics
     */
    public function getSubscriptionStats(): array
    {
        return [
            'total_active' => UserSubscription::where('status', UserSubscriptionStatus::ACTIVE)->count(),
            'total_expired' => UserSubscription::where('status', UserSubscriptionStatus::EXPIRED)->count(),
            'total_pending' => UserSubscription::where('status', UserSubscriptionStatus::PENDING)->count(),
            'total_cancelled' => UserSubscription::where('status', UserSubscriptionStatus::CANCELLED)->count(),
            'expiring_soon' => UserSubscription::where('status', UserSubscriptionStatus::ACTIVE)
                ->where('expires_at', '>', now())
                ->where('expires_at', '<', now()->addDays(7))
                ->count(),
        ];
    }

    public function revertToFreeWhenError(User $user){
        // Mark all pending subscriptions as failed
        $user->subscriptions()
            ->where('status', UserSubscriptionStatus::PENDING)
            ->update([
                'status' => UserSubscriptionStatus::FAILED,
            ]);

        // Get the free plan
        $freePlan = Plan::where('price', null)
            ->where('billing_cycle', BillingCycle::YEARLY)
            ->first();

        if ($freePlan) {
            // Create and activate a free subscription for the user
            $freeSubscription = $this->createSubscription(
                $user,
                $freePlan,
                BillingCycle::YEARLY
            );

            $this->activateSubscription($user, $freeSubscription);

            Log::info("User reverted to free plan after error", [
                'user_id' => $user->id,
                'free_subscription_id' => $freeSubscription->id,
            ]);
        }
    }
}
