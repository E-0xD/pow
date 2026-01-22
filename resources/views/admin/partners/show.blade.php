<x-layouts.app>

    <div class="mx-auto max-w-7xl">
        <!-- PageHeading -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <div>
                <h1 class="text-gray-900 dark:text-white text-3xl font-bold leading-tight tracking-tight">
                    {{ $partner->name }}</h1>
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
                        <p class="text-lg font-bold text-gray-900 dark:text-white">
                            {{ $partner->created_at?->format('M d, Y') }}</p>
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

        @if ($partner->users->count() > 0)
            <x-table.index>
                <x-table.title>Users Created by This Partner</x-table.title>
                <x-table.thead>
                    <x-table.th>Name</x-table.th>
                    <x-table.th>Email</x-table.th>
                    <x-table.th>Created At</x-table.th>
                </x-table.thead>
                <x-table.tbody>
                    @foreach ($partner->users as $user)
                        <x-table.tr
                            class="bg-white dark:bg-[#20152d] border-b dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-800/20">
                            <x-table.td class="flex items-center text-gray-900 dark:text-white whitespace-nowrap">
                                <div class="pl-3">
                                    <div class="text-base font-semibold">{{ $user->name }}</div>
                                </div>
                            </x-table.td>
                            <x-table.td>{{ $user->email }}</x-table.td>
                            <x-table.td>{{ $user->created_at?->format('M d, Y') }}</x-table.td>
                        </x-table.tr>
                    @endforeach
                </x-table.tbody>
            </x-table.index>
        @else
            <div class="bg-white dark:bg-[#20152d] rounded-xl p-6">
                <p class="text-gray-500 dark:text-gray-400">No users created by this partner yet.</p>
            </div>
        @endif

    </div>

</x-layouts.app>
