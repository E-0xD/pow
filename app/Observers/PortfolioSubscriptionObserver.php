<?php

namespace App\Observers;

use App\Enums\PortfolioStatus;
use App\Enums\PortfolioSubscriptionStatus;
use App\Models\PortfolioSubscription;
use App\Services\AffiliateService;
use Illuminate\Support\Facades\Log;

class PortfolioSubscriptionObserver
{
    public function updated(PortfolioSubscription $subscription)
    {
        if (
            $subscription->wasChanged('status') &&
            $subscription->status === PortfolioSubscriptionStatus::ACTIVE
        ) {
            app(AffiliateService::class)->creditCommissionForSubscription($subscription);
        };
    }
}
