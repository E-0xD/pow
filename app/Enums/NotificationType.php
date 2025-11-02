<?php

namespace App\Enums;


enum NotificationType: string
{
    case LOGIN = 'login';
    case SIGNUP = 'signup';
    case NEW_MESSAGE = 'new_message';
    case SYSTEM = 'system';

    // Portfolio related
    case PORTFOLIO_CREATED = 'portfolio_created';
    case PORTFOLIO_UPDATED = 'portfolio_updated';
    case PORTFOLIO_CREATION_CANCELLED = 'portfolio_creation_cancelled';
    case PORTFOLIO_EXPIRED = 'portfolio_expired';
    case PORTFOLIO_UPCOMING = 'portfolio_upcoming';

    // Payment / subscription
    case PAYMENT_SUCCESS = 'payment_success';
    case PAYMENT_FAILED = 'payment_failed';
    case SUBSCRIPTION_RENEWAL = 'subscription_renewal';
    case SUBSCRIPTION_CANCELLED = 'subscription_cancelled';

    // Trials / misc
    case TRIAL_STARTED = 'trial_started';
    case TRIAL_ENDING = 'trial_ending';


    public function label(): string
    {
        return match($this) {
            self::LOGIN => 'Login',
            self::SIGNUP => 'Signup',
            self::NEW_MESSAGE => 'New message',
            self::SYSTEM => 'System notification',
            self::PORTFOLIO_CREATED => 'Portfolio created',
            self::PORTFOLIO_UPDATED => 'Portfolio updated',
            self::PORTFOLIO_CREATION_CANCELLED => 'Portfolio creation cancelled',
            self::PORTFOLIO_EXPIRED => 'Portfolio expired',
            self::PORTFOLIO_UPCOMING => 'Portfolio upcoming',
            self::PAYMENT_SUCCESS => 'Payment successful',
            self::PAYMENT_FAILED => 'Payment failed',
            self::SUBSCRIPTION_RENEWAL => 'Subscription renewal',
            self::SUBSCRIPTION_CANCELLED => 'Subscription cancelled',
            self::TRIAL_STARTED => 'Trial started',
            self::TRIAL_ENDING => 'Trial ending',
        };
    }

    /**
     * Return an associative array suitable for selects: [value => label]
     *
     * @return array<string,string>
     */
    public static function asSelectArray(): array
    {
        $out = [];

        foreach (self::cases() as $case) {
            $out[$case->value] = $case->label();
        }

        return $out;
    }


    public function icon(): string
    {
        return match($this) {
            self::LOGIN => 'login',
            self::SIGNUP => 'person_add',
            self::NEW_MESSAGE => 'mail',
            self::SYSTEM => 'notifications',

            self::PORTFOLIO_CREATED => 'note_add',
            self::PORTFOLIO_UPDATED => 'edit_document',
            self::PORTFOLIO_CREATION_CANCELLED => 'cancel',
            self::PORTFOLIO_EXPIRED => 'event_busy',
            self::PORTFOLIO_UPCOMING => 'event_available',

            self::PAYMENT_SUCCESS => 'check_circle',
            self::PAYMENT_FAILED => 'error',
            self::SUBSCRIPTION_RENEWAL => 'autorenew',
            self::SUBSCRIPTION_CANCELLED => 'do_not_disturb_on',

            self::TRIAL_STARTED => 'star',
            self::TRIAL_ENDING => 'hourglass_bottom',
        };
    }
}
