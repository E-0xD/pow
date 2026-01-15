<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TierFeature extends Model
{
    use HasFactory;

    protected $table = 'tier_features';

    protected $fillable = [
        'tier_id',
        'feature_id',
        'value',
    ];

    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
