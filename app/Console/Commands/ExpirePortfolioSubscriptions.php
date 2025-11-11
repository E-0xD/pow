<?php

namespace App\Console\Commands;

use App\Models\PortfolioSubscription;
use App\Enums\PortfolioSubscriptionStatus;
use Illuminate\Console\Command;

class ExpirePortfolioSubscriptions extends Command
{
    protected $signature = 'portfolio:expire-subscriptions';

    protected $description = 'Change active portfolio subscriptions to expired after their expiration date has passed';

    public function handle()
    {
        $count = PortfolioSubscription::where('status', PortfolioSubscriptionStatus::ACTIVE)
            ->where('expires_at', '<=', now())
            ->update(['status' => PortfolioSubscriptionStatus::EXPIRED]);

        $this->info("Updated {$count} subscriptions to expired status.");
    }
}
