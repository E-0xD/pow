<?php

namespace App\Enums;

enum UserSubscriptionStatus: string
{
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case EXPIRED = 'expired';
    case CANCELLED = 'cancelled';
    case FAILED = 'failed';
    case TRIAL = 'trial';
    case RENEWED = 'renewed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::ACTIVE => 'Active',
            self::EXPIRED => 'Expired',
            self::CANCELLED => 'Cancelled',
            self::FAILED => 'Failed',
            self::TRIAL => 'Trial',
            self::RENEWED => 'Renewed',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'text-yellow-500',
            self::ACTIVE => 'text-green-600',
            self::EXPIRED => 'text-gray-500',
            self::CANCELLED => 'text-red-500',
            self::FAILED => 'text-rose-500',
            self::TRIAL => 'text-blue-500',
            self::RENEWED => 'text-emerald-500',
        };
    }

    public static function asSelectArray(): array
    {
        $out = [];

        foreach (self::cases() as $case) {
            $out[$case->value] = $case->label();
        }

        return $out;
    }
}
