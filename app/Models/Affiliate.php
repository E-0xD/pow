<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Affiliate extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'user_id',
        'commission_rate',
        'payout_method',
        'payout_details',
        'balance',
        'last_payout_at'
    ];

    protected $casts = [
        'payout_details' => 'array',
        'last_payout_at' => 'datetime',
    ];

        protected static function boot()
    {
        parent::boot();

        static::creating(function ($affiliate) {
            $affiliate->uid = (string) Str::random(6);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function credit(float $amount): void
    {
        $this->balance = $this->balance + $amount;
        $this->save();
    }
}
