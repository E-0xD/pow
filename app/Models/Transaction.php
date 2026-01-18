<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'gateway',
        'reference',
        'processor_reference',
        'payable_type',
        'payable_id',
        'meta'
    ];

    protected $casts = [
        'meta' => 'array',
        'status' => TransactionStatus::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payable()
    {
        return $this->morphTo();
    }
}