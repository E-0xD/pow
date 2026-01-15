<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'tier_features')
            ->withPivot('value')
            ->withTimestamps();
    }

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    /**
     * Check if tier has a specific feature
     */
    public function hasFeature(string $featureSlug): bool
    {
        return $this->features()->where('slug', $featureSlug)->exists();
    }

    /**
     * Get feature value for this tier
     */
    public function getFeatureValue(string $featureSlug)
    {
        $feature = $this->features()->where('slug', $featureSlug)->first();
        return $feature ? $feature->pivot->value : null;
    }
}
