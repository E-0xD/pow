<?php

namespace App\Models;

use App\Enums\BillingCycle;
use App\Enums\UserSubscriptionStatus;
use App\Observers\UserSubscriptionObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([UserSubscriptionObserver::class])]
class UserSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id',
        'user_id',
        'billing_cycle',
        'purchased_at',
        'expires_at',
        'status',
        'transaction_id',
        'processor_subscription_code',
        'processor_email_token'
    ];

    protected $casts = [
        'purchased_at' => 'datetime',
        'expires_at' => 'datetime',
        'status' => UserSubscriptionStatus::class,
        'billing_cycle' => BillingCycle::class,
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'payable');
    }

    /**
     * Scope to get active subscriptions only
     */
    public function scopeActive($query)
    {
        return $query->where('status', UserSubscriptionStatus::ACTIVE);
    }

    /**
     * Scope to get expired subscriptions
     */
    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', now());
    }

    /**
     * Check if subscription is expired
     */
    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    /**
     * Check if subscription is within grace period
     */
    public function isWithinGracePeriod(): bool
    {
        $graceDays = config('plans.grace_period_days', 7);
        $gracePeriodEnd = $this->expires_at->addDays($graceDays);
        return now()->lessThanOrEqualTo($gracePeriodEnd);
    }

    /**
     * Get days until expiration
     */
    public function daysUntilExpiration(): int
    {
        if (!$this->expires_at) {
            return 0;
        }
        return (int) now()->diffInDays($this->expires_at, false);
    }

    /**
     * Renew the subscription
     */
    public function renew(?BillingCycle $billingCycle = null): void
    {
        $cycle = $billingCycle ?? $this->billing_cycle;
        $daysToAdd = $cycle->durationInDays();

        $newExpiresAt = $this->expires_at
            ? $this->expires_at->addDays($daysToAdd)
            : now()->addDays($daysToAdd);

        $this->update([
            'expires_at' => $newExpiresAt,
            'status' => UserSubscriptionStatus::RENEWED,
        ]);
    }
}
