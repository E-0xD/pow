<?php

namespace App\Models;

use App\Enums\BillingCycle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'tier',
        'price',
        'name',
        'description',
        'benefits',
        'duration',
        'billing_cycle',
        'interval_days',
        'is_active',
        'paystack_plan_code',
    ];

    protected $casts = [
        'benefits' => 'array',
        'duration' => 'integer',
        'interval_days' => 'integer',
        'is_active' => 'boolean',
        'billing_cycle' => BillingCycle::class,
    ];


    public function userSubscriptions()
    {
        return $this->hasMany(UserSubscription::class);
    }

    /**
     * Get plan configuration from config/plans.php
     */
    public function getConfig()
    {
        return config("plans.tiers.{$this->tier}");
    }

    /**
     * Check if user has a specific feature for this plan tier
     */
    public function hasFeature(string $feature): bool
    {
        $config = $this->getConfig();
        return $config['features'][$feature] ?? false;
    }

    /**
     * Get a feature limit/value for this plan tier
     */
    public function getFeatureLimit(string $feature): int|bool
    {
        $config = $this->getConfig();
        return $config['features'][$feature] ?? null;
    }

    /**
     * Check if this is a paid plan
     */
    public function isPaid(): bool
    {
        return $this->getConfig()['is_paid'] ?? false;
    }

    /**
     * Scope to get only active plans
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get plans by tier
     */
    public function scopeByTier($query, string $tier)
    {
        return $query->where('tier', $tier);
    }

    /**
     * Scope to get plans by billing cycle
     */
    public function scopeByBillingCycle($query, BillingCycle $cycle)
    {
        return $query->where('billing_cycle', $cycle->value);
    }
}