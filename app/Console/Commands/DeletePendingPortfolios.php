<?php

namespace App\Console\Commands;

use App\Enums\PortfolioSubscriptionStatus;
use App\Models\Portfolio;
use Illuminate\Console\Command;

class DeletePendingPortfolios extends Command
{
    protected $signature = 'portfolio:delete-pending';

    protected $description = 'Delete pending portfolios that have never had any subscription after 24 hours';

    public function handle()
    {
        $count = Portfolio::whereHas('subscriptions', function ($query) {
            $query->where('status', PortfolioSubscriptionStatus::PENDING);
        })->whereDoesntHave('subscriptions', function ($query) {
            $query->whereIn('status', [
                PortfolioSubscriptionStatus::ACTIVE,
                PortfolioSubscriptionStatus::EXPIRED,
                PortfolioSubscriptionStatus::CANCELLED,
                PortfolioSubscriptionStatus::FAILED,
                PortfolioSubscriptionStatus::TRIAL,
                PortfolioSubscriptionStatus::RENEWED
            ]);
        })
            ->where('created_at', '<=', now()->subHours(24))
            ->delete();

        $this->info("Deleted {$count} pending subscriptions with no previous subscriptions.");
    }
}
