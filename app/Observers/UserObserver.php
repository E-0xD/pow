<?php

namespace App\Observers;

use App\Enums\NotificationType;
use App\Models\Affiliate;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $referrerUid = session('affiliate_referrer') ?? Cookie::get('affiliate_referrer');

        if ($referrerUid && !$user->referred_by) {
            // Double-check the referrer still exists and is a valid affiliate
            $affiliate = Affiliate::where('uid', $referrerUid)->first();

            if ($affiliate) {
                $user->referred_by = $affiliate->user_id;
                $user->save();

                new NotificationService()->sendToUser(
                    NotificationType::REFERRAL,
                    $affiliate->user_id,
                    'New referral joined',
                    'Encourage them to create and publish their first portfolio to unlock your reward.'
                );

                // Clear the referral cookie/session after successful attribution
                Cookie::queue(Cookie::forget('affiliate_referrer'));
                session()->forget('affiliate_referrer');
            }
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
