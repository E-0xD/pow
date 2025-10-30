<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationRecord extends Model
{
    protected $fillable = [
        'portfolio_id',
        'year_of_admission',
        'year_of_graduation',
        'school',
        'degree'
    ];

    protected $casts = [
        'year_of_admission' => 'integer',
        'year_of_graduation' => 'integer'
    ];

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }
}
