<x-layouts.app>
<div class="mx-auto max-w-7xl px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-text-light dark:text-text-dark text-3xl lg:text-4xl font-black tracking-tighter">Coupons</h1>
        <a href="{{ route('admin.coupon.create') }}" class="bg-primary hover:opacity-90 text-text-dark font-bold py-2 px-4 rounded">
            Create Coupon
        </a>
    </div>

    <div class="bg-card-light dark:bg-card-dark shadow-md rounded-lg overflow-hidden border border-border-light dark:border-border-dark">
        <table class="min-w-full divide-y divide-border-light dark:divide-border-dark">
            <thead class="bg-background-light dark:bg-background-dark">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-subtle-light dark:text-subtle-dark uppercase tracking-wider">Code</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-subtle-light dark:text-subtle-dark uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-subtle-light dark:text-subtle-dark uppercase tracking-wider">Value</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-subtle-light dark:text-subtle-dark uppercase tracking-wider">Plan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-subtle-light dark:text-subtle-dark uppercase tracking-wider">Uses</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-subtle-light dark:text-subtle-dark uppercase tracking-wider">Expires</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-subtle-light dark:text-subtle-dark uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-subtle-light dark:text-subtle-dark uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-card-light dark:bg-card-dark divide-y divide-border-light dark:divide-border-dark">
                @foreach($coupons as $coupon)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-text-light dark:text-text-dark">{{ $coupon->code }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-subtle-light dark:text-subtle-dark">{{ $coupon->type->label() }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-subtle-light dark:text-subtle-dark">
                        @if($coupon->type->value === 'plan_discount' || $coupon->type->value === 'global_discount')
                            {{ $coupon->discount_value }}%
                        @else
                            {{ $coupon->months_value }} months
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-subtle-light dark:text-subtle-dark">
                        {{ $coupon->plan ? $coupon->plan->name : 'All Plans' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-subtle-light dark:text-subtle-dark">
                        {{ $coupon->used_count }} / {{ $coupon->max_uses ?: 'Unlimited' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-subtle-light dark:text-subtle-dark">
                        {{ $coupon->expires_at ? $coupon->expires_at->format('Y-m-d') : 'Never' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $coupon->is_active ? 'bg-green-100 text-green-800' : 'bg-background-danger/20 text-background-danger' }}">
                            {{ $coupon->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.coupon.edit', $coupon) }}" class="text-primary hover:opacity-80 mr-3">Edit</a>
                        <form method="POST" action="{{ route('admin.coupon.destroy', $coupon) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-background-danger hover:opacity-80" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $coupons->links() }}
</div>
</x-layouts.app>