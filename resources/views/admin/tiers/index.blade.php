<x-layouts.app>
    <div class="mx-auto max-w-7xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-text-light dark:text-text-dark text-3xl lg:text-4xl font-black tracking-tighter">Tiers</h1>
            <a href="{{ route('admin.tier.create') }}"
                class="bg-primary hover:opacity-90 text-text-dark font-bold py-2 px-4 rounded">
                Create Tier
            </a>
        </div>

        <div class="bg-white dark:bg-[#20152d] rounded-xl p-6">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-subtle-light dark:text-subtle-dark uppercase bg-background-light dark:bg-background-dark/20">
                        <tr>
                            <th class="px-6 py-3" scope="col">Name</th>
                            <th class="px-6 py-3" scope="col">Slug</th>
                            <th class="px-6 py-3" scope="col">Features</th>
                            <th class="px-6 py-3" scope="col">Description</th>
                            <th class="px-6 py-3" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tiers as $tier)
                            <tr class="bg-card-light dark:bg-card-dark border-b border-border-light dark:border-border-dark hover:bg-background-light dark:hover:bg-background-dark/20">
                                <td class="px-6 py-4 font-medium text-text-light dark:text-text-dark whitespace-nowrap">
                                    {{ $tier->name }}</td>
                                <td class="px-6 py-4 text-text-light dark:text-text-dark">
                                    <code class="text-xs bg-background-light dark:bg-background-dark px-2 py-1 rounded">{{ $tier->slug }}</code>
                                </td>
                                <td class="px-6 py-4 text-text-light dark:text-text-dark">
                                    <div class="flex flex-wrap gap-1">
                                        @forelse ($tier->features as $feature)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary/20 text-primary">
                                                {{ $feature->name }}
                                            </span>
                                        @empty
                                            <span class="text-subtle-light dark:text-subtle-dark">-</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-text-light dark:text-text-dark text-xs max-w-xs truncate">
                                    {{ $tier->description ?? '-' }}
                                </td>
                                <td class="px-6 py-4 font-medium">
                                    <a href="{{ route('admin.tier.edit', $tier) }}"
                                        class="text-primary hover:opacity-80 mr-3">Edit</a>
                                    <form method="POST" action="{{ route('admin.tier.destroy', $tier) }}"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-background-danger hover:opacity-80"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-card-light dark:bg-card-dark border-b border-border-light dark:border-border-dark">
                                <td colspan="5" class="px-6 py-4 text-center text-subtle-light dark:text-subtle-dark">
                                    No tiers found. <a href="{{ route('admin.tier.create') }}" class="text-primary hover:opacity-80">Create one</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{ $tiers->links() }}
    </div>
</x-layouts.app>
