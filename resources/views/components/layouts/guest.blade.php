<!DOCTYPE html>

<html class="dark" lang="en">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>{{ config('app.name') }}</title>

        <link href="https://fonts.googleapis.com" rel="preconnect" />
        <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;display=swap"
            rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24
            }
        </style>

        @stack('styles')
    </head>

    <body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
        <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
            <div class="layout-container flex h-full grow flex-col">
                <div class="flex flex-1 justify-center py-5">
                    <div class="layout-content-container flex flex-col w-full max-w-6xl px-4 md:px-10">
                        <!-- TopNavBar -->
                        <x-layouts.guest.header />
                         <main class="flex flex-col gap-16 md:gap-24 py-16 md:py-24">
                        {{ $slot }}
                         </main>
                        <!-- Footer -->
                        <x-layouts.guest.footer />
                    </div>
                </div>
            </div>
        </div>

        @livewireScripts
        @stack('scripts')
    </body>

</html>
