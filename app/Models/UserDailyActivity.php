<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDailyActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'country',
        'city',
        'ip_address',
        'user_agent',
        'device_type'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get daily active users for a date range
     */
    public function scopeForDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }

    /**
     * Scope to get unique active users for a date range
     */
    public function scopeUniqueUsers($query, $startDate, $endDate)
    {
        return $query->forDateRange($startDate, $endDate)
            ->distinct('user_id')
            ->count('user_id');
    }
}
