<x-layouts.app>
    <!-- Header -->
    <header class="flex items-center justify-between py-3 mb-8">
        <div class="flex items-center gap-2 text-[#140d1b] dark:text-white">
            <div class="size-5">
                <img src="{{ asset(config('app.logo')) }}" alt="" srcset="">
            </div>
            <h2 class="text-xl font-bold leading-tight tracking-[-0.015em]">{{ config('app.name') }}</h2>
        </div>
        <a href="{{ route('user.subscription.manage') }}"
            class="flex h-10 w-10 cursor-pointer items-center justify-center rounded-full bg-background-light dark:bg-background-dark/50 text-[#140d1b] dark:text-white hover:bg-gray-200 dark:hover:bg-background-dark transition-colors">
            <span class="material-symbols-outlined text-2xl">close</span>
        </a>
    </header>

    <!-- Main Content Area -->
    <main class="flex flex-1 flex-col items-center pt-8">
        <!-- Illustration -->
        <div class="flex w-full justify-center">
            <div class="relative flex h-48 w-48 items-center justify-center">
                <div class="absolute inset-0 rounded-full 
                    @if($transaction->status === 'successful')
                        bg-green-500/10 dark:bg-green-500/20
                    @elseif($transaction->status === 'pending')
                        bg-yellow-500/10 dark:bg-yellow-500/20
                    @elseif($transaction->status === 'refunded')
                        bg-blue-500/10 dark:bg-blue-500/20
                    @else
                        bg-red-500/10 dark:bg-red-500/20
                    @endif"></div>
                <div class="absolute inset-4 rounded-full 
                    @if($transaction->status === 'successful')
                        bg-green-500/10 dark:bg-green-500/20
                    @elseif($transaction->status === 'pending')
                        bg-yellow-500/10 dark:bg-yellow-500/20
                    @elseif($transaction->status === 'refunded')
                        bg-blue-500/10 dark:bg-blue-500/20
                    @else
                        bg-red-500/10 dark:bg-red-500/20
                    @endif"></div>
                <div
                    class="relative flex h-28 w-28 items-center justify-center rounded-full bg-white dark:bg-[#2a1a3d] shadow-lg">
                    @if($transaction->status === 'successful')
                        <span class="material-symbols-outlined text-6xl text-green-500">check_circle</span>
                    @elseif($transaction->status === 'pending')
                        <span class="material-symbols-outlined text-6xl text-yellow-500">schedule</span>
                    @elseif($transaction->status === 'refunded')
                        <span class="material-symbols-outlined text-6xl text-blue-500">refund</span>
                    @else
                        <span class="material-symbols-outlined text-6xl text-red-500">cancel</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Headline -->
        <h1
            class="text-[#140d1b] dark:text-white text-3xl font-extrabold leading-tight tracking-tight pt-10 pb-2 text-center">
            Invoice #{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</h1>

        <!-- Body Text -->
        <p class="text-[#734c9a] dark:text-gray-400 text-base font-normal leading-normal text-center pb-8">
            Transaction from {{ $transaction->created_at->format('F d, Y') }}
        </p>

        <!-- Order Summary Card -->
        <div class="w-full rounded-xl bg-white dark:bg-[#1f142b] p-5 shadow-sm">
            <div class="flex flex-col divide-y divide-gray-200/50 dark:divide-gray-600/30">
                <div class="flex justify-between gap-x-6 py-3">
                    <p class="text-[#734c9a] dark:text-gray-400 text-sm font-normal leading-normal">Gateway</p>
                    <p class="text-[#140d1b] dark:text-gray-200 text-sm font-semibold leading-normal text-right">
                        {{ ucfirst(str_replace('_', ' ', $transaction->gateway)) }}
                    </p>
                </div>

                <div class="flex justify-between gap-x-6 py-3">
                    <p class="text-[#734c9a] dark:text-gray-400 text-sm font-normal leading-normal">Status</p>
                    <p class="text-[#140d1b] dark:text-gray-200 text-sm font-semibold leading-normal text-right">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium
                            @if($transaction->status === 'successful')
                                bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                            @elseif($transaction->status === 'pending')
                                bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                            @elseif($transaction->status === 'refunded')
                                bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400
                            @else
                                bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400
                            @endif">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </p>
                </div>

                @if($transaction->reference)
                <div class="flex justify-between gap-x-6 py-3">
                    <p class="text-[#734c9a] dark:text-gray-400 text-sm font-normal leading-normal">Reference</p>
                    <p class="text-[#140d1b] dark:text-gray-200 text-sm font-semibold leading-normal text-right break-words max-w-xs">
                        {{ $transaction->reference }}
                    </p>
                </div>
                @endif

                @if($transaction->processor_reference)
                <div class="flex justify-between gap-x-6 py-3">
                    <p class="text-[#734c9a] dark:text-gray-400 text-sm font-normal leading-normal">Processor Reference</p>
                    <p class="text-[#140d1b] dark:text-gray-200 text-sm font-semibold leading-normal text-right break-words max-w-xs">
                        {{ $transaction->processor_reference }}
                    </p>
                </div>
                @endif

                @php
                    $hasCoupon = $transaction->meta && isset($transaction->meta['coupon_code']);
                    $originalPrice = $transaction->meta['original_price'] ?? $transaction->amount;
                    $discount = $originalPrice - $transaction->amount;
                @endphp

                @if($hasCoupon)
                <div class="flex justify-between gap-x-6 py-3">
                    <p class="text-[#734c9a] dark:text-gray-400 text-sm font-normal leading-normal">Original Price</p>
                    <p class="text-[#140d1b] dark:text-gray-200 text-sm font-semibold leading-normal text-right">
                        ${{ number_format($originalPrice, 2) }}
                    </p>
                </div>

                <div class="flex justify-between gap-x-6 py-3">
                    <p class="text-[#734c9a] dark:text-gray-400 text-sm font-normal leading-normal">Coupon Code</p>
                    <p class="text-[#140d1b] dark:text-gray-200 text-sm font-semibold leading-normal text-right">
                        {{ $transaction->meta['coupon_code'] }}
                    </p>
                </div>

                <div class="flex justify-between gap-x-6 py-3">
                    <p class="text-[#734c9a] dark:text-gray-400 text-sm font-normal leading-normal">Discount</p>
                    <p class="text-[#140d1b] dark:text-gray-200 text-sm font-semibold leading-normal text-right text-green-600">
                        -${{ number_format($discount, 2) }}
                    </p>
                </div>
                @endif

                <div class="flex justify-between gap-x-6 py-3">
                    <p class="text-[#734c9a] dark:text-gray-400 text-sm font-normal leading-normal">Amount Paid</p>
                    <p class="text-[#140d1b] dark:text-gray-200 text-sm font-semibold leading-normal text-right text-lg">
                        ${{ number_format($transaction->amount, 2) }}
                    </p>
                </div>

                <div class="flex justify-between gap-x-6 py-3">
                    <p class="text-[#734c9a] dark:text-gray-400 text-sm font-normal leading-normal">
                        Date</p>
                    <p class="text-[#140d1b] dark:text-gray-200 text-sm font-semibold leading-normal text-right">
                        {{ $transaction->created_at->format('M d, Y \a\t H:i A') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex w-full flex-col gap-3 pt-8">
            <a href="{{ route('user.subscription.manage') }}"
                class="flex w-full cursor-pointer items-center justify-center rounded-lg h-12 bg-primary text-white text-base font-bold leading-normal tracking-wide shadow-lg shadow-primary/30 transition-transform hover:scale-[1.02] active:scale-[0.98]">
                Back to Billing
            </a>

        
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full py-6 text-center">
        <a class="text-sm text-[#734c9a] dark:text-gray-500 hover:underline" href="#">Need help?
            Contact Support</a>
    </footer>

</x-layouts.app>
