<div>

    {{-- select plan  --}}
    @if (!$selectedPlan)
        <div class="flex flex-col max-w-6xl w-full flex-1 items-center">
            <!-- PageHeading -->
            <div class="flex flex-col items-center justify-center gap-4 text-center mb-8 sm:mb-12">
                <p class="text-4xl md:text-5xl font-black tracking-tighter max-w-3xl">Choose the plan that's right for
                    you
                </p>
                <p class="text-base md:text-lg font-normal text-text-muted-light dark:text-text-muted-dark max-w-xl">
                    Select a
                    plan to get started with your portfolio. Cancel anytime.</p>
            </div>

            <div class="flex flex-col items-center gap-2 w-full max-w-md">
                <div
                    class="flex w-full max-w-xs items-center justify-center rounded-full bg-primary/10 dark:bg-primary/20 p-1">
                    <button wire:click="updateBillingCycle('monthly')"
                        class="
                            flex cursor-pointer h-full flex-1 items-center justify-center overflow-hidden rounded-full
                            px-2 py-1.5 text-sm font-medium transition-all duration-300

                            {{ $selectedBillingCycle == 'monthly'
                                ? 'bg-white dark:bg-background-dark shadow-soft text-text-light dark:text-text-dark'
                                : 'text-text-muted-light dark:text-text-muted-dark' }}
                        ">
                        <span class="truncate">Monthly</span>
                    </button>

                    <button wire:click="updateBillingCycle('yearly')"
                        class="
                            flex cursor-pointer h-full flex-1 items-center justify-center overflow-hidden rounded-full
                            px-2 py-1.5 text-sm font-medium transition-all duration-300

                            {{ $selectedBillingCycle === 'yearly'
                                ? 'bg-white dark:bg-background-dark shadow-soft text-text-light dark:text-text-dark'
                                : 'text-text-muted-light dark:text-text-muted-dark' }}
                        ">
                        <span class="truncate">Yearly</span>
                    </button>

                </div>

            </div>

            <!-- PricingCards -->
            <div
                class="mt-6 grid w-full gap-6
           grid-cols-1
           sm:[grid-template-columns:repeat(auto-fit,minmax(0,1fr))]">
                <!-- Card 1: Free -->
                @forelse($plans as $tier => $cycles)
                    @php $plan = $cycles[$selectedBillingCycle] ?? null; @endphp
                    <div
                        class="relative flex flex-col gap-6 rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-background-dark/50 p-6 shadow-soft hover:shadow-soft-lg hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                        @if ($currentPlan?->plan_id == $plan->id)
                            <span class="absolute top-4 right-4 rounded-full px-3 py-1 text-xs font-bold bg-primary/10 text-primary dark:bg-primary/20">
                                Current Plan
                            </span>
                        @endif

                        <div class="flex flex-col gap-2">

                            <p class="flex items-baseline gap-1">
                                <span class="text-4xl font-black tracking-tight">${{ $plan->price ?? 0 }}</span>
                                <span class="text-base font-bold text-text-muted-light dark:text-text-muted-dark">
                                    {{ $plan->name }}</span>
                            </p>
                            <p class="text-sm text-text-muted-light dark:text-text-muted-dark">{{ $plan->description }}
                            </p>
                        </div>

                        @if ($currentPlan?->plan_id == $plan->id)
                            <div
                                class="flex w-full cursor-pointer items-center  overflow-hidden rounded-lg h-10 px-4 text-primary text-sm font-bold transition-colors">
                                
                            </div>
                        @else
                            <button wire:click="selectPlan('{{ $tier }}')"
                                class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/10 dark:bg-primary/20 text-primary text-sm font-bold hover:bg-primary/20 dark:hover:bg-primary/30 transition-colors">
                                <span class="truncate"> Get Started</span>
                            </button>
                        @endif

                        <div class="flex flex-col gap-3 pt-2 border-t border-border-light dark:border-border-dark">

                            @forelse ($plan->tier->features as $feature)
                                @php
                                    $value = $feature->pivot->value;
                                    $isEnabled = $value != false && $value != 0 && $value != 'false';
                                    $isBooleanType = $feature->type === 'boolean';
                                @endphp

                                <div class="flex items-center gap-3 text-sm">
                                    <span
                                        class="material-symbols-outlined text-base
                                        {{ $isEnabled ? 'text-primary' : 'text-red-500' }}">
                                        {{ $isEnabled ? 'check_circle' : 'cancel' }}
                                    </span>

                                    <span class="{{ $isEnabled ? '' : 'line-through opacity-60' }}">
                                        {{ $feature->name }}
                                        @if (!$isBooleanType && $isEnabled)
                                            <span class="font-semibold">({{ $value }})</span>
                                        @endif
                                    </span>
                                </div>
                            @empty
                                <p class="text-xs text-text-muted-light dark:text-text-muted-dark">No features</p>
                            @endforelse

                        </div>
                    </div>
                @empty
                    <p>No plans available</p>
                @endforelse

            </div>
        </div>
    @endif

    {{-- order confirmation  --}}
    @if ($selectedPlan)
        <!-- Main Content -->
        <div class="flex flex-col max-w-6xl w-full flex-1 items-center">
            <div class="layout-container flex h-full grow flex-col">
                <div class="flex flex-1 justify-center p-4 sm:p-5">
                    <div class="layout-content-container flex w-full max-w-md flex-1 flex-col space-y-10">
                        <!-- Header -->
                        <header class="flex items-center justify-between whitespace-nowrap p-4">
                            <button type="button" wire:click="removeSelectedPlan"
                                class="flex h-10 w-10 cursor-pointer items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-primary/20 dark:text-white">
                                <span class="material-symbols-outlined">arrow_back</span>
                            </button>
                            <div class="flex items-center gap-2 text-[#140d1b] dark:text-white">
                                <div class="h-6 w-6 text-primary">
                                    <img src="{{ asset(config('app.logo')) }}" alt="" srcset="">
                                </div>
                                <h2 class="text-2xl font-bold leading-tight tracking-[-0.015em]">
                                    {{ config('app.name') }}
                                </h2>
                            </div>
                            <div class="w-10"></div>
                        </header>

                        <!-- Payment Method Section -->

                        <!-- Order Summary Card -->
                        <div
                            class="m-4 mt-6 rounded-xl bg-white dark:bg-white/5 p-6 shadow-[0_10px_30px_-5px_rgba(127,19,236,0.1)] dark:shadow-none border border-transparent dark:border-white/10">
                            <h3 class="text-xl font-bold text-[#140d1b] dark:text-white mb-4">
                                Order Summary
                            </h3>
                            <div class="flex flex-col gap-3 text-sm text-gray-600 dark:text-gray-300">

                                <div class="flex justify-between">
                                    <span>Plan</span>
                                    <span
                                        class="font-semibold text-[#140d1b] dark:text-white">{{ $selectedPlan['name'] }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Email</span>
                                    <span
                                        class="font-semibold text-[#140d1b] dark:text-white">{{ Auth::user()->email }}</span>
                                </div>
                                <hr class="my-2 border-dashed border-gray-200 dark:border-white/20" />
                                <div class="flex justify-between">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($this->finalPrice, 2) }}</span>
                                </div>

                                {{-- <div class="flex justify-between">
                                    <span>Tax (0%)</span>
                                    <span>$0</span>
                                </div> --}}

                                <div class="flex justify-between text-base font-bold text-[#140d1b] dark:text-white">
                                    <span>Total</span>
                                    <span>${{ number_format($this->finalPrice, 2) }}</span>
                                </div>
                                <div
                                    class="mt-2 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                    <span>Invoice ID:</span>
                                    <span>WOULD BE SENT VIA EMAIL</span>
                                </div>

                            </div>
                            <div class="mt-6 flex gap-2">
                                <input wire:model="couponCode"
                                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-sm text-[#140d1b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#dbcfe7] dark:border-white/20 bg-background-light dark:bg-background-dark/80 focus:border-primary/80 h-11 placeholder:text-[#734c9a] dark:placeholder:text-white/40 px-3"
                                    placeholder="Promo Code" />
                                <button wire:click="applyCoupon"
                                    class="flex h-11 cursor-pointer items-center justify-center rounded-lg bg-primary/10 dark:bg-primary/20 px-4 text-sm font-bold text-primary dark:text-white transition-colors hover:bg-primary/20 dark:hover:bg-primary/30">
                                    Apply
                                </button>
                            </div>
                            @if ($appliedCoupon)
                                <div class="text-primary w-full text-sm mt-2">
                                    {{ $appliedCoupon->type->message($appliedCoupon->discount_value ?? $appliedCoupon->months_value) }}
                                </div>
                            @endif
                            @if ($couponError)
                                <div class="mt-2 text-red-500 text-sm">
                                    {{ $couponError }}
                                </div>
                            @endif
                        </div>
                        <!-- Pay Button & Security Footer -->
                        <div
                            class="sticky bottom-0 bg-background-light dark:bg-background-dark/80 backdrop-blur-sm p-4 mt-auto">
                            <button type="button" wire:click="pay"
                                class="h-14 w-full rounded-xl bg-primary text-lg font-bold text-white shadow-lg shadow-primary/30 transition-transform hover:scale-[1.02] active:scale-[0.98]">
                                Pay ${{ number_format($this->finalPrice, 2) }}
                            </button>
                            <div
                                class="mt-4 flex items-center justify-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                <span class="material-symbols-outlined text-base">lock</span>
                                <span>Secure payment</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
