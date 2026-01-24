<!-- Admin Sidebar -->
<aside
    class="hidden md:flex fixed left-0 top-0 w-64 h-[100dvh] bg-white dark:bg-[#0b0710] border-r border-[#E5E7EB] dark:border-white/10 flex-col shrink-0">
    <div class="flex h-full max-h-full flex-col justify-between p-4">
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-3 p-2">
                <span class="text-2xl font-black text-primary">POW Admin</span>
            </div>

            <div class="flex flex-col gap-2">
                <a @class([
                    'flex items-center gap-3 px-3 py-2 rounded-lg',
                    'bg-primary/10 dark:bg-primary/20 text-primary dark:text-white' => request()->routeIs(
                        'admin.index'),
                    'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => !request()->routeIs(
                        'admin.index'),
                ]) href="{{ route('admin.index') }}">
                    <span class="material-symbols-outlined text-2xl">space_dashboard</span>
                    <p class="text-sm font-bold leading-normal">Controls</p>
                </a>

                <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300"
                    href="https://nightwatch.laravel.com/sign-in" target="_blank">
                    <span class="material-symbols-outlined text-2xl">monitor_heart</span>
                    <p class="text-sm font-bold leading-normal">Monitor</p>
                </a>

            </div>
        </div>

        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-1">

                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button
                        class="flex w-full items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300"
                        type="submit">
                        <span class="material-symbols-outlined text-2xl">logout</span>
                        <p class="text-sm font-medium leading-normal">Log out</p>
                    </button>
                </form>
            </div>

            <div class="flex gap-3 items-center border-t border-[#E5E7EB] dark:border-white/10 pt-4">
                <div class="flex flex-col">
                    <h1 class="text-[#1F2937] dark:text-white text-base font-medium leading-normal">
                        {{ Auth::user()->name }}</h1>
                    <p class="text-[#6B7280] dark:text-gray-400 text-sm font-normal leading-normal">
                        {{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
    </div>
</aside>
