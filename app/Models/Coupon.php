<?php

namespace App\Models;

use App\Enums\CouponType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'discount_value',
        'months_value',
        'applicable_plan_id',
        'max_uses',
        'used_count',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
        'type' => CouponType::class,
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'applicable_plan_id');
    }

    public function isValid()
    {
        return $this->is_active &&
               ($this->expires_at === null || $this->expires_at->isFuture()) &&
               ($this->max_uses === null || $this->used_count < $this->max_uses);
    }

    public function incrementUsedCount()
    {
        $this->increment('used_count');
    }
}