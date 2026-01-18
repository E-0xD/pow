<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case SUCCESSFUL = 'successful';
    case PENDING = 'pending';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';

    public function label(): string
    {
        return match ($this) {
            self::SUCCESSFUL => 'Successful',
            self::PENDING => 'Pending',
            self::FAILED => 'Failed',
            self::REFUNDED => 'Refunded'
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::SUCCESSFUL => 'bg-green-100 text-green-800',
            self::PENDING => 'bg-yellow-100 text-yellow-800',
            self::FAILED => 'bg-red-100 text-red-800',
            self::REFUNDED => 'bg-blue-100 text-blue-800'
        };
    }

    public function textColor(): string
    {
        return match ($this) {
            self::SUCCESSFUL => 'text-green-600',
            self::PENDING => 'text-yellow-600',
            self::FAILED => 'text-red-600',
            self::REFUNDED => 'text-blue-600'
        };
    }
}
