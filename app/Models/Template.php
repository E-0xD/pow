<?php

namespace App\Models;

use App\Enums\PortfolioStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Support\Str;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'thumbnail_path',
        'file_path',
        'tags',
    ];

    protected $casts = [
        'status' => PortfolioStatus::class,
        'tags' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($portfolio){
            $portfolio->uid = (string) Str::uuid();
        });
    }

    public function getRouteKeyName()
    {
       return 'uid';   
    }
}