<nav
    class="fixed bottom-0 left-0 right-0 z-50 bg-white dark:bg-[#0b0710] border-t border-[#E5E7EB] dark:border-white/10 flex justify-around items-center py-2 px-1 md:hidden">
    <a href="{{ route('admin.index') }}" @class([
        'flex flex-col items-center rounded-lg px-3 py-1',
        'bg-primary/10 dark:bg-primary/20 text-primary dark:text-white' => request()->routeIs(
            'admin.index'),
        'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => !request()->routeIs(
            'admin.index'),
    ])>
        <span class="material-symbols-outlined text-2xl">space_dashboard</span>
        <span class="text-xs font-medium">Controls</span>
    </a>

    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button
            class="flex w-full items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300"
            type="submit">
            <span class="material-symbols-outlined text-2xl">logout</span>
            <p class="text-sm font-medium leading-normal">Log out</p>
        </button>
    </form>
</nav>
