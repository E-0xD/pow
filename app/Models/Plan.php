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
        'tier_id',
        'price',
        'name',
        'description',
        'billing_cycle',
        'duration',
        'is_active',
        'paystack_plan_code',
    ];

    protected $casts = [
        'duration' => 'integer',
        'is_active' => 'boolean',
        'billing_cycle' => BillingCycle::class,
    ];

    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }

    public function userSubscriptions()
    {
        return $this->hasMany(UserSubscription::class);
    }

    /**
     * Check if user has a specific feature for this plan tier
     */
    public function hasFeature(string $feature): bool
    {
        return $this->tier?->hasFeature($feature) ?? false;
    }

    /**
     * Get a feature limit/value for this plan tier
     */
    public function getFeatureLimit(string $feature): int|string|bool|null
    {
        return $this->tier?->getFeatureValue($feature);
    }

    /**
     * Scope to get only active plans
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get plans by billing cycle
     */
    public function scopeByBillingCycle($query, BillingCycle $cycle)
    {
        return $query->where('billing_cycle', $cycle->value);
    }
}