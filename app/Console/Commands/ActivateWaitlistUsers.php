<?php

namespace App\Console\Commands;

use App\Enums\UserStatus;
use App\Models\User;
use App\Services\EmailService;
use App\Services\MessageService;
use Illuminate\Console\Command;

class ActivateWaitlistUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:activate-waitlist';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Activate all waitlist users and send them a launch notification email';

    /**
     * Execute the console command.
     */
    public function handle(MessageService $messageService, EmailService $emailService): int
    {
        // Get all waitlist users
        $waitlistUsers = User::where('status', UserStatus::WAITLIST)->get();

        if ($waitlistUsers->isEmpty()) {
            $this->info('No waitlist users found.');
            return self::SUCCESS;
        }

        $this->info("Found {$waitlistUsers->count()} waitlist users. Starting activation...");
        $bar = $this->output->createProgressBar($waitlistUsers->count());
        $bar->start();

        foreach ($waitlistUsers as $user) {
            // Update user status to ACTIVE
            $user->update(['status' => UserStatus::ACTIVE]);

            // Get and send launch email
            $message = $messageService->getLaunchEmailMessage($user);
            $emailService->send($user, $message['subject'], $message['payload']);

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Successfully activated {$waitlistUsers->count()} users and sent launch notifications!");

        return self::SUCCESS;
    }
}
