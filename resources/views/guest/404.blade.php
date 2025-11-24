<x-layouts.guest>
    <main class="flex flex-1 items-center justify-center p-4 sm:p-6 md:p-8">
        <div class="flex w-full max-w-2xl flex-col items-center gap-8 text-center">
            <div class="flex flex-col items-center gap-6">
               

                <div class="flex max-w-lg flex-col items-center gap-2">
                    <h1
                        class="text-3xl text-red-500 font-bold leading-tight tracking-tighter text-text-primary-light dark:text-text-primary-dark">
                        Page Not Found
                    </h1>
                    <p
                        class="text-base font-normal leading-normal text-text-secondary-light dark:text-text-secondary-dark">
                        We can't seem to find the page you're looking for. It might
                        have been moved, renamed, or is temporarily unavailable.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <a href="{{route('guest.welcome')}}"
                        class="flex w-full sm:w-auto min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 px-6 bg-primary text-white text-base font-medium leading-normal tracking-wide shadow-sm hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-background-dark">
                        <span class="truncate">Return to Home</span>
                    </a>
                    <a class="text-sm font-medium text-primary hover:underline" href="mailto:{{config('mail.from.address')}}">Contact Support</a>
                </div>
            </div>
            <div class="w-full max-w-md text-left">
                <h3
                    class="text-lg font-bold leading-tight tracking-tight text-text-primary-light dark:text-text-primary-dark px-4 pb-2 pt-4">
                    Troubleshooting Steps
                </h3>
                <div
                    class="flex flex-col border border-border-light dark:border-border-dark rounded-xl overflow-hidden">
                    <div
                        class="flex items-center gap-4 px-4 min-h-16 border-b border-border-light dark:border-border-dark">
                        <div
                            class="text-text-secondary-light dark:text-text-secondary-dark flex items-center justify-center shrink-0 size-10">
                            <span class="material-symbols-outlined text-2xl">link</span>
                        </div>
                        <p
                            class="text-base font-normal leading-normal flex-1 truncate text-text-secondary-light dark:text-text-secondary-dark">
                            Check the URL for any typos.
                        </p>
                    </div>
                    <div
                        class="flex items-center gap-4 px-4 min-h-16 border-b border-border-light dark:border-border-dark">
                        <div
                            class="text-text-secondary-light dark:text-text-secondary-dark flex items-center justify-center shrink-0 size-10">
                            <span class="material-symbols-outlined text-2xl">history</span>
                        </div>
                        <p
                            class="text-base font-normal leading-normal flex-1 truncate text-text-secondary-light dark:text-text-secondary-dark">
                            Clear your browser cache and cookies.
                        </p>
                    </div>
                    <div class="flex items-center gap-4 px-4 min-h-16">
                        <div
                            class="text-text-secondary-light dark:text-text-secondary-dark flex items-center justify-center shrink-0 size-10">
                            <span class="material-symbols-outlined text-2xl">wifi</span>
                        </div>
                        <p
                            class="text-base font-normal leading-normal flex-1 truncate text-text-secondary-light dark:text-text-secondary-dark">
                            Ensure your internet connection is stable.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layouts.guest>
