<x-layouts.app>
<div class="mx-auto max-w-4xl px-4 py-8">
    <h1 class="text-text-light dark:text-text-dark text-3xl font-black tracking-tighter mb-6">Create Plan</h1>

    <div class="bg-card-light dark:bg-card-dark shadow-md rounded-lg p-6 border border-border-light dark:border-border-dark">
        <form method="POST" action="{{ route('admin.plan.store') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-text-light dark:text-text-dark">Plan Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                @error('name') <p class="text-background-danger text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="tier_id" class="block text-sm font-medium text-text-light dark:text-text-dark">Tier</label>
                <select name="tier_id" id="tier_id" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                    <option value="">Select Tier</option>
                    @foreach($tiers as $tier)
                        <option value="{{ $tier->id }}" {{ old('tier_id') == $tier->id ? 'selected' : '' }}>
                            {{ $tier->name }}
                        </option>
                    @endforeach
                </select>
                @error('tier_id') <p class="text-background-danger text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-text-light dark:text-text-dark">Description</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary">{{ old('description') }}</textarea>
                @error('description') <p class="text-background-danger text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-text-light dark:text-text-dark">Price</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary">
                <p class="text-subtle-light dark:text-subtle-dark text-xs mt-1">Leave empty for free plans</p>
                @error('price') <p class="text-background-danger text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="billing_cycle" class="block text-sm font-medium text-text-light dark:text-text-dark">Billing Cycle</label>
                <select name="billing_cycle" id="billing_cycle" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                    <option value="">Select Billing Cycle</option>
                    <option value="monthly" {{ old('billing_cycle') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="yearly" {{ old('billing_cycle') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                </select>
                @error('billing_cycle') <p class="text-background-danger text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="duration" class="block text-sm font-medium text-text-light dark:text-text-dark">Plan Duration (Days)</label>
                <input type="number" name="duration" id="duration" value="{{ old('duration') }}" min="1" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary">
                @error('duration') <p class="text-background-danger text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="paystack_plan_code" class="block text-sm font-medium text-text-light dark:text-text-dark">Paystack Plan Code</label>
                <input type="text" name="paystack_plan_code" id="paystack_plan_code" value="{{ old('paystack_plan_code') }}" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary">
                @error('paystack_plan_code') <p class="text-background-danger text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-border-light dark:border-border-dark text-primary shadow-sm focus:ring-primary">
                    <span class="ml-2 text-sm text-text-light dark:text-text-dark">Active</span>
                </label>
                @error('is_active') <p class="text-background-danger text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.plan.index') }}" class="bg-subtle-light hover:opacity-80 text-text-dark font-bold py-2 px-4 rounded">Cancel</a>
                <button type="submit" class="bg-primary hover:opacity-90 text-text-dark font-bold py-2 px-4 rounded">Create Plan</button>
            </div>
        </form>
    </div>
</div>
</x-layouts.app>
