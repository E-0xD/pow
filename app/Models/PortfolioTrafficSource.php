<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortfolioTrafficSource extends Model
{
    protected $fillable = [
        'portfolio_id',
        'source',
        'visits_count',
        'date'
    ];

    protected $casts = [
        'date' => 'date',
        'visits_count' => 'integer'
    ];

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }
}
