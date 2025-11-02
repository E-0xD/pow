<x-layouts.app>
    <div class="w-full max-w-7xl mx-auto">
        <!-- PageHeading -->
        <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
            <div class="flex min-w-72 flex-col gap-2">
                <p class="text-[#1F2937] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Welcome
                    back, {{Auth::user()->name}}!</p>
                <p class="text-[#6B7280] dark:text-gray-400 text-base font-normal leading-normal">Here's a summary of
                    all your portfolio activity.</p>
            </div>
            <a href="{{ route('user.portfolio.create') }}"
                class="flex items-center justify-center gap-2 overflow-hidden rounded-lg h-12 px-6 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors shadow-sm">
                <span class="material-symbols-outlined">add_circle</span>
                <span class="truncate">Create New Portfolio</span>
            </a>
        </div>
        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            <div
                class="flex flex-col gap-2 rounded-xl p-6 border border-[#E5E7EB] dark:border-white/10 bg-white dark:bg-white/5 shadow-sm">
                <p class="text-[#1F2937] dark:text-gray-200 text-base font-medium leading-normal">Total Portfolios</p>
                <p class="text-[#1F2937] dark:text-white tracking-light text-4xl font-bold leading-tight">
                    {{ $totalPortfolio }}</p>
                {{-- <p class="text-green-600 dark:text-green-500 text-sm font-medium leading-normal">+2 this month</p> --}}
            </div>
            <div
                class="flex flex-col gap-2 rounded-xl p-6 border border-[#E5E7EB] dark:border-white/10 bg-white dark:bg-white/5 shadow-sm">
                <p class="text-[#1F2937] dark:text-gray-200 text-base font-medium leading-normal">Total Clicks ({{$visitsData['days']}}d)</p>
                <p class="text-[#1F2937] dark:text-white tracking-light text-4xl font-bold leading-tight">{{$visitsData['total']}}</p>
                {{-- <p class="text-green-600 dark:text-green-500 text-sm font-medium leading-normal">+15%</p> --}}
            </div>
            <div
                class="flex flex-col gap-2 rounded-xl p-6 border border-[#E5E7EB] dark:border-white/10 bg-white dark:bg-white/5 shadow-sm">
                <p class="text-[#1F2937] dark:text-gray-200 text-base font-medium leading-normal">New Messages</p>
                <p class="text-[#1F2937] dark:text-white tracking-light text-4xl font-bold leading-tight">{{$unreadMessagesCount}}</p>
                {{-- <p class="text-green-600 dark:text-green-500 text-sm font-medium leading-normal">+3 unread</p> --}}
            </div>
        </div>
        <!-- Recent Activity Section -->
        <div class="flex flex-col">
            <!-- SectionHeader -->
            <h2 class="text-[#1F2937] dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] mb-4">
                Recent Activity</h2>
            <!-- ListItems -->
            <div
                class="flex flex-col divide-y divide-[#E5E7EB] dark:divide-white/10 border border-[#E5E7EB] dark:border-white/10 rounded-xl bg-white dark:bg-white/5 shadow-sm overflow-hidden">

                @foreach ($notifications as $notification)
                    <div
                        class="flex items-center gap-4 p-4 min-h-[72px] justify-between hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <div class="flex items-center gap-4">
                            <div
                                class="text-[#1F2937] dark:text-gray-300 flex items-center justify-center rounded-lg bg-gray-100 dark:bg-white/10 shrink-0 size-12">
                                <span class="material-symbols-outlined">{{ $notification->type->icon() }}</span>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p
                                    class="text-[#1F2937] dark:text-white text-base font-medium leading-normal line-clamp-1">
                                    {{ $notification->body }}
                                </p>
                                <p
                                    class="text-[#6B7280] dark:text-gray-400 text-sm font-normal leading-normal line-clamp-2">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>
