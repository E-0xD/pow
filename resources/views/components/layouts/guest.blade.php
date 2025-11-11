<!DOCTYPE html>

<html class="light" lang="en">

    @include('partials.head')

    <body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
        <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
            <div class="layout-container flex h-full grow flex-col">
                <div class="flex flex-1 justify-center py-5">
                    <div class="layout-content-container flex flex-col w-full max-w-6xl px-4 md:px-10">
                        <!-- TopNavBar -->
                        <x-layouts.guest.header />
                        <main class="flex flex-col gap-16 md:gap-24 py-16 md:py-24">
                            <x-toast />
                            {{ $slot }}
                        </main>
                        <!-- Footer -->
                        <x-layouts.guest.footer />
                    </div>
                </div>
            </div>
        </div>
        @include('partials.live-chat')
        @livewireScripts
        @stack('scripts')
    </body>

</html>
