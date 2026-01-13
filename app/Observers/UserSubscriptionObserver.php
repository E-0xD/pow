<?php

namespace App\Observers;

use App\Enums\PortfolioStatus;
use App\Enums\UserSubscriptionStatus;
use App\Models\UserSubscription;
use App\Services\AffiliateService;
use Illuminate\Support\Facades\Log;

class UserSubscriptionObserver
{
    public function updated(UserSubscription $subscription)
    {

        try {

            if (
                $subscription->wasChanged('status') &&
                $subscription->status == UserSubscriptionStatus::ACTIVE
            ) {
                app(AffiliateService::class)->creditCommissionForSubscription($subscription);
            };
        } catch (\Throwable $th) {
            Log::error($th);
            return;
        }
    }
}
