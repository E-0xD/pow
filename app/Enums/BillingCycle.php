<?php

namespace App\Enums;

enum BillingCycle: string
{
    case MONTHLY = 'monthly';
    case YEARLY = 'yearly';

    public function label(): string
    {
        return match ($this) {
            self::MONTHLY => 'Monthly',
            self::YEARLY => 'Yearly',
        };
    }

    public function durationInDays(): int
    {
        return match ($this) {
            self::MONTHLY => 30,
            self::YEARLY => 365,
        };
    }

    public function durationInMonths(): int
    {
        return match ($this) {
            self::MONTHLY => 1,
            self::YEARLY => 12,
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
