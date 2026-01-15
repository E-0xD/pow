<x-layouts.app>
    <div class="mx-auto max-w-7xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-text-light dark:text-text-dark text-3xl lg:text-4xl font-black tracking-tighter">Plans</h1>
            <a href="{{ route('admin.plan.create') }}"
                class="bg-primary hover:opacity-90 text-text-dark font-bold py-2 px-4 rounded">
                Create Plan
            </a>
        </div>

        <div class="bg-white dark:bg-[#20152d] rounded-xl p-6">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-subtle-light dark:text-subtle-dark uppercase bg-background-light dark:bg-background-dark/20">
                        <tr>
                            <th class="px-6 py-3" scope="col">Name</th>
                            <th class="px-6 py-3" scope="col">Tier</th>
                            <th class="px-6 py-3" scope="col">Price</th>
                            <th class="px-6 py-3" scope="col">Billing Cycle</th>
                            <th class="px-6 py-3" scope="col">Status</th>
                            <th class="px-6 py-3" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($plans as $plan)
                            <tr class="bg-card-light dark:bg-card-dark border-b border-border-light dark:border-border-dark hover:bg-background-light dark:hover:bg-background-dark/20">
                                <td class="px-6 py-4 font-medium text-text-light dark:text-text-dark whitespace-nowrap">
                                    {{ $plan->name }}</td>
                                <td class="px-6 py-4 text-text-light dark:text-text-dark">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary/20 text-primary">
                                        {{ $plan->tier?->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-text-light dark:text-text-dark">
                                    {{ $plan->price ? '$' . number_format($plan->price, 2) : 'Free' }}
                                </td>
                                <td class="px-6 py-4 text-text-light dark:text-text-dark">
                                    {{ $plan->billing_cycle->label() }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $plan->is_active ? 'bg-green-100 text-green-800' : 'bg-background-danger/20 text-background-danger' }}">
                                        {{ $plan->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-medium">
                                    <a href="{{ route('admin.plan.edit', $plan) }}"
                                        class="text-primary hover:opacity-80 mr-3">Edit</a>
                                    <form method="POST" action="{{ route('admin.plan.destroy', $plan) }}"
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
                                <td colspan="6" class="px-6 py-4 text-center text-subtle-light dark:text-subtle-dark">
                                    No plans found. <a href="{{ route('admin.plan.create') }}" class="text-primary hover:opacity-80">Create one</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{ $plans->links() }}
    </div>
</x-layouts.app>
