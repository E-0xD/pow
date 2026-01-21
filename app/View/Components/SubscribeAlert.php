<?php

namespace App\View\Components;

use App\Enums\UserSubscriptionStatus;
use App\Models\UserSubscription;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class SubscribeAlert extends Component
{
    public bool $shouldShow;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
       
        $subscription = UserSubscription::where('user_id', Auth::id())
            ->where('status', UserSubscriptionStatus::ACTIVE)
            ->with('plan')
            ->first();
        $this->shouldShow = !$subscription || $subscription->plan->price === null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.subscribe-alert', [
            'shouldShow' => $this->shouldShow
        ]);
    }
}
