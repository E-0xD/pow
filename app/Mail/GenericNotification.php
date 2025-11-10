<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenericNotification extends Mailable
{
    use Queueable, SerializesModels;

    public string $subjectLine;
    public array $payload;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param array $payload  // keys used in the template: greeting, introLines (array), actionText, actionUrl, outroLines (array), signature, company, address
     */
    public function __construct(string $subject, array $payload = [])
    {
        $this->subjectLine = $subject;
        $this->payload = $payload;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->subjectLine)
            ->view('email.template')
            ->with($this->payload);
    }
}
