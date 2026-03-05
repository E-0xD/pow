<?php

namespace App\Mail;

use App\Models\InterviewApplicant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterviewInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public InterviewApplicant $applicant;

    public function __construct(InterviewApplicant $applicant)
    {
        $this->applicant = $applicant;
    }

    public function build()
    {
        $time = $this->applicant->scheduledAtWAT();
        $formattedTime = $time->format('l, F j, Y \a\t g:i A') . ' WAT';

        return $this->subject('Interview Invitation – ' . config('app.name') . ' Volunteer Team')
            ->view('email.template')
            ->with([
                'greeting' => 'Hello, ' . $this->applicant->full_name,
                'introLines' => [
                    'Thank you for applying to join the ' . config('app.name') . ' Volunteer Team! We are excited to invite you to a short interview.',
                    'Your interview has been scheduled for'. $formattedTime,
                ],
                'actionText' => 'Join Google Meet',
                'actionUrl' => 'https://meet.google.com/xpj-dgkf-zjr',
                'outroLines' => [
                    'Location: Google Meet (link above)',
                    '💼 Role(s): ' . ($this->applicant->role ?: 'To be discussed'),
                    'Please be available 5 minutes before your scheduled time. If you have any questions, feel free to reply to this email.',
                ],
                'signature' => 'Best regards, The ' . config('app.name') . ' Team',
            ]);
    }
}
