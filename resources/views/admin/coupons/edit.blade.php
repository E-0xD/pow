<x-layouts.app>
<div class="mx-auto max-w-4xl px-4 py-8">
    <h1 class="text-text-light dark:text-text-dark text-3xl font-black tracking-tighter mb-6">Edit Coupon</h1>

    <div class="bg-card-light dark:bg-card-dark shadow-md rounded-lg p-6 border border-border-light dark:border-border-dark">
        <form method="POST" action="{{ route('admin.coupon.update', $coupon) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="code" class="block text-sm font-medium text-text-light dark:text-text-dark">Coupon Code</label>
                <input type="text" name="code" id="code" value="{{ old('code', $coupon->code) }}" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                @error('code') <p class="text-background-danger text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-text-light dark:text-text-dark">Type</label>
                <select name="type" id="type" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                    <option value="">Select Type</option>
                    @foreach($types as $value => $label)
                        <option value="{{ $value }}" {{ old('type', $coupon->type->value) == $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('type') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4" id="discount_value_field" style="{{ in_array(old('type', $coupon->type->value), ['plan_discount', 'global_discount']) ? '' : 'display: none;' }}">
                <label for="discount_value" class="block text-sm font-medium text-text-light dark:text-text-dark">Discount Value (%)</label>
                <input type="number" name="discount_value" id="discount_value" value="{{ old('discount_value', $coupon->discount_value) }}" min="0" max="100" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary">
                @error('discount_value') <p class="text-background-danger text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4" id="months_value_field" style="{{ in_array(old('type', $coupon->type->value), ['free_months', 'extra_months']) ? '' : 'display: none;' }}">
                <label for="months_value" class="block text-sm font-medium text-text-light dark:text-text-dark">Months</label>
                <input type="number" name="months_value" id="months_value" value="{{ old('months_value', $coupon->months_value) }}" min="1" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary">
                @error('months_value') <p class="text-background-danger text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4" id="applicable_plan_field" style="{{ old('type', $coupon->type->value) == 'plan_discount' ? '' : 'display: none;' }}">
                <label for="applicable_plan_id" class="block text-sm font-medium text-text-light dark:text-text-dark">Applicable Plan</label>
                <select name="applicable_plan_id" id="applicable_plan_id" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    <option value="">Select Plan</option>
                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}" {{ old('applicable_plan_id', $coupon->applicable_plan_id) == $plan->id ? 'selected' : '' }}>{{ $plan->name }}</option>
                    @endforeach
                </select>
                @error('applicable_plan_id') <p class="text-background-danger text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="max_uses" class="block text-sm font-medium text-text-light dark:text-text-dark">Max Uses</label>
                <input type="number" name="max_uses" id="max_uses" value="{{ old('max_uses', $coupon->max_uses) }}" min="1" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary">
                @error('max_uses') <p class="text-background-danger text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="expires_at" class="block text-sm font-medium text-text-light dark:text-text-dark">Expires At</label>
                <input type="datetime-local" name="expires_at" id="expires_at" value="{{ old('expires_at', $coupon->expires_at ? $coupon->expires_at->format('Y-m-d\TH:i') : '') }}" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary">
                @error('expires_at') <p class="text-background-danger text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }} class="rounded border-border-light dark:border-border-dark text-primary shadow-sm focus:ring-primary">
                    <span class="ml-2 text-sm text-text-light dark:text-text-dark">Active</span>
                </label>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.coupon.index') }}" class="bg-subtle-light hover:opacity-80 text-text-dark font-bold py-2 px-4 rounded">Cancel</a>
                <button type="submit" class="bg-primary hover:opacity-90 text-text-dark font-bold py-2 px-4 rounded">Update Coupon</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('type').addEventListener('change', function() {
    const type = this.value;
    const discountField = document.getElementById('discount_value_field');
    const monthsField = document.getElementById('months_value_field');
    const planField = document.getElementById('applicable_plan_field');

    discountField.style.display = (type === 'plan_discount' || type === 'global_discount') ? 'block' : 'none';
    monthsField.style.display = (type === 'free_months' || type === 'extra_months') ? 'block' : 'none';
    planField.style.display = (type === 'plan_discount') ? 'block' : 'none';
});
</script>
</x-layouts.app>