<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class MessageService
{
    protected Agent $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    /**
     * Get registration welcome message
     */
    public function getRegisterMessage(): array
    {
        return [
            'subject' => 'Your Work, Your Badge. let\'s make it count.',
            'payload' => [
                'title' => 'Welcome to ' . config('app.name'),
                'name' => Auth::user()->name,
                'greeting' => 'Hi ' . Auth::user()->name . ', welcome to ' . config('app.name'),
                'introLines' => [
                    'We’re excited to have you here! You’ve just taken the first step toward owning your digital proof of work; a place to showcase your skills, projects, and experience with confidence.',
                    'With ' . config('app.name') . ', you can easily build and share a portfolio that tells your professional story, all in one simple link.',
                    'Our goal is to help you stand out and open new doors of opportunity. If you have ideas or features you’d love to see, we’d love to hear from you anytime.',
                    'Here’s to building something meaningful, and to landing that next big, life-changing opportunity.'
                ],
                'actionText' => 'Go to Dashboard',
                'actionUrl' => route('user.dashboard'),
                'outroLines' => ['If you need help, reply to this email.'],
                'signature' => '— The ' . config('app.name') . ' Team',
                'company' => config('app.name'),
            ]
        ];
    }

    /**
     * Get login welcome back message
     */
    public function getLoginMessage(): array
    {
        return [
            'subject' => 'Login Attempt',
            'payload' => [
                'title' => 'Welcome Back to ' . config('app.name'),
                'name' => Auth::user()->name,
                'greeting' => 'Hi ' . Auth::user()->name . ', welcome back',
                'introLines' => [
                    'We noticed a new login to your account on ' . now()->format('Y-m-d H:i:s') . ' UTC using ' . $this->agent->browser() . ' on ' . $this->agent->platform() . '.',
                    'It’s great to see you again — keep growing your digital proof of work and showcasing what you do best.',
                    'If this wasn’t you, please visit your account settings right away to secure your profile.'
                ],
                'actionText' => 'Go to Dashboard',
                'actionUrl' => route('user.dashboard'),
                'outroLines' => ['If you need help, reply to this email.'],
                'signature' => '— The ' . config('app.name') . ' Team',
                'company' => config('app.name'),
            ]
        ];
    }

    /**
     * Get login notification message
     */
    public function getLoginNotification(): string
    {
        return 'A login was detected on ' . now()->format('Y-m-d H:i:s') .
            ' UTC using ' . $this->agent->browser() . ' on ' . $this->agent->platform();
    }

    /**
     * Get register notification message
     */
    public function getRegisterNotification(): string
    {
        return  'Your Work, Your Badge. let\'s make it count.';
    }
}
