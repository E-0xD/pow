<x-layouts.app>
    <div class="mx-auto max-w-7xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-text-light dark:text-text-dark text-3xl lg:text-4xl font-black tracking-tighter">Features
            </h1>
            <a href="{{ route('admin.feature.create') }}"
                class="bg-primary hover:opacity-90 text-text-dark font-bold py-2 px-4 rounded">
                Create Feature
            </a>
        </div>

        <x-table.index>
            <x-table.thead>
                <x-table.th>Name</x-table.th>
                <x-table.th>Slug</x-table.th>
                <x-table.th>Type</x-table.th>
                <x-table.th>Description</x-table.th>
                <x-table.th>Actions</x-table.th>
            </x-table.thead>

            <x-table.tbody>
                @forelse ($features as $feature)
                    <x-table.tr>
                        <x-table.td>
                            {{ $feature->name }}
                        </x-table.td>
                        <x-table.td>
                            <code
                                class="text-xs bg-background-light dark:bg-background-dark px-2 py-1 rounded">{{ $feature->slug }}</code>
                        </x-table.td>
                        <x-table.td>
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary/20 text-primary">
                                {{ ucfirst($feature->type) }}
                            </span>
                        </x-table.td>
                        <x-table.td class="text-text-light dark:text-text-dark text-xs max-w-xs truncate">
                            {{ $feature->description ?? '-' }}
                        </x-table.td>
                        <x-table.td class="font-medium">
                            <a href="{{ route('admin.feature.edit', $feature) }}"
                                class="text-primary hover:opacity-80 mr-3">
                                <span class="material-symbols-outlined text-lg">edit</span>
                            </a>
                            <form method="POST" action="{{ route('admin.feature.destroy', $feature) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-background-danger hover:opacity-80"
                                    onclick="return confirm('Are you sure?')">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </form>
                        </x-table.td>
                    </x-table.tr>
                @empty
                    <x-table.tr
                        class="bg-card-light dark:bg-card-dark border-b border-border-light dark:border-border-dark">
                        <x-table.td class="text-center text-subtle-light dark:text-subtle-dark" colspan="5">
                            No features found. <a href="{{ route('admin.feature.create') }}"
                                class="text-primary hover:opacity-80">Create one</a>
                        </x-table.td>
                    </x-table.tr>
                @endforelse
            </x-table.tbody>
        </x-table.index>

        <x-pagination :paginator="$features" />
    </div>
</x-layouts.app>
