<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ContactMethod extends Model
{
    protected $fillable = [
        'title',
        'logo'
    ];

    public function portfolios(): BelongsToMany
    {
        return $this->belongsToMany(Portfolio::class, 'portfolio_contact_method')
            ->withPivot('value');
    }
}
