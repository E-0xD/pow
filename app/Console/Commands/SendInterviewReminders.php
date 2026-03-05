<?php

namespace App\Console\Commands;

use App\Mail\InterviewReminder;
use App\Models\InterviewApplicant;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendInterviewReminders extends Command
{
    protected $signature = 'interviews:send-reminders';
    protected $description = 'Send 6-hour and 1-hour reminders for upcoming interviews';

    public function handle(): int
    {
        $now = Carbon::now('UTC');

        $this->info('Checking for reminders to send at ' . $now->toDateTimeString() . ' UTC');

        // 6-hour reminders: scheduled_at is within the next 6 hours and reminder not yet sent
        $sixHourApplicants = InterviewApplicant::whereNotNull('invitation_sent_at')
            ->whereNull('reminder_6h_sent_at')
            ->where('scheduled_at', '>', $now)
            ->where('scheduled_at', '<=', $now->copy()->addHours(6))
            ->get();

        foreach ($sixHourApplicants as $applicant) {
            try {
                Mail::to($applicant->email)->send(new InterviewReminder($applicant, '6h'));
                $applicant->update(['reminder_6h_sent_at' => now()]);
                $this->info("📧 6h reminder sent to {$applicant->full_name} ({$applicant->email})");
            } catch (\Exception $e) {
                $this->warn("⚠️ 6h reminder failed for {$applicant->full_name}: {$e->getMessage()}");
            }
        }

        // 1-hour reminders: scheduled_at is within the next 1 hour and reminder not yet sent
        $oneHourApplicants = InterviewApplicant::whereNotNull('invitation_sent_at')
            ->whereNull('reminder_1h_sent_at')
            ->where('scheduled_at', '>', $now)
            ->where('scheduled_at', '<=', $now->copy()->addHour())
            ->get();

        foreach ($oneHourApplicants as $applicant) {
            try {
                Mail::to($applicant->email)->send(new InterviewReminder($applicant, '1h'));
                $applicant->update(['reminder_1h_sent_at' => now()]);
                $this->info("📧 1h reminder sent to {$applicant->full_name} ({$applicant->email})");
            } catch (\Exception $e) {
                $this->warn("⚠️ 1h reminder failed for {$applicant->full_name}: {$e->getMessage()}");
            }
        }

        $total = $sixHourApplicants->count() + $oneHourApplicants->count();
        $this->info("Done! Sent {$total} reminder(s).");

        return Command::SUCCESS;
    }
}
