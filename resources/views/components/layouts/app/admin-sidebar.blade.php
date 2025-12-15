<!-- Admin Sidebar -->
<aside class="hidden md:flex fixed left-0 top-0 w-64 h-[100dvh] bg-white dark:bg-[#0b0710] border-r border-[#E5E7EB] dark:border-white/10 flex-col shrink-0">
    <div class="flex h-full max-h-full flex-col justify-between p-4">
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-3 p-2">
                <span class="text-2xl font-black text-primary">POW Admin</span>
            </div>

            <div class="flex flex-col gap-2">
                <a @class(["flex items-center gap-3 px-3 py-2 rounded-lg",
                    'bg-primary/10 dark:bg-primary/20 text-primary dark:text-white' => request()->routeIs('admin.metrics.*'),
                    'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => ! request()->routeIs('admin.metrics.*')
                ]) href="{{ route('admin.metrics.index') }}">
                    <span class="material-symbols-outlined text-2xl">insights</span>
                    <p class="text-sm font-bold leading-normal">Metrics</p>
                </a>

                <a @class(["flex items-center gap-3 px-3 py-2 rounded-lg",
                    'dark:bg-primary/20 text-primary dark:text-white bg-primary/10' => request()->routeIs('admin.user.*'),
                    'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => ! request()->routeIs('admin.user.*')
                ]) href="{{ route('admin.user.index') }}">
                    <span class="material-symbols-outlined">people</span>
                    <p class="text-sm font-medium leading-normal">Manage Users</p>
                </a>

                <a @class(["flex items-center gap-3 px-3 py-2 rounded-lg",
                    'dark:bg-primary/20 text-primary dark:text-white bg-primary/10' => request()->routeIs('admin.affiliate.*'),
                    'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => ! request()->routeIs('admin.affiliate.*')
                ]) href="{{ route('admin.affiliate.index') }}">
                    <span class="material-symbols-outlined">network_node</span>
                    <p class="text-sm font-medium leading-normal">Affiliates</p>
                </a>

                <a @class(["flex items-center gap-3 px-3 py-2 rounded-lg",
                    'dark:bg-primary/20 text-primary dark:text-white bg-primary/10' => request()->routeIs('admin.template.*'),
                    'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => ! request()->routeIs('admin.template.*')
                ]) href="{{ route('admin.template.index') }}">
                    <span class="material-symbols-outlined">view_quilt</span>
                    <p class="text-sm font-medium leading-normal">Templates</p>
                </a>
            </div>
        </div>

        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-1">
                <a @class(["flex items-center gap-3 px-3 py-2 rounded-lg",
                    'dark:bg-primary/20 text-primary dark:text-white bg-primary/10' => request()->routeIs('user.dashboard'),
                    'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => ! request()->routeIs('user.dashboard')
                ]) href="{{ route('user.dashboard') }}">
                    <span class="material-symbols-outlined text-2xl">view_cozy</span>
                    <p class="text-sm font-medium leading-normal">POW</p>
                </a>

                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="flex w-full items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300" type="submit">
                        <span class="material-symbols-outlined text-2xl">logout</span>
                        <p class="text-sm font-medium leading-normal">Log out</p>
                    </button>
                </form>
            </div>

            <div class="flex gap-3 items-center border-t border-[#E5E7EB] dark:border-white/10 pt-4">
                <div class="flex flex-col">
                    <h1 class="text-[#1F2937] dark:text-white text-base font-medium leading-normal">{{ Auth::user()->name }}</h1>
                    <p class="text-[#6B7280] dark:text-gray-400 text-sm font-normal leading-normal">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
    </div>
</aside>
