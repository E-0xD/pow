<?php

namespace App\Enums;

enum CouponType: string
{
    case PLAN_DISCOUNT = 'plan_discount';
    case GLOBAL_DISCOUNT = 'global_discount';
    case FREE_MONTHS = 'free_months';
    case EXTRA_MONTHS = 'extra_months';

    public function label(): string
    {
        return match ($this) {
            self::PLAN_DISCOUNT => 'Discount for Specific Plan',
            self::GLOBAL_DISCOUNT => 'Discount for All Plans',
            self::FREE_MONTHS => 'Free Months',
            self::EXTRA_MONTHS => 'Extra Months',
        };
    }

    public function message($value): string
    {
        return match ($this) {
            self::PLAN_DISCOUNT =>
            "You have been granted a {$value}% discount on this plan.",

            self::GLOBAL_DISCOUNT =>
            "A {$value}% discount has been applied on this plan.",

            self::FREE_MONTHS =>
            "This plan has been granted to you at no cost for {$value} month" . ($value > 1 ? 's' : '') .
                ". You will not be charged during this period.",

            self::EXTRA_MONTHS =>
            "{$value} extra month" . ($value > 1 ? 's' : '') . " have been added to your subscription at no extra cost.",
        };
    }


    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($case) => [$case->value => $case->label()])->toArray();
    }
}
