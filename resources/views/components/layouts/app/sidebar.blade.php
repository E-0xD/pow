<!-- Desktop Sidebar -->
<aside
    class="hidden md:flex fixed left-0 top-0 w-64 h-[100dvh] bg-white dark:bg-[#110A19] border-r border-[#E5E7EB] dark:border-white/10 flex-col shrink-0">
    <div class="flex h-full max-h-full flex-col justify-between p-4">
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-3 p-2">
                <span class="text-2xl font-black text-primary">POW</span>
            </div>
            <div class="flex flex-col gap-2">
                <a @class(["flex items-center gap-3 px-3 py-2 rounded-lg",
                    'bg-primary/10 dark:bg-primary/20 text-primary dark:text-white' => request()->routeIs('user.dashboard'),
                    'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => ! request()->routeIs('user.dashboard')
                ]) href="{{ route('user.dashboard') }}">
                    <span class="material-symbols-outlined text-2xl">dashboard</span>
                    <p class="text-sm font-bold leading-normal">Dashboard</p>
                </a>
                <a @class(["flex items-center gap-3 px-3 py-2 rounded-lg",
                    'dark:bg-primary/20 text-primary dark:text-white bg-primary/10' => request()->routeIs('user.portfolio.*'),
                    'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => ! request()->routeIs('user.portfolio.*')
                ]) href="{{ route('user.portfolio.index') }}">
                    <span class="material-symbols-outlined !font-bold">image</span>
                    <p class="text-sm font-medium leading-normal">My Portfolios</p>
                </a>
                <a @class(["flex items-center gap-3 px-3 py-2 rounded-lg",
                    'dark:bg-primary/20 text-primary dark:text-white bg-primary/10' => request()->routeIs('user.messages.*'),
                    'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => ! request()->routeIs('user.messages.*')
                ]) href="{{ route('user.messages.index') }}">
                    <span class="material-symbols-outlined">
                        mail
                    </span>
                    <p class="text-sm font-medium leading-normal">Inbox</p>
                </a>
                <a @class(["flex items-center gap-3 px-3 py-2 rounded-lg",
                    'dark:bg-primary/20 text-primary dark:text-white bg-primary/10' => request()->routeIs('user.affiliate.*'),
                    'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => ! request()->routeIs('user.affiliate.*')
                ]) href="{{ route('user.affiliate.index') }}">
                    <span class="material-symbols-outlined">
                        network_node
                    </span>
                    <p class="text-sm font-medium leading-normal">Affiliate</p>
                </a>
            </div>
        </div>

        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-1">
                <a @class(["flex items-center gap-3 px-3 py-2 rounded-lg",
                    'dark:bg-primary/20 text-primary dark:text-white bg-primary/10' => request()->routeIs('user.profile.*'),
                    'hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300' => ! request()->routeIs('user.profile.*')
                ]) href="{{ route('user.profile.edit') }}">
                    <span class="material-symbols-outlined text-2xl">settings</span>
                    <p class="text-sm font-medium leading-normal">Settings</p>
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
            </div>

            <div class="flex gap-3 items-center border-t border-[#E5E7EB] dark:border-white/10 pt-4">
                {{-- <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDkge7VGK0din6bNORuAhVItey7gevkBW5y_rWqZW17anAWwif879XeJTgK8sXwe7gTlJpjg1ov07eO15kEiawLXH0CKmzOMfpsUVVKBlEaHVN7OMdd5QxfaNWhHDgHBIwvD6Y4lISD2htt1ILKWUPrZ0JYDGOSumpALzCSNGgWRMznFkJovtCQmjxPO_UzpKyv0YK-LbCvg3pR7pMo3W1OFauGAoPhIAuGgaKtU08RvYfVCcWOueMkwTCMXu_exu7PzK_bgDNZDzU");'>
                </div> --}}
                <div class="flex flex-col">
                    <h1 class="text-[#1F2937] dark:text-white text-base font-medium leading-normal">
                        {{ Auth::user()->name }}</h1>
                    <p class="text-[#6B7280] dark:text-gray-400 text-sm font-normal leading-normal">
                        {{ Auth::user()->email }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</aside>

<!-- Mobile Bottom Bar -->
