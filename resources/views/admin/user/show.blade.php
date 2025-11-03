<x-layouts.app>
    <div class="w-full max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">User Details</h1>
            <a href="{{ route('admin.user.index') }}" class="text-sm text-primary">Back to users</a>
        </div>

        <div class="bg-white dark:bg-card-dark rounded-xl p-6 mb-6">
            <div class="flex items-start gap-6">
                <img class="w-20 h-20 rounded-2xl" src="{{ $user->avatar ?? asset(config('app.logo')) }}" />
                <div>
                    <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    <p class="text-sm text-gray-500">Joined {{ $user->created_at?->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-card-dark rounded-xl p-6 mb-6">
            <h3 class="font-semibold mb-4">Edit Role & Status</h3>
            <form action="{{ route('admin.user.update', $user) }}" method="post">
                @csrf
                @method('put')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Role</label>
                        <select name="role" class="form-input rounded-md h-10 w-full text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800">
                            @php 
                                $currentRole = old('role', $user->role ?? \App\Enums\UserRole::default()); 
                            @endphp
                            @foreach(\App\Enums\UserRole::cases() as $role)
                                <option value="{{ $role->value }}" 
                                    @if($currentRole == $role->value) selected @endif
                                    class="{{ $role->color() }}">
                                    {{ $role->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('role') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Status</label>
                        <select name="status" class="form-input rounded-md h-10 w-full text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800">
                            @php 
                                $currentStatus = old('status', $user->status ?? \App\Enums\UserStatus::default()); 
                            @endphp
                            @foreach(\App\Enums\UserStatus::cases() as $status)
                                <option value="{{ $status->value }}" 
                                    @if($currentStatus == $status->value) selected @endif
                                    class="{{ $status->color() }}">
                                    {{ $status->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('status') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded">Save</button>
                </div>
            </form>
        </div>

        <!-- Portfolios Table -->
        <div class="bg-white dark:bg-card-dark rounded-xl overflow-x-auto">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold">User Portfolios</h3>
            </div>
            
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 overflow-x-auto">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700/20 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">Title</th>
                        <th class="px-6 py-3">Template</th>
                        <th class="px-6 py-3">Subscription</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Expires</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($portfolios as $portfolio)
                        <tr class="bg-white dark:bg-[#20152d] border-b dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-800/20">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $portfolio->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $portfolio->template?->title ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $portfolio->activeSubscription?->plan?->name ?? 'No active plan' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($portfolio->activeSubscription)
                                    <span class="px-2 py-1 text-xs rounded-full
                                        @if($portfolio->activeSubscription->status->value === 'active') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300
                                        @elseif($portfolio->activeSubscription->status->value === 'cancelled') bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300
                                        @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                        @endif">
                                        {{ ucfirst($portfolio->activeSubscription->status->value) }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                        No subscription
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ $portfolio->activeSubscription?->expires_at?->format('M d, Y') ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.portfolio.subscription.edit', $portfolio) }}" 
                                       class="p-1 text-gray-500 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
