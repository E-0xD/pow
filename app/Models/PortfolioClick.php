<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortfolioClick extends Model
{
    protected $fillable = [
        'portfolio_id',
        'ip_address',
        'element_type',
        'element_id',
        'page_url',
        'clicked_url'
    ];

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }
}
