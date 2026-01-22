<x-layouts.app>

    <div class="mx-auto max-w-7xl">
        <!-- PageHeading -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <h1 class="text-gray-900 dark:text-white text-3xl font-bold leading-tight tracking-tight">Manage Partners</h1>
            <a href="{{ route('admin.partner.create') }}"
                class="flex items-center justify-center gap-2 min-w-[84px] cursor-pointer overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 focus:ring-2 focus:ring-primary/50">
                <span class="material-symbols-outlined text-base">add</span>
                <span class="truncate">Add New Partner</span>
            </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white dark:bg-[#20152d] rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Partners</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $partners->count() }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">group</span>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-[#20152d] rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Users from Partners</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</p>
                    </div>
                    <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg">
                        <span class="material-symbols-outlined text-green-600 dark:text-green-400">person_add</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Partners Table -->
        <x-table.index>
            <x-table.title>All Partners</x-table.title>
            <x-table.thead>
                <x-table.th>Name</x-table.th>
                <x-table.th>Email</x-table.th>
                <x-table.th>Users Created</x-table.th>
                <x-table.th>Created At</x-table.th>
                <x-table.th>Actions</x-table.th>
            </x-table.thead>

            <x-table.tbody>
                @foreach ($partners as $partner)
                    <x-table.tr class="bg-white dark:bg-[#20152d] border-b dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-800/20">
                        <x-table.td class="flex items-center text-gray-900 dark:text-white whitespace-nowrap">
                            <div class="pl-3">
                                <div class="text-base font-semibold">{{ $partner->name }}</div>
                            </div>
                        </x-table.td>
                        <x-table.td>{{ $partner->email }}</x-table.td>
                        <x-table.td>{{ $partner->users_count }}</x-table.td>
                        <x-table.td>{{ $partner->created_at?->format('M d, Y') }}</x-table.td>
                        <x-table.td>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.partner.show', $partner) }}"
                                    class="p-1 text-gray-500 rounded hover:bg-gray-100 dark:hover:bg-gray-700"><span
                                        class="material-symbols-outlined text-lg">visibility</span></a>
                                <a href="{{ route('admin.partner.edit', $partner) }}"
                                    class="p-1 text-blue-500 rounded hover:bg-blue-100 dark:hover:bg-blue-900/50"><span
                                        class="material-symbols-outlined text-lg">edit</span></a>
                                <form action="{{ route('admin.partner.destroy', $partner) }}" method="post"
                                    onsubmit="return confirm('Delete partner?');">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="p-1 text-red-500 rounded hover:bg-red-100 dark:hover:bg-red-900/50"><span
                                            class="material-symbols-outlined text-lg">delete</span></button>
                                </form>
                            </div>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
            </x-table.tbody>
        </x-table.index>
    </div>

</x-layouts.app>