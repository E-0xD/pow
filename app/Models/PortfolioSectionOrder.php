<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortfolioSectionOrder extends Model
{
    protected $fillable = [
        'portfolio_id',
        'section_id',
        'position'
    ];

    protected $casts = [
        'position' => 'integer'
    ];

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }
}
