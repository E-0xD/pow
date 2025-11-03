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
        'favicon',
        'meta_title',
        'meta_description',
        'accept_messages',
    ];

    protected $casts = [
        'typography' => 'array',
        'expires_at' => 'datetime',
        'accept_messages' => 'boolean'
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

    public function experiences()
    {
        return $this->hasMany(Experience::class)->orderBy('start_date', 'desc');
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
        return $this->belongsToMany(Skill::class, 'portfolio_skills');
    }

    public function contactMethods(): HasMany
    {
        return $this->hasMany(PortfolioContactMethod::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(PortfolioMessage::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(PortfolioVisit::class);
    }

    public function clicks(): HasMany
    {
        return $this->hasMany(PortfolioClick::class);
    }

    public function trafficSources(): HasMany
    {
        return $this->hasMany(PortfolioTrafficSource::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(PortfolioSubscription::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(PortfolioSubscription::class)
            ->where('status', 'active')
            ->where('expires_at', '>', now());
    }
}
