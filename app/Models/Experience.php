<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Experience extends Model
{
    protected $fillable = [
        'portfolio_id',
        'start_date',
        'end_date',
        'company',
        'position',
        'description'
    ];


    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }
}
