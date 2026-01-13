<?php

namespace App\Helpers;

use App\Services\SubscriptionService;
use Illuminate\Support\Facades\Auth;

class SubscriptionHelper
{
    protected static $subscriptionService;

    /**
     * Initialize subscription service
     */
    protected static function service(): SubscriptionService
    {
        if (!self::$subscriptionService) {
            self::$subscriptionService = new SubscriptionService();
        }
        return self::$subscriptionService;
    }

    /**
     * Check if authenticated user has a feature
     */
    public static function userHasFeature(string $feature): bool
    {
        if (!Auth::check()) {
            return false;
        }

        return self::service()->userHasFeature(Auth::user(), $feature);
    }

    /**
     * Get user's feature limit
     */
    public static function getUserFeatureLimit(string $feature): int|bool
    {
        if (!Auth::check()) {
            return 0;
        }

        return self::service()->getUserFeatureLimit(Auth::user(), $feature);
    }

    /**
     * Get current subscription tier name
     */
    public static function getCurrentTier(): string
    {
        if (!Auth::check()) {
            return 'Free';
        }

        return self::service()->getUserTierName(Auth::user());
    }

    /**
     * Get user's active subscription
     */
    public static function getActiveSubscription()
    {
        if (!Auth::check()) {
            return null;
        }

        return self::service()->getActiveSubscription(Auth::user());
    }

    /**
     * Check if user is within grace period
     */
    public static function isWithinGracePeriod(): bool
    {
        $subscription = self::getActiveSubscription();
        if (!$subscription) {
            return false;
        }

        return self::service()->isWithinGracePeriod($subscription);
    }

    /**
     * Get days until subscription expires
     */
    public static function getDaysUntilExpiration(): ?int
    {
        $subscription = self::getActiveSubscription();
        if (!$subscription) {
            return null;
        }

        return $subscription->daysUntilExpiration();
    }

    /**
     * Check if subscription is active
     */
    public static function isSubscriptionActive(): bool
    {
        return self::getActiveSubscription() !== null;
    }

    /**
     * Get all available plans
     */
    public static function getAvailablePlans(): array
    {
        return self::service()->getAvailablePlans();
    }

    /**
     * Get plan pricing
     */
    public static function getPlanPricing(string $tier, $billingCycle): ?array
    {
        return self::service()->getPlanPricing($tier, $billingCycle);
    }
}
