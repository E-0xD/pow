<?php

namespace App\Console\Commands;

use App\Mail\InterviewInvitation;
use App\Models\InterviewApplicant;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProcessInterviewApplicants extends Command
{
    protected $signature = 'interviews:process';
    protected $description = 'Read applicants from the uploaded xlsx and schedule interviews';

    // Friday March 6, 2026 5:00 PM WAT (UTC+1 → 4:00 PM UTC)
    private const FRIDAY_START = '2026-03-06 16:00:00';
    // Saturday March 7, 2026 10:00 AM WAT (UTC+1 → 9:00 AM UTC)
    private const SATURDAY_START = '2026-03-07 09:00:00';
    // Friday 8:00 AM WAT cutoff (UTC+1 → 7:00 AM UTC)
    private const FRIDAY_CUTOFF = '2026-03-06 07:00:00';

    private const INTERVAL_MINUTES = 15;

    public function handle(): int
    {
        $filePath = storage_path('app/interviews/applicants.xlsx');

        if (!file_exists($filePath)) {
            $this->error('No xlsx file found at: ' . $filePath);
            return Command::FAILURE;
        }

        $this->info('Reading applicants from xlsx...');

        try {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true);
        } catch (\Exception $e) {
            $this->error('Failed to read xlsx: ' . $e->getMessage());
            return Command::FAILURE;
        }

        // Skip header row (row 1)
        $header = array_shift($rows);
        $this->info('Found ' . count($rows) . ' data rows.');

        $newCount = 0;
        $skipCount = 0;

        foreach ($rows as $index => $row) {
            $name = trim($row['B'] ?? '');
            $email = trim($row['C'] ?? '');
            $whatsapp = trim($row['D'] ?? '');
            $role = trim($row['E'] ?? '');

            if (empty($name) || empty($email)) {
                $this->warn("Row " . ($index + 1) . ": Skipping — missing name or email.");
                continue;
            }

            $rowHash = hash('sha256', strtolower($name) . '|' . strtolower($email));

            // Skip if already exists
            if (InterviewApplicant::where('row_hash', $rowHash)->exists()) {
                $skipCount++;
                continue;
            }

            // Determine which day to schedule on
            $scheduledAt = $this->getNextAvailableSlot($rowHash);

            $applicant = InterviewApplicant::create([
                'full_name' => $name,
                'email' => $email,
                'whatsapp' => $whatsapp ?: null,
                'role' => $role ?: null,
                'row_hash' => $rowHash,
                'scheduled_at' => $scheduledAt,
            ]);

            // Send invitation email
            try {
                Mail::to($applicant->email)->send(new InterviewInvitation($applicant));
                $applicant->update(['invitation_sent_at' => now()]);
                $this->info("✅ {$applicant->full_name} — scheduled at {$applicant->scheduledAtWAT()->format('D M j g:i A')} WAT — invitation sent");
            } catch (\Exception $e) {
                $this->warn("⚠️ {$applicant->full_name} — scheduled but email failed: {$e->getMessage()}");
            }

            $newCount++;
        }

        $this->newLine();
        $this->info("Done! {$newCount} new applicants processed, {$skipCount} duplicates skipped.");
        $this->info('Total applicants in database: ' . InterviewApplicant::count());

        return Command::SUCCESS;
    }

    /**
     * Get the next available 15-minute slot.
     * All new applicants go to Friday 6 PM WAT first.
     * If the current time is past Friday 8 AM WAT cutoff, they go to Saturday 10 AM WAT.
     */
    private function getNextAvailableSlot(string $rowHash): Carbon
    {
        $now = Carbon::now('UTC');
        $fridayCutoff = Carbon::parse(self::FRIDAY_CUTOFF, 'UTC');

        // Determine the base start time
        if ($now->greaterThanOrEqualTo($fridayCutoff)) {
            // After Friday 8 AM WAT cutoff → start from Saturday
            $baseStart = Carbon::parse(self::SATURDAY_START, 'UTC');
        } else {
            $baseStart = Carbon::parse(self::FRIDAY_START, 'UTC');
        }

        // Find the last scheduled applicant for the appropriate day
        $lastApplicant = InterviewApplicant::where('scheduled_at', '>=', $baseStart)
            ->orderBy('scheduled_at', 'desc')
            ->first();

        if ($lastApplicant) {
            return $lastApplicant->scheduled_at->copy()->addMinutes(self::INTERVAL_MINUTES);
        }

        return $baseStart;
    }
}
