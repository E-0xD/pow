<x-layouts.app>

    <!-- PageHeading & ToolBar -->
    <header class="flex flex-col sm:flex-row flex-wrap justify-between items-center gap-4 mb-8">
        <h1 class="text-gray-900 dark:text-white text-3xl font-black tracking-tight w-full sm:w-auto">My Portfolios
        </h1>
        <div class="flex flex-col sm:flex-row flex-wrap items-center gap-3 w-full sm:w-auto">
            <div class="relative w-full sm:w-auto">
                <span
                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                <input
                    class="pl-10 pr-4 py-2 w-full sm:w-56 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary"
                    placeholder="Search portfolios..." type="text" />
            </div>
            <div class="relative w-full sm:w-auto">
                <select
                    class="w-full sm:w-auto pl-3 pr-8 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg appearance-none focus:ring-primary focus:border-primary">
                    <option>Sort by: Date Created</option>
                    <option>Sort by: Name</option>
                    <option>Sort by: Views</option>
                </select>
                <span
                    class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">expand_more</span>
            </div>
            <a href="{{route('user.portfolio.create')}}"
                class="flex w-full sm:w-auto items-center justify-center gap-2 overflow-hidden bg-primary rounded-lg h-10 px-4 text-white text-sm font-bold shadow-sm hover:opacity-90 transition-opacity">
                <span class="material-symbols-outlined">add_circle</span>
                <span class="truncate">Create New Portfolio</span>
            </a>
        </div>
    </header>
    @if ($portfolios->count())

        <!-- ImageGrid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @foreach ($portfolios as $portfolio)
                <!-- Portfolio Card -->
                <div
                    class="flex flex-col group bg-white dark:bg-gray-900/50 rounded-xl overflow-hidden shadow-sm hover:shadow-lg border border-gray-200 dark:border-gray-800 transition-all duration-300">
                    <div class="w-full bg-center bg-no-repeat aspect-[4/3] bg-cover"
                        data-alt="Abstract purple and blue gradient background"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBbqaqZTRzKCB_PXVKlJySHNxvUIUZ602Td5PkLVrXfJ111Amx_A-yuRMF2G6Ko6EUxmkbSBoZ-vkh66yfxij60AYqARCpdVrfFBTM0xkx9t8AtZgPTD3eLwyi4NpJOBVc95GvxOaokbWljdYl0LAoaCFsD0VG1pnM_dqfzSz0E25QX86ZyUa8GAM1t3iZ3KoZ0joFy-ljF2UpN-x4XAV-IPyC0GU53SFU9DMMd6IaZ5oIqNfaJWkND8PqebVH2A-3ba70nSGIe09k");'>
                    </div>
                    <div class="p-4 flex flex-col flex-1">
                        <p class="text-gray-900 dark:text-white text-base font-bold leading-normal mb-2">Web Design
                            Showcase
                        </p>
                        <div class="flex items-center gap-4 text-gray-500 dark:text-gray-400 text-xs mb-4">
                            <div class="flex items-center gap-1"><span
                                    class="material-symbols-outlined text-sm">visibility</span> 1.2k</div>
                            <div class="flex items-center gap-1"><span
                                    class="material-symbols-outlined text-sm">ads_click</span> 450</div>
                            <div class="flex items-center gap-1"><span
                                    class="material-symbols-outlined text-sm">chat_bubble</span> 12</div>
                        </div>
                        <div class="mt-auto flex gap-2">
                            <a href="{{route('user.portfolio.customize', $portfolio->uid)}}"
                                class="flex-1 flex items-center justify-center gap-1 py-2 px-3 text-sm font-semibold rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                                <span class="material-symbols-outlined text-base">edit</span> Edit
                            </a>
                            <button
                                class="flex items-center justify-center py-2 px-3 text-sm font-semibold rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                                <span class="material-symbols-outlined text-base">more_vert</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center gap-6 mt-16 text-center">
            <div class="text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" fill="currentColor"
                    class="bi bi-collection" viewBox="0 0 16 16">
                    <path
                        d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm1.5.5A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13z" />
                </svg>
            </div>
            <div class="flex max-w-md flex-col items-center gap-2">
                <p class="text-gray-900 dark:text-white text-lg font-bold">No portfolios yet</p>
                <p class="text-gray-600 dark:text-gray-400 text-sm font-normal">Start building your first portfolio
                    to share
                    your work with the world.</p>
            </div>
            <a href="{{route('user.portfolio.create')}}"
                class="flex min-w-[84px] items-center justify-center gap-2 overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold shadow-sm hover:opacity-90 transition-opacity">
                <span class="material-symbols-outlined">add_circle</span>
                <span class="truncate">Create New Portfolio</span>
            </a>
        </div>
    @endif

</x-layouts.app>
