<x-layouts.app>
    <!-- PageHeading -->
    <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
        <div class="flex min-w-72 flex-col gap-2">
            <p class="text-[#1F2937] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">
                Welcome back, Alex!</p>
            <p class="text-[#6B7280] dark:text-gray-400 text-base font-normal leading-normal">Here's
                a summary of your portfolio activity.</p>
        </div>
        <button
            class="flex items-center justify-center gap-2 overflow-hidden rounded-lg h-12 px-6 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors shadow-sm">
            <span class="material-symbols-outlined">add_circle</span>
            <span class="truncate">Create New Portfolio</span>
        </button>
    </div>
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <div
            class="flex flex-col gap-2 rounded-xl p-6 border border-[#E5E7EB] dark:border-white/10 bg-white dark:bg-white/5 shadow-sm">
            <p class="text-[#1F2937] dark:text-gray-200 text-base font-medium leading-normal">Total
                Portfolios</p>
            <p class="text-[#1F2937] dark:text-white tracking-light text-4xl font-bold leading-tight">
                12</p>
            <p class="text-green-600 dark:text-green-500 text-sm font-medium leading-normal">+2 this
                month</p>
        </div>
        <div
            class="flex flex-col gap-2 rounded-xl p-6 border border-[#E5E7EB] dark:border-white/10 bg-white dark:bg-white/5 shadow-sm">
            <p class="text-[#1F2937] dark:text-gray-200 text-base font-medium leading-normal">Total
                Clicks (30d)</p>
            <p class="text-[#1F2937] dark:text-white tracking-light text-4xl font-bold leading-tight">
                1,482</p>
            <p class="text-green-600 dark:text-green-500 text-sm font-medium leading-normal">+15%
            </p>
        </div>
        <div
            class="flex flex-col gap-2 rounded-xl p-6 border border-[#E5E7EB] dark:border-white/10 bg-white dark:bg-white/5 shadow-sm">
            <p class="text-[#1F2937] dark:text-gray-200 text-base font-medium leading-normal">New
                Messages</p>
            <p class="text-[#1F2937] dark:text-white tracking-light text-4xl font-bold leading-tight">
                5</p>
            <p class="text-green-600 dark:text-green-500 text-sm font-medium leading-normal">+3
                unread</p>
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
            <div
                class="flex items-center gap-4 p-4 min-h-[72px] justify-between hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                <div class="flex items-center gap-4">
                    <div
                        class="text-[#1F2937] dark:text-gray-300 flex items-center justify-center rounded-lg bg-gray-100 dark:bg-white/10 shrink-0 size-12">
                        <span class="material-symbols-outlined">edit_document</span>
                    </div>
                    <div class="flex flex-col justify-center">
                        <p class="text-[#1F2937] dark:text-white text-base font-medium leading-normal line-clamp-1">
                            Your portfolio 'UX Case Studies' was updated.</p>
                        <p class="text-[#6B7280] dark:text-gray-400 text-sm font-normal leading-normal line-clamp-2">
                            Updated 5 minutes ago</p>
                    </div>
                </div>
                <div class="shrink-0"><button
                        class="text-primary text-sm font-bold leading-normal hover:underline">View</button>
                </div>
            </div>
            <div
                class="flex items-center gap-4 p-4 min-h-[72px] justify-between hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                <div class="flex items-center gap-4">
                    <div
                        class="text-[#1F2937] dark:text-gray-300 flex items-center justify-center rounded-lg bg-gray-100 dark:bg-white/10 shrink-0 size-12">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <div class="flex flex-col justify-center">
                        <p class="text-[#1F2937] dark:text-white text-base font-medium leading-normal line-clamp-1">
                            New message from Jane Smith regarding 'Web Design'.</p>
                        <p class="text-[#6B7280] dark:text-gray-400 text-sm font-normal leading-normal line-clamp-2">
                            Received 2 hours ago</p>
                    </div>
                </div>
                <div class="shrink-0"><button
                        class="text-primary text-sm font-bold leading-normal hover:underline">Reply</button>
                </div>
            </div>
            <div
                class="flex items-center gap-4 p-4 min-h-[72px] justify-between hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                <div class="flex items-center gap-4">
                    <div
                        class="text-[#1F2937] dark:text-gray-300 flex items-center justify-center rounded-lg bg-gray-100 dark:bg-white/10 shrink-0 size-12">
                        <span class="material-symbols-outlined">add_box</span>
                    </div>
                    <div class="flex flex-col justify-center">
                        <p class="text-[#1F2937] dark:text-white text-base font-medium leading-normal line-clamp-1">
                            New portfolio 'Mobile App Concepts' created.</p>
                        <p class="text-[#6B7280] dark:text-gray-400 text-sm font-normal leading-normal line-clamp-2">
                            Created yesterday</p>
                    </div>
                </div>
                <div class="shrink-0"><button
                        class="text-primary text-sm font-bold leading-normal hover:underline">View</button>
                </div>
            </div>
            <div
                class="flex items-center gap-4 p-4 min-h-[72px] justify-between hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                <div class="flex items-center gap-4">
                    <div
                        class="text-[#1F2937] dark:text-gray-300 flex items-center justify-center rounded-lg bg-gray-100 dark:bg-white/10 shrink-0 size-12">
                        <span class="material-symbols-outlined">file_download</span>
                    </div>
                    <div class="flex flex-col justify-center">
                        <p class="text-[#1F2937] dark:text-white text-base font-medium leading-normal line-clamp-1">
                            'UX Case Studies' was exported as PDF.</p>
                        <p class="text-[#6B7280] dark:text-gray-400 text-sm font-normal leading-normal line-clamp-2">
                            Exported 3 days ago</p>
                    </div>
                </div>
                <div class="shrink-0"><button
                        class="text-primary text-sm font-bold leading-normal hover:underline">Details</button>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
