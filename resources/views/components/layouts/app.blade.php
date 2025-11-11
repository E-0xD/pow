<!DOCTYPE html>

<html class="light" lang="en">

   @include('partials.head')

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

         @include('partials.live-chat')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @stack('scripts')
    </body>

</html>
