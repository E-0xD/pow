<nav class="fixed bottom-0 left-0 right-0 z-50 bg-white dark:bg-[#0b0710] border-t border-[#E5E7EB] dark:border-white/10 flex justify-around items-center py-2 px-1 md:hidden">
    <a href="{{ route('admin.metrics.index') }}"
        @class(["flex flex-col items-center rounded-lg px-3 py-1",
            'bg-primary/10 dark:bg-primary/20 text-primary dark:text-white' => request()->routeIs('admin.metrics.*'),
            'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => ! request()->routeIs('admin.metrics.*')
        ])>
        <span class="material-symbols-outlined text-2xl">insights</span>
        <span class="text-xs font-medium">Metrics</span>
    </a>

    <a href="{{ route('admin.user.index') }}"
        @class(["flex flex-col items-center rounded-2xl px-3 py-1",
            'dark:bg-primary/20 text-primary dark:text-white bg-primary/10' => request()->routeIs('admin.user.*'),
            'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => ! request()->routeIs('admin.user.*')
        ])>
        <span class="material-symbols-outlined text-2xl">people</span>
        <span class="text-xs font-medium">Users</span>
    </a>

    <a href="{{ route('admin.affiliate.index') }}"
        @class(["flex flex-col items-center rounded-2xl px-3 py-1",
            'dark:bg-primary/20 text-primary dark:text-white bg-primary/10' => request()->routeIs('admin.affiliate.*'),
            'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => ! request()->routeIs('admin.affiliate.*')
        ])>
        <span class="material-symbols-outlined">network_node</span>
        <span class="text-xs font-medium">Affiliates</span>
    </a>

    <a href="{{ route('admin.template.index') }}"
        @class(["flex flex-col items-center rounded-2xl px-3 py-1",
            'dark:bg-primary/20 text-primary dark:text-white bg-primary/10' => request()->routeIs('admin.template.*'),
            'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => ! request()->routeIs('admin.template.*')
        ])>
        <span class="material-symbols-outlined text-2xl">view_quilt</span>
        <span class="text-xs font-medium">Templates</span>
    </a>

    <a href="{{ route('logout') }}"
        class="flex flex-col items-center rounded-2xl px-3 py-1 hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300">
        <span class="material-symbols-outlined text-2xl">logout</span>
        <span class="text-xs font-medium">Logout</span>
    </a>

    <form id="admin-logout-form" action="{{ route('logout') }}" method="post" class="hidden">@csrf</form>
</nav>
