<x-layouts.app>

    <div class="mx-auto max-w-7xl">
        <!-- PageHeading -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <div>
                <h1 class="text-gray-900 dark:text-white text-3xl font-bold leading-tight tracking-tight">{{ $partner->name }}</h1>
                <p class="text-gray-600 dark:text-gray-400">{{ $partner->email }}</p>
            </div>
            <a href="{{ route('admin.partner.edit', $partner) }}"
                class="flex items-center justify-center gap-2 min-w-[84px] cursor-pointer overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 focus:ring-2 focus:ring-primary/50">
                <span class="material-symbols-outlined text-base">edit</span>
                <span class="truncate">Edit Partner</span>
            </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white dark:bg-[#20152d] rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Users Created</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $partner->users->count() }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">person_add</span>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-[#20152d] rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Created At</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $partner->created_at?->format('M d, Y') }}</p>
                    </div>
                    <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg">
                        <span class="material-symbols-outlined text-green-600 dark:text-green-400">calendar_today</span>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-[#20152d] rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">API Key</p>
                        <p class="text-sm font-mono text-gray-900 dark:text-white break-all">{{ $partner->api_key }}</p>
                    </div>
                    <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                        <span class="material-symbols-outlined text-purple-600 dark:text-purple-400">key</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Created by Partner -->
        <div class="bg-white dark:bg-[#20152d] rounded-xl p-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Users Created by This Partner</h2>
            @if($partner->users->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700/20 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3" scope="col">Name</th>
                                <th class="px-6 py-3" scope="col">Email</th>
                                <th class="px-6 py-3" scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($partner->users as $user)
                                <tr class="bg-white dark:bg-[#20152d] border-b dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-800/20">
                                    <th class="flex items-center px-6 py-4 text-gray-900 dark:text-white whitespace-nowrap" scope="row">
                                        <div class="pl-3">
                                            <div class="text-base font-semibold">{{ $user->name }}</div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">{{ $user->created_at?->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400">No users created by this partner yet.</p>
            @endif
        </div>
    </div>

</x-layouts.app>