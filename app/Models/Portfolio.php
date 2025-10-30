<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    public function about(): HasOne
    {
        return $this->hasOne(About::class);
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function educationRecords(): HasMany
    {
        return $this->hasMany(EducationRecord::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function sectionOrders(): HasMany
    {
        return $this->hasMany(PortfolioSectionOrder::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    public function contactMethods(): BelongsToMany
    {
        return $this->belongsToMany(ContactMethod::class, 'portfolio_contact_method')
            ->withPivot('value');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
