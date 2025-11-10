<?php

namespace App\Services;

use App\Mail\GenericNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Mail\Mailable;

class EmailService
{
    /**
     * Send an email using the generic template.
     *
     * @param string|object|array $to  Email address, User model or array of addresses
     * @param string $subject
     * @param array $payload  // data passed to the template / mailable
     * @param bool $queue
     * @return void
     */
    public function send(string|object|array $to, string $subject, array $payload = [], bool $queue = true): void
    {
        $mailable = new GenericNotification($subject, $payload);

        if (is_object($to) && method_exists($to, 'email')) {
            // uncommon, but support objects with email() method
            $recipient = $to->email();
        } elseif (is_object($to) && property_exists($to, 'email')) {
            $recipient = $to->email;
        } else {
            $recipient = $to;
        }

        if ($queue) {
            Mail::to($recipient)->queue($mailable);
        } else {
            Mail::to($recipient)->send($mailable);
        }
    }
}
