<?php

namespace App\Console\Commands;

use App\Enums\TransactionStatus;
use App\Models\Transaction;
use App\Services\EmailService;
use App\Services\MessageService;
use Illuminate\Console\Command;
use Carbon\Carbon;

class MarkFailedTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:mark-failed';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Mark pending transactions older than 30 minutes as failed and notify users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $emailService = app(EmailService::class);
        $messageService = app(MessageService::class);

        // Get all pending transactions older than 30 minutes
        $thirtyMinutesAgo = Carbon::now()->subMinutes(30);

        $failedTransactions = Transaction::where('status', TransactionStatus::PENDING)
            ->where('created_at', '<', $thirtyMinutesAgo)
            ->get();

        if ($failedTransactions->isEmpty()) {
            $this->info('No pending transactions older than 30 minutes found.');
            return Command::SUCCESS;
        }

        foreach ($failedTransactions as $transaction) {
            // Update transaction status to failed
            $transaction->update([
                'status' => TransactionStatus::FAILED
            ]);

            // Get the user and send notification
            $user = $transaction->user;

            // Get failure message using MessageService
            $messageData = $messageService->getPaymentFailedMessage(
                $user,
                $transaction->amount,
                $transaction->reference
            );

            // Send email using EmailService
            $emailService->send(
                $user,
                $messageData['subject'],
                $messageData['payload'],
            );

            $this->line("Transaction {$transaction->reference} marked as failed and user notified.");
        }

        $this->info("Successfully marked {$failedTransactions->count()} transaction(s) as failed.");

        return Command::SUCCESS;
    }
}
