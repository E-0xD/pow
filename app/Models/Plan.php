<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'price',
        'name',
        'description',
        'benefits',
        'duration'
    ];

    protected $casts = [
        'benefits' => 'array',
        'duration' => 'integer'
    ];

    public function portfolioSubscriptions()
    {
        return $this->hasMany(PortfolioSubscription::class);
    }
}