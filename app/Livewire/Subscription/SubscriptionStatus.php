<?php

namespace App\Livewire\Subscription;

use App\Services\SubscriptionService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SubscriptionStatus extends Component
{
    public $subscription;
    public $tierName;
    public $daysRemaining;
    public $isExpired;
    public $isWithinGracePeriod;
    protected $subscriptionService;

    public function mount()
    {
        $this->subscriptionService = new SubscriptionService();
        $this->loadSubscriptionData();
    }

    public function loadSubscriptionData()
    {
        $user = Auth::user();
        $this->subscription = $this->subscriptionService->getActiveSubscription($user);

        if ($this->subscription) {
            $this->tierName = $this->subscription->plan->getConfig()['name'];
            $this->daysRemaining = $this->subscription->daysUntilExpiration();
            $this->isExpired = $this->subscription->isExpired();
            $this->isWithinGracePeriod = $this->subscription->isWithinGracePeriod();
        } else {
            $this->tierName = 'Free';
            $this->daysRemaining = null;
            $this->isExpired = false;
            $this->isWithinGracePeriod = false;
        }
    }

    public function cancelSubscription()
    {
        if (!$this->subscription) {
            session()->flash('error', 'No active subscription to cancel');
            return;
        }

        $this->subscriptionService->cancelSubscription($this->subscription);
        $this->loadSubscriptionData();

        session()->flash('success', 'Subscription cancelled successfully');
    }

    public function render()
    {
        return view('livewire.subscription.subscription-status');
    }
}
