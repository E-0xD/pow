<div class="subscription-status-card p-6 border rounded-lg">
    <h3 class="text-lg font-semibold mb-4">Your Subscription</h3>

    @if($subscription)
        <div class="space-y-3">
            <div class="flex justify-between">
                <span>Current Plan:</span>
                <span class="font-semibold">{{ $tierName }}</span>
            </div>

            <div class="flex justify-between">
                <span>Status:</span>
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded text-sm">
                    {{ $subscription->status->label() }}
                </span>
            </div>

            @if($daysRemaining !== null)
                <div class="flex justify-between">
                    <span>Days Remaining:</span>
                    <span class="font-semibold">{{ $daysRemaining }} days</span>
                </div>

                @if($isWithinGracePeriod && $daysRemaining < 0)
                    <div class="p-3 bg-yellow-50 border border-yellow-200 rounded text-sm">
                        <p class="text-yellow-800">
                            Your subscription has expired but you can still access your content during the grace period.
                        </p>
                    </div>
                @endif
            @endif

            <div class="flex justify-between">
                <span>Billing Cycle:</span>
                <span>{{ $subscription->billing_cycle->label() }}</span>
            </div>

            <div class="flex justify-between">
                <span>Expires At:</span>
                <span>{{ $subscription->expires_at->format('M d, Y') }}</span>
            </div>
        </div>

        <button wire:click="cancelSubscription" class="mt-6 w-full text-red-600 border border-red-300 py-2 rounded hover:bg-red-50">
            Cancel Subscription
        </button>
    @else
        <p class="text-gray-600 mb-4">You don't have an active subscription. Start with our Free plan or upgrade to a paid plan.</p>
        <a href="{{ route('subscription.checkout') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            View Plans
        </a>
    @endif

    @if(session('success'))
        <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded text-red-800">
            {{ session('error') }}
        </div>
    @endif
</div>  