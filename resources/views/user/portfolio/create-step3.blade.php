<x-layouts.app>
    <div class="flex flex-col max-w-7xl mx-auto w-full">
        <!-- PageHeading -->
        <header class="flex flex-wrap justify-between gap-3 mb-8">
            <div class="flex flex-col gap-2">
                <p
                    class="text-slate-900 dark:text-white text-3xl lg:text-4xl font-black leading-tight tracking-[-0.033em]">
                    Arrange Your Portfolio Sections</p>
                <p class="text-slate-500 dark:text-slate-400 text-base font-normal leading-normal">Drag and drop the
                    sections you want to include, and reorder them to your liking.</p>
            </div>
        </header>
        <!-- Content Grids -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 flex-1">
            <!-- Available Sections -->
            <div class="flex flex-col gap-4">
                <h3 class="text-slate-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] px-4">
                    Available Sections</h3>
                <div
                    class="flex flex-col gap-2 p-2 bg-slate-100 dark:bg-black/30 rounded-xl border border-slate-200 dark:border-slate-800">
                    <!-- ListItem 1 -->
                    <div
                        class="flex items-center gap-4 bg-white dark:bg-slate-900/50 px-4 min-h-[72px] py-2 justify-between rounded-lg shadow-sm">
                        <div class="flex items-center gap-4">
                            <div
                                class="text-slate-700 dark:text-slate-300 flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 shrink-0 size-12">
                                <span class="material-symbols-outlined">person</span>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p
                                    class="text-slate-900 dark:text-white text-base font-medium leading-normal line-clamp-1">
                                    About</p>
                                <p
                                    class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal line-clamp-2">
                                    A brief introduction about yourself.</p>
                            </div>
                        </div>
                        <div class="shrink-0 cursor-grab active:cursor-grabbing">
                            <div class="text-slate-500 dark:text-slate-400 flex size-7 items-center justify-center">
                                <span class="material-symbols-outlined">drag_indicator</span>
                            </div>
                        </div>
                    </div>
                    <!-- ListItem 2 -->
                    <div
                        class="flex items-center gap-4 bg-white dark:bg-slate-900/50 px-4 min-h-[72px] py-2 justify-between rounded-lg shadow-sm">
                        <div class="flex items-center gap-4">
                            <div
                                class="text-slate-700 dark:text-slate-300 flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 shrink-0 size-12">
                                <span class="material-symbols-outlined">work</span>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p
                                    class="text-slate-900 dark:text-white text-base font-medium leading-normal line-clamp-1">
                                    Experience</p>
                                <p
                                    class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal line-clamp-2">
                                    Detail your professional history.</p>
                            </div>
                        </div>
                        <div class="shrink-0 cursor-grab active:cursor-grabbing">
                            <div class="text-slate-500 dark:text-slate-400 flex size-7 items-center justify-center">
                                <span class="material-symbols-outlined">drag_indicator</span>
                            </div>
                        </div>
                    </div>
                    <!-- ListItem 3 -->
                    <div
                        class="flex items-center gap-4 bg-white dark:bg-slate-900/50 px-4 min-h-[72px] py-2 justify-between rounded-lg shadow-sm">
                        <div class="flex items-center gap-4">
                            <div
                                class="text-slate-700 dark:text-slate-300 flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 shrink-0 size-12">
                                <span class="material-symbols-outlined">lightbulb</span>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p
                                    class="text-slate-900 dark:text-white text-base font-medium leading-normal line-clamp-1">
                                    Skills</p>
                                <p
                                    class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal line-clamp-2">
                                    List your technical and soft skills.</p>
                            </div>
                        </div>
                        <div class="shrink-0 cursor-grab active:cursor-grabbing">
                            <div class="text-slate-500 dark:text-slate-400 flex size-7 items-center justify-center">
                                <span class="material-symbols-outlined">drag_indicator</span>
                            </div>
                        </div>
                    </div>
                    <!-- ListItem 4 -->
                    <div
                        class="flex items-center gap-4 bg-white dark:bg-slate-900/50 px-4 min-h-[72px] py-2 justify-between rounded-lg shadow-sm">
                        <div class="flex items-center gap-4">
                            <div
                                class="text-slate-700 dark:text-slate-300 flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 shrink-0 size-12">
                                <span class="material-symbols-outlined">school</span>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p
                                    class="text-slate-900 dark:text-white text-base font-medium leading-normal line-clamp-1">
                                    Education</p>
                                <p
                                    class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal line-clamp-2">
                                    Your academic background.</p>
                            </div>
                        </div>
                        <div class="shrink-0 cursor-grab active:cursor-grabbing">
                            <div class="text-slate-500 dark:text-slate-400 flex size-7 items-center justify-center">
                                <span class="material-symbols-outlined">drag_indicator</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Your Portfolio Sections -->
            <div class="flex flex-col gap-4">
                <h3 class="text-slate-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] px-4">Your
                    Portfolio Sections</h3>
                <div
                    class="flex flex-col gap-2 p-2 bg-slate-100 dark:bg-black/30 rounded-xl border-2 border-dashed border-slate-300 dark:border-slate-700 min-h-[480px]">
                    <!-- ListItem 1 (added) -->
                    <div
                        class="flex items-center gap-4 bg-white dark:bg-slate-900/50 px-4 min-h-[72px] py-2 justify-between rounded-lg shadow-sm">
                        <div class="flex items-center gap-4">
                            <div
                                class="text-slate-700 dark:text-slate-300 flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 shrink-0 size-12">
                                <span class="material-symbols-outlined">grid_view</span>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p
                                    class="text-slate-900 dark:text-white text-base font-medium leading-normal line-clamp-1">
                                    Projects</p>
                                <p
                                    class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal line-clamp-2">
                                    Showcase your best work.</p>
                            </div>
                        </div>
                        <div class="shrink-0 cursor-grab active:cursor-grabbing">
                            <div class="text-slate-500 dark:text-slate-400 flex size-7 items-center justify-center">
                                <span class="material-symbols-outlined">drag_indicator</span>
                            </div>
                        </div>
                    </div>
                    <!-- ListItem 2 (added) -->
                    <div
                        class="flex items-center gap-4 bg-white dark:bg-slate-900/50 px-4 min-h-[72px] py-2 justify-between rounded-lg shadow-sm">
                        <div class="flex items-center gap-4">
                            <div
                                class="text-slate-700 dark:text-slate-300 flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 shrink-0 size-12">
                                <span class="material-symbols-outlined">mail</span>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p
                                    class="text-slate-900 dark:text-white text-base font-medium leading-normal line-clamp-1">
                                    Contact</p>
                                <p
                                    class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal line-clamp-2">
                                    How people can get in touch.</p>
                            </div>
                        </div>
                        <div class="shrink-0 cursor-grab active:cursor-grabbing">
                            <div class="text-slate-500 dark:text-slate-400 flex size-7 items-center justify-center">
                                <span class="material-symbols-outlined">drag_indicator</span>
                            </div>
                        </div>
                    </div>
                    <!-- Empty State (visible when no sections are added) -->
                    <div class="hidden items-center justify-center flex-col flex-1 text-center p-4">
                        <span
                            class="material-symbols-outlined text-4xl text-slate-400 dark:text-slate-600 mb-2">add_to_photos</span>
                        <p class="font-bold text-slate-600 dark:text-slate-400">Your portfolio is empty</p>
                        <p class="text-sm text-slate-500 dark:text-slate-500">Drag sections here to start building.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Action Buttons -->
        <div class="flex justify-between items-center mt-10 pt-6 border-t border-slate-200 dark:border-slate-800">
            <button
                class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 text-slate-700 dark:text-slate-300 text-sm font-bold leading-normal tracking-wide hover:bg-slate-200 dark:hover:bg-slate-800">
                <span class="truncate">Back</span>
            </button>
            <button
                class="flex min-w-[84px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-10 px-5 bg-primary text-white text-sm font-bold leading-normal shadow-lg shadow-primary/30 hover:bg-primary/90">
                <span class="truncate">Next: Add Content</span>
                <span class="material-symbols-outlined">arrow_forward</span>
            </button>
        </div>
    </div>
</x-layouts.app>
