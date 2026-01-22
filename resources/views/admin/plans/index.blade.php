<x-layouts.app>
    <div class="mx-auto max-w-7xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-text-light dark:text-text-dark text-3xl lg:text-4xl font-black tracking-tighter">Plans</h1>
            <a href="{{ route('admin.plan.create') }}"
                class="bg-primary hover:opacity-90 text-text-dark font-bold py-2 px-4 rounded">
                Create Plan
            </a>
        </div>

        <x-table.index>
            <x-table.thead
                class="text-xs text-subtle-light dark:text-subtle-dark uppercase bg-background-light dark:bg-background-dark/20">
                <x-table.th>Name</x-table.th>
                <x-table.th>Tier</x-table.th>
                <x-table.th>Price</x-table.th>
                <x-table.th>Billing Cycle</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th>Actions</x-table.th>
            </x-table.thead>

            <x-table.tbody>
                @forelse ($plans as $plan)
                    <x-table.tr
                        class="bg-card-light dark:bg-card-dark border-b border-border-light dark:border-border-dark hover:bg-background-light dark:hover:bg-background-dark/20">
                        <x-table.td class="font-medium text-text-light dark:text-text-dark whitespace-nowrap">
                            {{ $plan->name }}
                        </x-table.td>
                        <x-table.td class="text-text-light dark:text-text-dark">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary/20 text-primary">
                                {{ $plan->tier?->name ?? '-' }}
                            </span>
                        </x-table.td>
                        <x-table.td class="text-text-light dark:text-text-dark">
                            {{ $plan->price ? '$' . number_format($plan->price, 2) : 'Free' }}
                        </x-table.td>
                        <x-table.td class="text-text-light dark:text-text-dark">
                            {{ $plan->billing_cycle->label() }}
                        </x-table.td>
                        <x-table.td>
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $plan->is_active ? 'bg-green-100 text-green-800' : 'bg-background-danger/20 text-background-danger' }}">
                                {{ $plan->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </x-table.td>
                        <x-table.td class="font-medium">
                            <a href="{{ route('admin.plan.edit', $plan) }}"
                                class="text-primary hover:opacity-80 mr-3">
                              <span class="material-symbols-outlined text-lg">edit</span>
                            </a>
                            <form method="POST" action="{{ route('admin.plan.destroy', $plan) }}" class="inline">
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
                        <x-table.td class="text-center text-subtle-light dark:text-subtle-dark" colspan="6">
                            No plans found. <a href="{{ route('admin.plan.create') }}"
                                class="text-primary hover:opacity-80">Create one</a>
                        </x-table.td>
                    </x-table.tr>
                @endforelse
            </x-table.tbody>
        </x-table.index>

        <x-pagination :paginator="$plans" />
    </div>
</x-layouts.app>
