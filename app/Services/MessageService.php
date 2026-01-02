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
                    'We’re excited to have you here! You’ve just taken the first step toward owning your digital proof of work; a place to help you showcase your skills, projects, and experience with confidence.',
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

    public function getPaymentInitiatedMessage($amount, $reference, $portfolioName): array
    {
        return [
            'subject' => 'Payment Initiated',
            'payload' => [
                'title' => 'Payment Started for ' . $portfolioName,
                'name' => Auth::user()->name,
                'greeting' => 'Hi ' . Auth::user()->name . ',',
                'introLines' => [
                    'We’ve received your request to make a payment of $' . number_format($amount, 2) . '.',
                    'Your payment reference is **' . $reference . '**.',
                    'Once confirmed, your portfolio — **' . $portfolioName . '** — will be upgraded automatically.',
                    'You’ll receive an update as soon as the payment is processed successfully.'
                ],

                'outroLines' => [
                    'If you didn’t initiate this payment, please contact support immediately.'
                ],
                'signature' => '— The ' . config('app.name') . ' Team',
                'company' => config('app.name'),
            ]
        ];
    }

    public function getPaymentFailedMessage($user, $amount, $reference, $portfolioName): array
    {
        return [
            'subject' => 'Payment Failed',
            'payload' => [
                'title' => 'Payment Failed for ' . $portfolioName,
                'name' => $user->name,
                'greeting' => 'Hi ' . $user->name . ',',
                'introLines' => [
                    'We noticed that your payment of $' . number_format($amount, 2) . ' (Ref: ' . $reference . ') didn’t go through.',
                    'Sometimes this can happen due to network delays or an issue with your payment provider.',
                    'You can try again or choose a different payment method to complete your upgrade for **' . $portfolioName . '**.'
                ],
                'outroLines' => [
                    'If you need assistance, feel free to reply to this email; we’re here to help.'
                ],
                'signature' => '— The ' . config('app.name') . ' Team',
                'company' => config('app.name'),
            ]
        ];
    }

    public function getPaymentSuccessMessage($user, $amount, $reference, $portfolioName): array
    {
        return [
            'subject' => 'Payment Successful',
            'payload' => [
                'title' => 'Payment Successful for ' . $portfolioName,
                'name' => $user->name,
                'greeting' => 'Congratulations ' . $user->name . '!',
                'introLines' => [
                    'Your payment of $' . number_format($amount, 2) . ' (Ref: ' . $reference . ') was successful.',
                    'Your portfolio — **' . $portfolioName . '** — has been upgraded and is now live with all your selected features.',
                    'We’re excited to see what you build next. Keep showing the world your proof of work!'
                ],
                'actionText' => 'View Portfolio',
                'actionUrl' => route('user.portfolio.index', ['name' => $portfolioName]),
                'outroLines' => [
                    'If you have any feedback or run into an issue, reply to this email; we’d love to hear from you.'
                ],
                'signature' => '— The ' . config('app.name') . ' Team',
                'company' => config('app.name'),
            ]
        ];
    }

    /**
     * Get password reset message
     */
    public function getPasswordResetMessage($user, $resetLink): array
    {
        return [
            'subject' => 'Reset Your Password',
            'payload' => [
                'title' => 'Password Reset Request',
                'name' => $user->name,
                'greeting' => 'Hi ' . $user->name . ',',
                'introLines' => [
                    'We received a request to reset the password associated with your ' . config('app.name') . ' account.',
                    'If you made this request, click the button below to reset your password. This link will expire in 60 minutes.',
                    'If you didn\'t request a password reset, you can safely ignore this email. Your account is secure.'
                ],
                'outroLines' => [
                    'If you have any trouble, reply to this email or contact our support team.'
                ],
                'actionText' => 'Reset Password',
                'actionUrl' => $resetLink,
                'signature' => '— The ' . config('app.name') . ' Team',
                'company' => config('app.name'),
            ]
        ];
    }

    /**
     * Get password reset notification message
     */
    public function getPasswordResetNotification(): string
    {
        return 'A password reset was requested for your account on ' . now()->format('Y-m-d H:i:s') . ' UTC';
    }

    /**
     * Get password reset success message
     */
    public function getPasswordResetSuccessMessage($user): array
    {
        return [
            'subject' => 'Your Password Has Been Reset',
            'payload' => [
                'title' => 'Password Reset Successful',
                'name' => $user->name,
                'greeting' => 'Hi ' . $user->name . ',',
                'introLines' => [
                    'Your password has been successfully reset.',
                    'You can now sign in to your ' . config('app.name') . ' account with your new password.',
                    'If you didn\'t reset your password, please contact our support team immediately to secure your account.'
                ],
                'actionText' => 'Go to Dashboard',
                'actionUrl' => route('user.dashboard'),
                'outroLines' => [
                    'If you have any questions, reply to this email or contact our support team.'
                ],
                'signature' => '— The ' . config('app.name') . ' Team',
                'company' => config('app.name'),
            ]
        ];
    }

    public function getPartnerRegisterMessage($user, $partner): array
    {
        $introLines = [
            'Welcome! Through our partnership with ' . $partner->name . ', you now have access to powerful portfolio and digital proof-of-work tools.',
            'You\'ve just taken an important step toward building your professional presence — a dedicated space where you can showcase your skills, projects, and accomplishments with confidence.',
            'With ' . config('app.name') . ', creating and sharing a compelling portfolio is effortless. Your entire professional story, accessible through one simple link.',
        ];

        if (config('app.status') == 'waitlist') {
            $introLines[] = 'We\'re currently in early access and launching publicly soon. As a ' . $partner->name . ' user, you\'ll be getting priority access to the full platform when we launch.';
        }

        $introLines = array_merge($introLines, [
            'Our mission: help you stand out, build credibility, and unlock new opportunities. Have ideas for features you\'d love to see? We genuinely want to hear from you.',
            'Here\'s to creating something meaningful — and to your next breakthrough moment.',
            'Start exploring the tools now available to you through the ' . $partner->name . ' and ' . config('app.name') . ' partnership.',
        ]);

        return [
            'subject' => 'Welcome to ' . config('app.name') . ' - Account Created via ' . $partner->name,
            'payload' => [
                'title' => 'Welcome to ' . config('app.name'),
                'name' => $user->name,
                'greeting' => 'Hi ' . $user->name . ',',
                'introLines' => $introLines,
                'actionText' => 'Sign In to Your Account',
                'actionUrl' => route('login'),
                'outroLines' => [
                    'Your account credentials are ready to use. If you have any questions about your account or ' . $partner->name . '\'s services, please contact our support team.',
                    'Thank you for joining ' . config('app.name') . ' through ' . $partner->name . '!'
                ],
                'signature' => '— The ' . config('app.name') . ' Team',
                'company' => config('app.name'),
            ]
        ];
    }
}
