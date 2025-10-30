<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_id',
        'title',
        'slug',
        'visibility',
        'theme',
        'typography',
        'expires_at',
        'status',
        'favicon',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'typography' => 'array',
        'expires_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($Portfolio) {
            $Portfolio->uid = (string) Str::uuid();
            if (!$Portfolio->title) {
                $Portfolio->title = Str::uuid(5);
            }
            if (!$Portfolio->slug) {
                $Portfolio->slug = $Portfolio->title;
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'uid';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
