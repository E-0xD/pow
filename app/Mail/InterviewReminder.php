<?php

namespace App\Mail;

use App\Models\InterviewApplicant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterviewReminder extends Mailable
{
    use Queueable, SerializesModels;

    public InterviewApplicant $applicant;
    public string $reminderType; // '6h' or '1h'

    public function __construct(InterviewApplicant $applicant, string $reminderType)
    {
        $this->applicant = $applicant;
        $this->reminderType = $reminderType;
    }

    public function build()
    {
        $time = $this->applicant->scheduledAtWAT();
        $formattedTime = $time->format('l, F j, Y \a\t g:i A') . ' WAT';
        $countdown = $this->reminderType === '6h' ? '6 hours' : '1 hour';

        return $this->subject('Reminder: Your Interview is in ' . $countdown . ' – ' . config('app.name'))
            ->view('email.template')
            ->with([
                'greeting' => 'Hi ' . $this->applicant->full_name . ',',
                'introLines' => [
                    'This is a friendly reminder that your interview with the ' . config('app.name') . ' team is coming up in ' . $countdown,
                ],
                'actionText' => 'Join Google Meet',
                'actionUrl' => 'https://meet.google.com/xpj-dgkf-zjr',
                'outroLines' => [
                    'Scheduled Time: ' . $formattedTime,
                    'Location: Google Meet (link above)',
                    'Please make sure you are ready a few minutes early. We look forward to speaking with you',
                ],
                'signature' => 'Best regards, The ' . config('app.name') . ' Team',
            ]);
    }
}
