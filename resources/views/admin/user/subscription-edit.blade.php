<x-layouts.app>
    <div class="max-w-4xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Edit Portfolio Subscription</h1>
            <a href="{{ route('admin.user.show', $portfolio->user) }}" class="text-sm text-primary">Back to user</a>
        </div>

        <div class="bg-white dark:bg-card-dark rounded-xl p-6">
            <div class="mb-6">
                <h2 class="text-lg font-semibold">{{ $portfolio->title }}</h2>
                <p class="text-sm text-gray-500">Template: {{ $portfolio->template?->title }}</p>
            </div>

            <form action="{{ route('admin.portfolio.subscription.update', $portfolio) }}" method="post">
                @csrf
                @method('put')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Plan</label>
                        <select name="plan_id" class="form-input rounded-md h-10 w-full text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800">
                            @foreach($plans as $plan)
                                <option value="{{ $plan->id }}" 
                                    @if(old('plan_id', $subscription?->plan_id) == $plan->id) selected @endif>
                                    {{ $plan->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('plan_id') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Status</label>
                        <select name="status" class="form-input rounded-md h-10 w-full text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800">
                            @php 
                                $currentStatus = old('status', $subscription?->status ?? \App\Enums\PortfolioSubscriptionStatus::ACTIVE); 
                            @endphp
                            @foreach(\App\Enums\PortfolioSubscriptionStatus::cases() as $status)
                                <option value="{{ $status->value }}" 
                                    @if($currentStatus == $status->value) selected @endif
                                    class="{{ $status->color() }}">
                                    {{ $status->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('status') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Expires At</label>
                        <input type="datetime-local" name="expires_at" 
                            value="{{ old('expires_at', $subscription?->expires_at?->format('Y-m-d\TH:i')) }}" 
                            class="form-input rounded-md h-10 w-full text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800" />
                        @error('expires_at') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>