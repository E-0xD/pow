<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\AffiliateService;

class ProcessAffiliatePayouts extends Command
{
    protected $signature = 'affiliates:process-payouts';
    protected $description = 'Process affiliate payouts according to the configured interval';

    public function handle(AffiliateService $affiliateService)
    {
        $this->info('Processing affiliate payouts...');
        $count = $affiliateService->processPayouts();
        $this->info("Processed payouts for {$count} affiliates.");
        return 0;
    }
}
