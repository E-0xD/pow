<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'email',
        'api_key',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'partner_users')->withTimestamps();
    }
}
