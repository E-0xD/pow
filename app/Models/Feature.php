<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'type',
    ];

    public function tiers()
    {
        return $this->belongsToMany(Tier::class, 'tier_features')
            ->withPivot('value')
            ->withTimestamps();
    }
}
