<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortfolioVisit extends Model
{
    protected $fillable = [
        'portfolio_id',
        'ip_address',
        'user_agent',
        'referer_url',
        'page_url',
        'traffic_source'
    ];

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }
}
