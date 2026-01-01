<x-layouts.app>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Create Coupon</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form method="POST" action="{{ route('admin.coupon.store') }}">
            @csrf

            <div class="mb-4">
                <label for="code" class="block text-sm font-medium text-gray-700">Coupon Code</label>
                <input type="text" name="code" id="code" value="{{ old('code') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('code') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Select Type</option>
                    @foreach($types as $value => $label)
                        <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('type') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4" id="discount_value_field" style="display: none;">
                <label for="discount_value" class="block text-sm font-medium text-gray-700">Discount Value (%)</label>
                <input type="number" name="discount_value" id="discount_value" value="{{ old('discount_value') }}" min="0" max="100" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('discount_value') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4" id="months_value_field" style="display: none;">
                <label for="months_value" class="block text-sm font-medium text-gray-700">Months</label>
                <input type="number" name="months_value" id="months_value" value="{{ old('months_value') }}" min="1" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('months_value') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4" id="applicable_plan_field" style="display: none;">
                <label for="applicable_plan_id" class="block text-sm font-medium text-gray-700">Applicable Plan</label>
                <select name="applicable_plan_id" id="applicable_plan_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Select Plan</option>
                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}" {{ old('applicable_plan_id') == $plan->id ? 'selected' : '' }}>{{ $plan->name }}</option>
                    @endforeach
                </select>
                @error('applicable_plan_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="max_uses" class="block text-sm font-medium text-gray-700">Max Uses</label>
                <input type="number" name="max_uses" id="max_uses" value="{{ old('max_uses') }}" min="1" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('max_uses') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="expires_at" class="block text-sm font-medium text-gray-700">Expires At</label>
                <input type="datetime-local" name="expires_at" id="expires_at" value="{{ old('expires_at') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('expires_at') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-700">Active</span>
                </label>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.coupon.index') }}" class="mr-4 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Cancel</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Coupon</button>
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