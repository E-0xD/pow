<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortfolioSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id',
        'plan_id',
        'user_id',
        'purchased_at',
        'expires_at',
        'status',
        'transaction_id'
    ];

    protected $casts = [
        'purchased_at' => 'datetime',
        'expires_at' => 'datetime'
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'payable');
    }
}
