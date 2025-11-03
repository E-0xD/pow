<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Affiliate;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'status' => UserStatus::class,
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function affiliate()
    {
        return $this->hasOne(Affiliate::class, 'user_id');
    }

    public function referredBy()
    {
        return $this->belongsTo(self::class, 'referred_by');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Notifications received by the user (pivot contains read state)
     */
    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'notification_user')
            ->withPivot(['is_read', 'read_at'])
            ->withTimestamps()
            ->orderBy('notification_user.created_at', 'desc');
    }


    /**
     * Count of unread notifications
     */
    public function unreadNotificationsCount(): int
    {
        return $this->notifications()->wherePivot('is_read', false)->count();
    }

    /**
     * Mark a notification as read
     */
    public function markNotificationAsRead(int $notificationId): bool
    {
        $exists = $this->notifications()->where('notifications.id', $notificationId)->exists();
        if (!$exists) return false;

        $this->notifications()->updateExistingPivot($notificationId, [
            'is_read' => true,
            'read_at' => now(),
        ]);

        return true;
    }

    public function portfolioVisitsCountLastDays(int $days = 30): array
    {
        $since = now()->subDays($days);

        // load portfolios with a visits_count restricted to the timeframe
        $perPortfolio = $this->portfolios()
            ->withCount(['visits as visits_count' => function ($q) use ($since) {
                $q->where('created_at', '>=', $since);
            }])
            ->get()
            ->map(fn($p) => [
                'portfolio_id' => $p->id,
                'uid' => $p->uid ?? null,
                'title' => $p->title,
                'visits' => (int) $p->visits_count,
            ]);

        $total = $perPortfolio->sum('visits');

        return [
            'per_portfolio' => $perPortfolio,
            'total' => (int) $total,
            'days' => $days,
        ];
    }
}
