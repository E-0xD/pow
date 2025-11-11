<x-layouts.app>

    <div x-data="{
        showToast: false,
        toastMessage: '',
        toastType: 'success',
        copyToClipboard(value) {
            if (!value) return;
            navigator.clipboard.writeText(value).then(() => {
                this.toastMessage = '{{ __('Copied to clipboard') }}';
                this.toastType = 'success';
                this.showToast = true;
                setTimeout(() => this.showToast = false, 3000);
            }).catch(() => {
                this.toastMessage = '{{ __('Unable to copy') }}';
                this.toastType = 'error';
                this.showToast = true;
                setTimeout(() => this.showToast = false, 3000);
            });
        }
    }">

        <!-- Toast (client-side) -->
        <div x-show="showToast" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2" class="fixed top-5 right-5 z-50" style="display: none;">
            <div :class="toastType === 'success' ? 'bg-green-500 text-white' : (toastType === 'error' ? 'bg-red-500 text-white' :
                'bg-blue-500 text-white')"
                class="flex items-center gap-3 max-w-sm rounded-lg p-4 shadow-md">
                <span class="material-symbols-outlined"
                    x-text="toastType === 'success' ? 'check_circle' : (toastType === 'error' ? 'error' : 'info')"></span>
                <span class="flex-1" x-text="toastMessage"></span>
                <button @click="showToast = false" class="ml-2 focus:outline-none">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
        </div>

        <!-- PageHeading & ToolBar -->
        <x-layouts.app.page-heading title="Your Proof Of Work"
            subtitle="All your active and draft portfolios with quick access to manage them." :link="[
                'url' => route('user.portfolio.create'),
                'text' => 'Create New Portfolio',
                'icon' => '<span class=\'material-symbols-outlined\'>add_circle</span>',
            ]" />

        @if ($portfolios->count())

            <!-- ImageGrid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6">

                @foreach ($portfolios as $portfolio)
                    <!-- Portfolio Card -->
                    <div
                        class="flex flex-col group bg-white dark:bg-gray-900/50 rounded-xl overflow-hidden shadow-sm hover:shadow-lg border border-gray-200 dark:border-gray-800 transition-all duration-300">
                        <div class="w-full bg-center bg-no-repeat aspect-[4/3] bg-cover"
                            data-alt="Abstract purple and blue gradient background"
                            style="background-image: url('{{ optional($portfolio->about)->logo ? Storage::url($portfolio->about->logo) : asset(str_replace('\\', '/', config('app.logo'))) }}');
                            ">
                        </div>

                        <div class="p-4 flex flex-col flex-1">
                            <p class="text-gray-900 dark:text-white text-base font-bold leading-normal mb-2">
                                {{ $portfolio->title }}
                            </p>
                            <d iv class="flex items-center gap-4 text-gray-500 dark:text-gray-400 text-xs mb-4">
                                <div class="flex items-center gap-1"><span
                                        class="material-symbols-outlined text-sm">visibility</span>{{ $portfolio->visits->count() }}
                                </div>
                                <div class="flex items-center gap-1"><span
                                        class="material-symbols-outlined text-sm">ads_click</span>
                                    {{ $portfolio->clicks->count() }}</div>
                                <div class="flex items-center gap-1"><span
                                        class="material-symbols-outlined text-sm">chat_bubble</span>
                                    {{ $portfolio->messages->where('read', false)->count() }}</div>
                            </d>

                            <div class="mt-auto flex justify-around items-center w-full gap-2">
                                @if ($portfolio->activeSubscription)
                                    <a href="{{ route('user.portfolio.customize', $portfolio->uid) }}"
                                        class="flex flex-1 items-center justify-center py-2 px-3 text-sm font-semibold rounded-lg 
                                    bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                                        <span class="material-symbols-outlined text-base">edit</span>
                                    </a>
                                    <a href="{{ route('user.portfolio.edit', $portfolio->uid) }}"
                                        class="flex flex-1 items-center justify-center py-2 px-3 text-sm font-semibold rounded-lg 
                                    bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                                        <span class="material-symbols-outlined text-base">settings</span>
                                    </a>
                                    <a href="{{ route('user.portfolio.analytics', $portfolio->uid) }}"
                                        class="flex flex-1 items-center justify-center py-2 px-3 text-sm font-semibold rounded-lg 
                                    bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                                        <span class="material-symbols-outlined text-base">
                                            bar_chart
                                        </span>
                                    </a>
                                    <button
                                        data-copy="{{ $portfolio->slug . '.' . parse_url(config('app.url'), PHP_URL_HOST) }}"
                                        @click.prevent="copyToClipboard($event.currentTarget.dataset.copy)"
                                        class="flex flex-1 items-center justify-center py-2 px-3 text-sm font-semibold rounded-lg 
                                        bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                                        <span class="material-symbols-outlined text-base">share</span>
                                    </button>
                                @else
                                    <a href="{{ route('payment.checkout', $portfolio->uid) }}"
                                        class="flex flex-1 items-center justify-center py-2 px-3 text-sm font-semibold rounded-lg 
                                    bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                                        <span class="text-base flex justify-center align-center gap-2">
                                            <span class="material-symbols-outlined">account_balance_wallet</span>
                                            Complete Payment
                                        </span>
                                    </a>
                                @endif

                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center gap-6 mt-16 text-center">
                <div class="text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" fill="currentColor"
                        class="bi bi-collection" viewBox="0 0 16 16">
                        <path
                            d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm1.5.5A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13z" />
                    </svg>
                </div>
                <div class="flex max-w-md flex-col items-center gap-2">
                    <p class="text-gray-900 dark:text-white text-lg font-bold">No portfolios yet</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-normal">Start building your first portfolio
                        to share
                        your work with the world.</p>
                </div>
                <a href="{{ route('user.portfolio.create') }}"
                    class="flex min-w-[84px] items-center justify-center gap-2 overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold shadow-sm hover:opacity-90 transition-opacity">
                    <span class="material-symbols-outlined">add_circle</span>
                    <span class="truncate">Create New Portfolio</span>
                </a>
            </div>
        @endif

</x-layouts.app>
