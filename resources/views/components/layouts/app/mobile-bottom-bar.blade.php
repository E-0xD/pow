<nav
    class="fixed bottom-0 left-0 right-0 z-50 bg-white dark:bg-[#110A19] border-t border-[#E5E7EB] dark:border-white/10 flex justify-around items-center py-2 px-1 md:hidden">
    <a href="{{ route('user.dashboard') }}" @class([
        'flex flex-col items-center rounded-lg px-3 py-1',
        'bg-primary/10 dark:bg-primary/20 text-primary dark:text-white' => request()->routeIs(
            'user.dashboard'),
        'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => !request()->routeIs(
            'user.dashboard'),
    ])>
        <span class="material-symbols-outlined text-2xl">dashboard</span>
        <span class="text-xs font-medium">Home</span>
    </a>

    <a href="{{ route('user.portfolio.index') }}" @class([
        'flex flex-col items-center rounded-2xl px-3 py-1',
        'dark:bg-primary/20 text-primary dark:text-white bg-primary/10' => request()->routeIs(
            'user.portfolio.*'),
        'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => !request()->routeIs(
            'user.portfolio.*'),
    ])>
        <span class="material-symbols-outlined text-2xl">image</span>
        <span class="text-xs font-medium">Portfolio</span>
    </a>

    <a href="{{ route('user.messages.index') }}" @class([
        'flex flex-col items-center rounded-2xl px-3 py-1',
        'dark:bg-primary/20 text-primary dark:text-white bg-primary/10' => request()->routeIs(
            'user.messages.*'),
        'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => !request()->routeIs(
            'user.messages.*'),
    ])>
        <span class="material-symbols-outlined text-2xl">
            mail
        </span>
        <span class="text-xs font-medium">Inbox</span>
    </a>

    @if (Auth::user()->affiliate)
        <a href="{{ route('user.affiliate.index') }}" @class([
            'flex flex-col items-center rounded-2xl px-3 py-1',
            'dark:bg-primary/20 text-primary dark:text-white bg-primary/10' => request()->routeIs(
                'user.affiliate.*'),
            'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => !request()->routeIs(
                'user.affiliate.*'),
        ])>
            <span class="material-symbols-outlined text-2xl">
                network_node
            </span>
            <span class="text-xs font-medium">Affiliate</span>
        </a>
    @endif

    <a href="{{ route('user.profile.edit') }}" @class([
        'flex flex-col items-center rounded-2xl px-3 py-1',
        'dark:bg-primary/20 text-primary dark:text-white bg-primary/10' => request()->routeIs(
            'user.profile.*'),
        'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => !request()->routeIs(
            'user.profile.*'),
    ])>
        <span class="material-symbols-outlined text-2xl">settings</span>
        <span class="text-xs font-medium">Settings</span>
    </a>

    <a href="{{ route('admin.metrics.index') }}" @class([
        'flex flex-col items-center rounded-2xl px-3 py-1',
        'dark:bg-primary/20 text-primary dark:text-white bg-primary/10' => request()->routeIs(
            'admin.metrics.index'),
        'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => !request()->routeIs(
            'admin.metrics.index'),
    ])>
        <span class="material-symbols-outlined text-2xl">admin_panel_settings</span>
        <span class="text-xs font-medium">Admin</span>
    </a>
</nav>
