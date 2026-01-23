<main class="gap-8 w-full">

        <x-layouts.app.page-heading title="Billing & Subscription"
            subtitle="Manage your plan, payment details, and view your invoice history." />

        <x-layouts.app.settings-header />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 flex flex-col gap-8">
                <!-- Your Plan Section -->
                <div>
                    <h2
                        class="text-[#141118] dark:text-white text-xl md:text-[22px] font-bold leading-tight tracking-[-0.015em] px-1 pb-3">
                        Your Plan</h2>
                    <div
                        class="p-6 container bg-white dark:bg-background-dark/50 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] dark:shadow-none border border-gray-200 dark:border-gray-800">
                        <div class="flex flex-col items-stretch justify-start lg:flex-row lg:items-start gap-6">
                            <div class="flex w-full min-w-72 grow flex-col items-stretch justify-center gap-4">
                                @if ($userSubscription && $userSubscription->plan)
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 sm:gap-2">
                                        <p
                                            class="text-lg font-bold leading-tight tracking-[-0.015em] text-primary dark:text-primary-400">
                                            {{ $userSubscription->plan->name }}
                                        </p>
                                        <div class="flex items-center gap-2">

                                            @if ($userSubscription->plan->price != null)
                                                @switch($userSubscription->status)
                                                    @case($userSubscriptionStatus::ACTIVE)
                                                        <button wire:click="cancelSubcription"
                                                            class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-transparent text-[#756189] dark:text-gray-400 border border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-medium leading-normal">
                                                            Cancel
                                                        </button>
                                                    @break

                                                    @case($userSubscriptionStatus::CANCELLED)
                                                        <button wire:click="reEnableSubcription"
                                                            class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-transparent text-[#756189] dark:text-gray-400 border border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-medium leading-normal">
                                                            Reactivate
                                                        </button>
                                                    @break
                                                @endswitch
                                            @endif

                                            <a href="{{ route('subscription.checkout') }}"
                                                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-primary text-white text-sm font-medium leading-normal hover:bg-primary/90">Change
                                                Plan</a>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <p
                                            class="text-[#756189] dark:text-gray-400 text-base font-normal leading-normal">
                                            {{ $userSubscription->plan->description }}</p>

                                        <p
                                            class="text-[#756189] dark:text-gray-400 text-base font-normal leading-normal">
                                            @if ($userSubscription->status == $userSubscriptionStatus::ACTIVE)
                                                Next payment of <span
                                                    class="font-medium text-[#141118] dark:text-white">${{ number_format($userSubscription->plan->price, 2) }}</span>
                                                on <span
                                                    class="font-medium text-[#141118] dark:text-white">{{ $userSubscription->expires_at->format('F d, Y') }}</span>
                                            @endif
                                            @if ($userSubscription->status == $userSubscriptionStatus::CANCELLED)
                                                <strong>You’ve unsubscribed.</strong>
                                                Your benefits will end on
                                                <span class="font-medium text-[#141118] dark:text-white">
                                                    {{ $userSubscription->expires_at->format('F d, Y') }}
                                                </span>.
                                            @endif
                                        </p>
                                    </div>
                                @else
                                    <div class="flex items-center justify-center py-8">
                                        <p
                                            class="text-[#756189] dark:text-gray-400 text-base font-normal leading-normal">
                                            No active subscription found. <a href="#"
                                                class="text-primary hover:underline">Get started</a>
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if ($userSubscription->plan->price != null && $cardDetails != null)
                    <!-- Payment Details Section -->
                    <div>
                        <h2
                            class="text-[#141118] dark:text-white text-xl md:text-[22px] font-bold leading-tight tracking-[-0.015em] px-1 pb-3">
                            Payment Details</h2>
                        <div
                            class="p-6 bg-white dark:bg-background-dark/50 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] dark:shadow-none border border-gray-200 dark:border-gray-800">
                            <div class="flex flex-wrap items-center justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <span class="material-symbols-outlined text-3xl">
                                        credit_card
                                    </span>

                                    <div class="flex flex-col">
                                        <p class="text-[#141118] dark:text-white font-medium">
                                            {{ $cardDetails['brand'] . ' ending in ' . $cardDetails['last4'] }}</p>
                                        <p class="text-[#756189] dark:text-gray-400 text-sm">Expires
                                            {{ $cardDetails['exp_month'] . ' / ' . $cardDetails['exp_year'] }}</p>
                                    </div>
                                </div>
                                <button wire:click='updateCard'
                                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-transparent text-[#756189] dark:text-gray-400 border border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-medium leading-normal">Update
                                    Card</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- Right Column -->
            <div class="lg:col-span-1 flex flex-col gap-8">
                <!-- Invoice History -->
                <div>
                    <h2
                        class="text-[#141118] dark:text-white text-xl md:text-[22px] font-bold leading-tight tracking-[-0.015em] px-1 pb-3">
                        Invoices</h2>
                    <div
                        class="bg-white dark:bg-background-dark/50 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] dark:shadow-none border border-gray-200 dark:border-gray-800 overflow-hidden">
                        <ul class="divide-y divide-gray-200 dark:divide-gray-800">
                            @forelse($transactions as $transaction)
                                <li
                                    class="p-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-150">
                                    <div class="flex flex-col">
                                        <p class="font-medium text-[#141118] dark:text-white">
                                            {{ $transaction->created_at->format('F Y') }}</p>
                                        <p class="text-sm text-[#756189] dark:text-gray-400">
                                            #{{ $transaction->reference }}</p>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <p class="font-medium text-[#141118] dark:text-white">
                                            ${{ number_format($transaction->amount, 2) }}</p>
                                        <a class="text-[#756189] dark:text-gray-400 hover:text-primary dark:hover:text-white"
                                            href="{{ route('user.invoice.show', $transaction->reference) }}">
                                            <span class="material-symbols-outlined">download</span>
                                        </a>
                                    </div>
                                </li>
                            @empty
                                <li class="p-4 text-center text-[#756189] dark:text-gray-400">
                                    No transactions found
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

</main>
