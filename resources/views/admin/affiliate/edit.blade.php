<x-layouts.app>
    <div class="max-w-4xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Edit Affiliate</h1>
            <a href="{{ route('admin.affiliate.index') }}" class="text-sm text-primary">Back to affiliates</a>
        </div>

        <div class="bg-white dark:bg-card-dark rounded-xl p-6">
            <div class="mb-6">
                <h2 class="text-lg font-semibold">{{ $affiliate->user->name }}</h2>
                <p class="text-sm text-gray-500">{{ $affiliate->user->email }}</p>
            </div>

            <form action="{{ route('admin.affiliate.update', $affiliate) }}" method="post">
                @csrf
                @method('put')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Commission Rate (%)</label>
                        <input type="number" name="commission_rate" 
                            min="0" max="100" step="0.1"
                            value="{{ old('commission_rate', $affiliate->commission_rate) }}" 
                            class="form-input rounded-md h-10 w-full text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800" />
                        @error('commission_rate') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Payout Method</label>
                        <select name="payout_method" class="form-input rounded-md h-10 w-full text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800">
                            @php $method = old('payout_method', $affiliate->payout_method) @endphp
                            <option value="paypal" @selected($method === 'paypal')>PayPal</option>
                            <option value="bank" @selected($method === 'bank')>Bank Transfer</option>
                            <option value="crypto" @selected($method === 'crypto')>Cryptocurrency</option>
                        </select>
                        @error('payout_method') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium">Account Details</label>
                        <input type="text" name="payout_details[account]" 
                            value="{{ old('payout_details.account', $affiliate->payout_details['account'] ?? '') }}"
                            class="form-input rounded-md h-10 w-full text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800" 
                            placeholder="PayPal email or account details" />
                        @error('payout_details.account') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>