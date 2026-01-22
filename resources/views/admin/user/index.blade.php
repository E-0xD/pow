<x-layouts.app>

    <div class="mx-auto max-w-7xl">
        <!-- PageHeading -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <h1 class="text-gray-900 dark:text-white text-3xl font-bold leading-tight tracking-tight">Manage Users</h1>
            <button
                class="flex items-center justify-center gap-2 min-w-[84px] cursor-pointer overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 focus:ring-2 focus:ring-primary/50">
                <span class="material-symbols-outlined text-base">add</span>
                <span class="truncate">Add New User</span>
            </button>
        </div>
        <!-- Filters -->
        <div class="bg-white dark:bg-[#20152d] rounded-xl p-4 mb-6">
            <form method="GET" action="{{ route('admin.user.index') }}" class="grid grid-cols-3 md:grid-cols-3 gap-4">
                <div class="col-span-2 md:col-span-10">
                    <label class="relative">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500">search</span>
                        <input name="q"
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark h-11 placeholder:text-gray-400 dark:placeholder:text-gray-500 pl-10 pr-4 text-sm font-normal"
                            placeholder="Search by name or email..." value="{{ request()->q }}" />
                    </label>

                </div>

                <button type="submit"
                    class="col-span-1 md:col-span-1 flex items-center justify-center gap-2 min-w-[84px] cursor-pointer overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 focus:ring-2 focus:ring-primary/50">
                    <span class="material-symbols-outlined text-base">search</span>
                    <span class="hidden md:inline truncate">Search</span>
                </button>

            </form>
        </div>
        <!-- Users Table -->
        <x-table.index>
            <x-table.title>All User</x-table.title>
            <x-table.thead>
                <x-table.th>Name</x-table.th>
                <x-table.th>Portfolios</x-table.th>
                <x-table.th>Join Date</x-table.th>
                <x-table.th>Actions</x-table.th>
            </x-table.thead>

            <x-table.tbody>
                @foreach ($users as $user)
                    <x-table.tr>
                        <x-table.td class="flex items-center text-gray-900 dark:text-white whitespace-nowrap">
                            <div class="pl-3">
                                <div class="text-base font-semibold">{{ $user->name }}</div>
                                <div class="font-normal text-gray-500">{{ $user->email }}</div>
                            </div>
                        </x-table.td>
                        <x-table.td>{{ $user->portfolios()->count() }}</x-table.td>
                        <x-table.td>{{ $user->created_at?->format('M d, Y') }}</x-table.td>
                        <x-table.td>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.user.show', $user) }}"
                                    class="p-1 text-gray-500 rounded hover:bg-gray-100 dark:hover:bg-gray-700"><span
                                        class="material-symbols-outlined text-lg">visibility</span></a>
                                <form action="{{ route('admin.user.destroy', $user) }}" method="post"
                                    onsubmit="return confirm('Delete user?');">
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

        <x-pagination :paginator="$users" />

    </div>

</x-layouts.app>
