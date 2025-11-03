<x-layouts.app>
    <div class="p-8">
        <!-- PageHeading Component -->
        <div class="flex flex-wrap justify-between items-center gap-4">
            <div class="flex flex-col gap-1">
                <h1 class="text-gray-900 dark:text-white text-3xl font-bold tracking-tight">Manage Portfolios</h1>
                <p class="text-gray-500 dark:text-gray-400 text-base font-normal leading-normal">View, search, and manage
                    all user portfolios on the platform.</p>
            </div>
            <button
                class="flex items-center justify-center gap-2 overflow-hidden rounded-lg h-11 px-5 bg-primary text-white text-sm font-bold leading-normal tracking-wide shadow-sm hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary/50">
                <span class="material-symbols-outlined !text-xl">add</span>
                <span class="truncate">Add New Portfolio</span>
            </button>
        </div>
        <!-- Controls: SearchBar and Chips -->
        <div class="mt-8 flex flex-col md:flex-row md:items-center gap-4">
            <div class="flex-1">
                <label class="flex flex-col w-full">
                    <div class="flex w-full flex-1 items-stretch rounded-lg h-11">
                        <div
                            class="text-gray-500 dark:text-gray-400 flex bg-white dark:bg-background-dark/50 items-center justify-center pl-4 rounded-l-lg border border-gray-200 dark:border-white/10 border-r-0">
                            <span class="material-symbols-outlined !text-2xl">search</span>
                        </div>
                        <input
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-r-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-200 dark:border-white/10 bg-white dark:bg-background-dark/50 h-full placeholder:text-gray-400 dark:placeholder:text-gray-500 px-4 pl-2 text-sm font-normal leading-normal"
                            placeholder="Find portfolios by name or owner" value="" />
                    </div>
                </label>
            </div>
            <div class="flex gap-2">
                <button
                    class="flex h-11 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-white dark:bg-background-dark/50 border border-gray-200 dark:border-white/10 px-4">
                    <p class="text-gray-700 dark:text-gray-300 text-sm font-medium leading-normal">Status: All</p>
                    <span class="material-symbols-outlined !text-xl text-gray-500 dark:text-gray-400">expand_more</span>
                </button>
                <button
                    class="flex h-11 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-white dark:bg-background-dark/50 border border-gray-200 dark:border-white/10 px-4">
                    <p class="text-gray-700 dark:text-gray-300 text-sm font-medium leading-normal">Template: All</p>
                    <span class="material-symbols-outlined !text-xl text-gray-500 dark:text-gray-400">expand_more</span>
                </button>
            </div>
        </div>
        <!-- Table Component -->
        <div class="mt-6">
            <div
                class="overflow-hidden rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-background-dark/50">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-white/10">
                        <thead class="bg-gray-50 dark:bg-white/5">
                            <tr>
                                <th class="py-3.5 pl-4 pr-3 text-left" scope="col">
                                    <input
                                        class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 dark:bg-background-dark/50 text-primary focus:ring-primary/50"
                                        type="checkbox" />
                                </th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white"
                                    scope="col">Portfolio Name</th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white"
                                    scope="col">Owner</th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white"
                                    scope="col">Template Used</th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white"
                                    scope="col">Date Created</th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white"
                                    scope="col">Status</th>
                                <th class="relative py-3.5 pl-3 pr-4" scope="col">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-gray-200 dark:divide-white/10 bg-white dark:bg-background-dark/50">
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm">
                                    <input
                                        class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 dark:bg-background-dark/50 text-primary focus:ring-primary/50"
                                        type="checkbox" />
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                    Project Alpha Showcase</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">Sarah
                                    Connor</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    Creative Pro</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">Oct 26,
                                    2023</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    <span
                                        class="inline-flex items-center rounded-full bg-green-100 dark:bg-green-500/20 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:text-green-400">Published</span>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium">
                                    <button
                                        class="p-1 rounded-full text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"><span
                                            class="material-symbols-outlined !text-xl">more_vert</span></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm">
                                    <input
                                        class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 dark:bg-background-dark/50 text-primary focus:ring-primary/50"
                                        type="checkbox" />
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                    Minimalist Design Collection</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">John
                                    Smith</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    SimpleFolio</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">Oct 25,
                                    2023</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    <span
                                        class="inline-flex items-center rounded-full bg-green-100 dark:bg-green-500/20 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:text-green-400">Published</span>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium">
                                    <button
                                        class="p-1 rounded-full text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"><span
                                            class="material-symbols-outlined !text-xl">more_vert</span></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm">
                                    <input
                                        class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 dark:bg-background-dark/50 text-primary focus:ring-primary/50"
                                        type="checkbox" />
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                    Photography Journal</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">Emily
                                    Jones</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">Gallery
                                    View</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">Oct 24,
                                    2023</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    <span
                                        class="inline-flex items-center rounded-full bg-gray-100 dark:bg-gray-500/20 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:text-gray-400">Draft</span>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium">
                                    <button
                                        class="p-1 rounded-full text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"><span
                                            class="material-symbols-outlined !text-xl">more_vert</span></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm">
                                    <input
                                        class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 dark:bg-background-dark/50 text-primary focus:ring-primary/50"
                                        type="checkbox" />
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                    UX Case Studies</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">Michael
                                    Bay</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    Creative Pro</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">Oct 23,
                                    2023</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    <span
                                        class="inline-flex items-center rounded-full bg-orange-100 dark:bg-orange-500/20 px-2.5 py-0.5 text-xs font-medium text-orange-800 dark:text-orange-400">Archived</span>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium">
                                    <button
                                        class="p-1 rounded-full text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"><span
                                            class="material-symbols-outlined !text-xl">more_vert</span></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm">
                                    <input
                                        class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 dark:bg-background-dark/50 text-primary focus:ring-primary/50"
                                        type="checkbox" />
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                    Web Development Projects</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">David
                                    Chen</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    SimpleFolio</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">Oct
                                    22, 2023</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    <span
                                        class="inline-flex items-center rounded-full bg-green-100 dark:bg-green-500/20 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:text-green-400">Published</span>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium">
                                    <button
                                        class="p-1 rounded-full text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"><span
                                            class="material-symbols-outlined !text-xl">more_vert</span></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Pagination -->
        <div class="mt-6 flex items-center justify-between">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span
                    class="font-medium">42</span> results
            </p>
            <div class="flex items-center gap-2">
                <button
                    class="flex items-center justify-center h-9 w-9 rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-background-dark/50 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-white/5">
                    <span class="material-symbols-outlined !text-xl">chevron_left</span>
                </button>
                <button
                    class="flex items-center justify-center h-9 w-9 rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-background-dark/50 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-white/5">
                    <span class="material-symbols-outlined !text-xl">chevron_right</span>
                </button>
            </div>
        </div>
    </div>

</x-layouts.app>
