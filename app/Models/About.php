<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class About extends Model
{
    protected $table = 'about';
    
    protected $fillable = [
        'portfolio_id',
        'name',
        'logo',
        'brief',
        'description',
        'years_of_experience',
        'total_projects_done'
    ];

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }
}