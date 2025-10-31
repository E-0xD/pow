<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use illuminate\Support\Str;

class PortfolioMessage extends Model
{
    protected $fillable = [
        'portfolio_id',
        'name',
        'email',
        'message',
        'read'
    ];

    
    protected static function boot()
    {
        parent::boot();
        static::creating(function($portfolioMessage){
            $portfolioMessage->uid = (string) Str::uuid();
        });
    }

    public function getRouteKeyName()
    {
       return 'uid';   
    }

    protected $casts = [
        'read' => 'boolean'
    ];

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }
}
