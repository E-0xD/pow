<!DOCTYPE html>

<html class="light" lang="en">

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

    <body class="font-display bg-background-light dark:bg-background-dark text-[#1F2937] dark:text-gray-200">
        <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
            <div class="flex flex-row min-h-screen ">
                <!-- SideNavBar (user or admin depending on host) -->
                @php $isAdminHost = Str::startsWith(request()->getHost(), 'admin.'); @endphp
                @if ($isAdminHost)
                    <x-layouts.app.admin-sidebar />
                    <x-layouts.app.admin-mobile-bottom-bar />
                @else
                    <x-layouts.app.sidebar />
                    <x-layouts.app.mobile-bottom-bar />
                @endif
                <!-- Main Content -->
                <main class="flex-1 p-6 lg:p-10 md:ml-64 pb-20 md:pb-0">
                    <x-toast />

                    {{ $slot }}

                </main>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @stack('scripts')
    </body>

</html>
