<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaystackCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'paystack_customer_id',
        'paystack_customer_code',
    ];

    /**
     * Get the user that owns the Paystack customer record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
