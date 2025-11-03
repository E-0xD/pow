<?php

namespace App\Services;

use App\Models\Affiliate;
use App\Models\Transaction;
use App\Models\User;
use App\Models\PortfolioSubscription;
use App\Enums\NotificationType;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Log;

class AffiliateService
{
    public function __construct(protected NotificationService $notifications)
    {
    }

    /**
     * Credit commission for a subscription (first subscription by referred user only)
     */
    public function creditCommissionForSubscription(PortfolioSubscription $subscription): ?Transaction
    {
        $referredUser = $subscription->user;
        if (!$referredUser || !$referredUser->referred_by) return null;

        // ensure first-time commission only
        $exists = Transaction::where('payable_type', User::class)
            ->where('payable_id', $referredUser->id)
            ->where('gateway', 'affiliate')
            ->where('reference', 'commission')
            ->exists();

        if ($exists) return null;

        $affiliateUser = User::find($referredUser->referred_by);
        if (!$affiliateUser) return null;

        $affiliate = Affiliate::firstOrCreate([
            'user_id' => $affiliateUser->id,
        ], [
            'commission_rate' => 30.00,
        ]);

        $plan = $subscription->plan;

        $amount = (float) ($plan->price ?? 0);
        if ($amount <= 0) return null;
 
        $commission = round($amount * ($affiliate->commission_rate / 100), 2);

        // create transaction for affiliate
        $tx = Transaction::create([
            'user_id' => $affiliateUser->id,
            'amount' => $commission,
            'status' => 'successful',
            'gateway' => 'affiliate',
            'reference' => 'commission',
            'payable_type' => User::class,
            'payable_id' => $referredUser->id,
            'meta' => [
                'subscription_id' => $subscription->id,
                'plan_id' => $subscription->plan_id,
            ],
        ]);

        // credit balance
        $affiliate->balance = $affiliate->balance + $commission;
        $affiliate->save();

        // notify affiliate
        $this->notifications->sendToUser(NotificationType::PAYMENT_SUCCESS, $affiliateUser, 'You earned a commission', "You earned $".number_format($commission, 2)." from a referral.", ['commission' => $commission, 'referred_user_id' => $referredUser->id]);

        return $tx;
    }

    /**
     * Process payouts for affiliates whose payout interval has passed
     */
    public function processPayouts(): int
    {
        $intervalDays = config('affiliate.payout_interval_days', 30);
        $thresholdDate = now()->subDays($intervalDays);

        $affiliates = Affiliate::where('balance', '>', 0)
            ->where(function ($q) use ($thresholdDate) {
                $q->whereNull('last_payout_at')->orWhere('last_payout_at', '<=', $thresholdDate);
            })->get();

        $count = 0;
        foreach ($affiliates as $affiliate) {
            $amount = (float) $affiliate->balance;
            if ($amount <= 0) continue;

            $tx = Transaction::create([
                'user_id' => $affiliate->user_id,
                'amount' => $amount,
                'status' => 'successful',
                'gateway' => 'affiliate_payout',
                'reference' => 'payout',
                'payable_type' => Affiliate::class,
                'payable_id' => $affiliate->id,
                'meta' => [
                    'payout_method' => $affiliate->payout_method,
                    'payout_details' => $affiliate->payout_details,
                ],
            ]);

            $affiliate->balance = 0;
            $affiliate->last_payout_at = now();
            $affiliate->save();

            // notify
            $this->notifications->sendToUser(NotificationType::PAYMENT_SUCCESS, $affiliate->user_id, 'Affiliate Payout', 'Your affiliate payout of '.number_format($amount,2).' has been processed.', ['amount' => $amount]);

            $count++;
        }

        return $count;
    }
}
