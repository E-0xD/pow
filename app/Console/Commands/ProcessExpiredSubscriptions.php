<?php

namespace App\Console\Commands;

use App\Services\SubscriptionService;
use Illuminate\Console\Command;

class ProcessExpiredSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:process-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process expired subscriptions and mark them as expired after grace period';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subscriptionService = new SubscriptionService();

        $this->info('Processing expired subscriptions...');

        try {
            $subscriptionService->handleExpiredSubscriptions();
            $this->info('Expired subscriptions processed successfully');

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Error processing subscriptions: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
