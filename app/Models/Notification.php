<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'body',
        'data',
        'target_type',
        'target_group',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Users who received this notification (pivot holds read state)
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'notification_user')
            ->withPivot(['is_read', 'read_at'])
            ->withTimestamps();
    }

    /**
     * Helper to get data field safely
     */
    public function data(string $key, $default)
    {
        if ($key === null) {
            return $this->data;
        }

        return Arr::get($this->data, $key, $default);
    }
}
