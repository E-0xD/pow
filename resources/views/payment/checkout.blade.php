<x-layouts.app>
    <!-- Confirmation Modal (hidden by default) -->
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4 hidden" id="confirmation-modal">
        <div
            class="flex w-full max-w-sm flex-col items-center gap-6 rounded-xl bg-background-light dark:bg-background-dark p-8 shadow-2xl">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/50">
                <span class="material-symbols-outlined text-4xl text-green-500 dark:text-green-400">check_circle</span>
            </div>
            <div class="flex flex-col items-center gap-2 text-center">
                <h3 class="text-2xl font-bold text-[#140d1b] dark:text-white">
                    Payment Successful!
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Your transaction has been confirmed. You can now access
                    all the features of your new plan.
                </p>
            </div>
            <button
                class="h-12 w-full rounded-lg bg-primary text-base font-bold text-white transition-transform hover:scale-[1.02] active:scale-[0.98]">
                Go to Dashboard
            </button>
        </div>
    </div>
    <!-- Main Content -->
    <div class="relative flex min-h-screen w-full flex-col group/design-root">
        <div class="layout-container flex h-full grow flex-col">
            <div class="flex flex-1 justify-center p-4 sm:p-5">
                <div class="layout-content-container flex w-full max-w-md flex-1 flex-col space-y-10">
                    <!-- Header -->
                    <header class="flex items-center justify-between whitespace-nowrap p-4">
                        <button
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

                    <div class="flex flex-wrap justify-between gap-3 p-4">
                        <p
                            class="text-[#140d1b] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em] min-w-72">
                            Checkout
                        </p>
                    </div>


                    <!-- Payment Method Section -->
                    <div class="flex flex-col items-center gap-2 w-full max-w-md">
                        <div
                            class="flex w-full max-w-xs items-center justify-center rounded-full bg-primary/10 dark:bg-primary/20 p-1">
                            <label
                                class="flex cursor-pointer h-full flex-1 items-center justify-center overflow-hidden rounded-full px-2 py-1.5 has-[:checked]:bg-white dark:has-[:checked]:bg-background-dark has-[:checked]:shadow-soft text-text-muted-light dark:text-text-muted-dark has-[:checked]:text-text-light dark:has-[:checked]:text-text-dark text-sm font-medium transition-all duration-300">
                                <span class="truncate">Pay with Card</span>
                                <input checked="" class="invisible w-0" name="billing-cycle" type="radio"
                                    value="monthly" />
                            </label>
                            <label
                                class="flex cursor-pointer h-full flex-1 items-center justify-center overflow-hidden rounded-full px-2 py-1.5 has-[:checked]:bg-white dark:has-[:checked]:bg-background-dark has-[:checked]:shadow-soft text-text-muted-light dark:text-text-muted-dark has-[:checked]:text-text-light dark:has-[:checked]:text-text-dark text-sm font-medium transition-all duration-300">
                                <span class="truncate">Pay with Crypto</span>
                                <input class="invisible w-0" name="billing-cycle" type="radio" value="yearly" />
                            </label>
                        </div>

                    </div>

                    <!-- Order Summary Card -->
                    <div
                        class="m-4 mt-6 rounded-xl bg-white dark:bg-white/5 p-6 shadow-[0_10px_30px_-5px_rgba(127,19,236,0.1)] dark:shadow-none border border-transparent dark:border-white/10">
                        <h3 class="text-xl font-bold text-[#140d1b] dark:text-white mb-4">
                            Order Summary
                        </h3>
                        <div class="flex flex-col gap-3 text-sm text-gray-600 dark:text-gray-300">
                            <div class="flex justify-between">
                                <span>Plan</span>
                                <span class="font-semibold text-[#140d1b] dark:text-white">Pro Annual Plan</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Email</span>
                                <span class="font-semibold text-[#140d1b] dark:text-white">user@example.com</span>
                            </div>
                            <hr class="my-2 border-dashed border-gray-200 dark:border-white/20" />
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span>$120.00</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Tax (10%)</span>
                                <span>$12.00</span>
                            </div>
                            <div class="flex justify-between text-base font-bold text-[#140d1b] dark:text-white">
                                <span>Total</span>
                                <span>$132.00</span>
                            </div>
                            <div
                                class="mt-2 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                <span>Invoice ID:</span>
                                <span>INV-2024-84B21</span>
                            </div>
                        </div>
                        <div class="mt-6 flex gap-2">
                            <input
                                class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-sm text-[#140d1b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#dbcfe7] dark:border-white/20 bg-background-light dark:bg-background-dark/80 focus:border-primary/80 h-11 placeholder:text-[#734c9a] dark:placeholder:text-white/40 px-3"
                                placeholder="Promo Code" />
                            <button
                                class="flex h-11 cursor-pointer items-center justify-center rounded-lg bg-primary/10 dark:bg-primary/20 px-4 text-sm font-bold text-primary dark:text-white transition-colors hover:bg-primary/20 dark:hover:bg-primary/30">
                                Apply
                            </button>
                        </div>
                    </div>
                    <!-- Pay Button & Security Footer -->
                    <div
                        class="sticky bottom-0 bg-background-light dark:bg-background-dark/80 backdrop-blur-sm p-4 mt-auto">
                        <button
                            class="h-14 w-full rounded-xl bg-primary bg-gradient-to-r from-primary to-[#a855f7] text-lg font-bold text-white shadow-lg shadow-primary/30 transition-transform hover:scale-[1.02] active:scale-[0.98]">
                            Pay $132.00
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

</x-layouts.app>
