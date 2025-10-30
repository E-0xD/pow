<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortfolioContactMethod extends Model
{
    protected $fillable = [
        'portfolio_id',
        'contact_method_id',
        'value',
    ];


    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function contactMethod(): BelongsTo
    {
        return $this->belongsTo(ContactMethod::class, 'contact_method_id');
    }
}
