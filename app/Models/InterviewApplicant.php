<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class InterviewApplicant extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'whatsapp',
        'role',
        'row_hash',
        'scheduled_at',
        'invitation_sent_at',
        'reminder_6h_sent_at',
        'reminder_1h_sent_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'invitation_sent_at' => 'datetime',
        'reminder_6h_sent_at' => 'datetime',
        'reminder_1h_sent_at' => 'datetime',
    ];

    /**
     * Get the scheduled time in WAT (West Africa Time, UTC+1).
     */
    public function scheduledAtWAT(): Carbon
    {
        return $this->scheduled_at->copy()->setTimezone('Africa/Lagos');
    }
}
