<x-layouts.app>
    <div class="mx-auto max-w-7xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-text-light dark:text-text-dark text-3xl lg:text-4xl font-black tracking-tighter">Coupons</h1>
            <a href="{{ route('admin.coupon.create') }}"
                class="bg-primary hover:opacity-90 text-text-dark font-bold py-2 px-4 rounded">
                Create Coupon
            </a>
        </div>

        <x-table.index>
            <x-table.title>All Coupons</x-table.title>
            <x-table.thead
                class="text-xs text-subtle-light dark:text-subtle-dark uppercase bg-background-light dark:bg-background-dark/20">
                <x-table.th>Code</x-table.th>
                <x-table.th>Type</x-table.th>
                <x-table.th>Value</x-table.th>
                <x-table.th>Plan</x-table.th>
                <x-table.th>Uses</x-table.th>
                <x-table.th>Expires</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th>Actions</x-table.th>
            </x-table.thead>
            <x-table.tbody>
                @foreach ($coupons as $coupon)
                    <x-table.tr
                        class="bg-card-light dark:bg-card-dark border-b border-border-light dark:border-border-dark hover:bg-background-light dark:hover:bg-background-dark/20">
                        <x-table.td class="font-medium text-text-light dark:text-text-dark whitespace-nowrap">
                            {{ $coupon->code }}
                        </x-table.td>
                        <x-table.td class="text-text-light dark:text-text-dark">
                            {{ $coupon->type->label() }}
                        </x-table.td>
                        <x-table.td class="text-text-light dark:text-text-dark">
                            @if ($coupon->type->value === 'plan_discount' || $coupon->type->value === 'global_discount')
                                {{ $coupon->discount_value }}%
                            @else
                                {{ $coupon->months_value }} months
                            @endif
                        </x-table.td>
                        <x-table.td class="text-text-light dark:text-text-dark">
                            {{ $coupon->plan ? $coupon->plan->name : 'All Plans' }}
                        </x-table.td>
                        <x-table.td class="text-text-light dark:text-text-dark">
                            {{ $coupon->used_count }} / {{ $coupon->max_uses ?: 'Unlimited' }}
                        </x-table.td>
                        <x-table.td class="text-text-light dark:text-text-dark">
                            {{ $coupon->expires_at ? $coupon->expires_at->format('Y-m-d') : 'Never' }}
                        </x-table.td>
                        <x-table.td>
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $coupon->is_active ? 'bg-green-100 text-green-800' : 'bg-background-danger/20 text-background-danger' }}">
                                {{ $coupon->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </x-table.td>
                        <x-table.td class="font-medium">
                            <a href="{{ route('admin.coupon.edit', $coupon) }}"
                                class="text-primary hover:opacity-80 mr-3">
                                <span class="material-symbols-outlined text-lg">edit</span>
                            </a>
                            <form method="POST" action="{{ route('admin.coupon.destroy', $coupon) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-background-danger hover:opacity-80"
                                    onclick="return confirm('Are you sure?')">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </form>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
            </x-table.tbody>
        </x-table.index>

        <x-pagination :paginator="$coupons" />
    </div>
</x-layouts.app>
