<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case USER = 'user';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrator',
            self::USER => 'User',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::ADMIN => 'text-purple-600',
            self::USER => 'text-blue-600',
        };
    }

    public static function asSelectArray(): array
    {
        return array_combine(
            array_column(self::cases(), 'value'),
            array_map(fn($case) => $case->label(), self::cases())
        );
    }

    public static function default(): self
    {
        return self::USER;
    }
}