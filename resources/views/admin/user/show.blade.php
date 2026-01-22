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

        <!-- Affiliate Section -->
        <div class="bg-white dark:bg-card-dark rounded-xl p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold">Affiliate Status</h3>
                @if (!$user->affiliate)
                    <button type="button"
                        onclick="document.getElementById('affiliate-form').classList.remove('hidden')"
                        class="px-4 py-2 bg-primary text-white rounded text-sm">Make Affiliate</button>
                @endif
            </div>

            @if ($user->affiliate)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Commission Rate</p>
                        <p class="font-medium">{{ $user->affiliate->commission_rate }}%</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Current Balance</p>
                        <p class="font-medium">${{ number_format($user->affiliate->balance, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Last Payout</p>
                        <p class="font-medium">{{ $user->affiliate->last_payout_at?->format('M d, Y') ?? 'Never' }}</p>
                    </div>
                </div>
            @endif

            <!-- New Affiliate Form -->
            <form id="affiliate-form" action="{{ route('admin.affiliate.store', $user->id) }}" method="post"
                class="{{ $user->affiliate ? 'hidden' : 'hidden mt-4 border-t dark:border-gray-700 pt-4' }}">
                @csrf
                <div>
                    <label class="block text-sm font-medium">Commission Rate (%)</label>
                    <input type="number" name="commission_rate" min="0" max="100" step="0.1"
                        value="{{ old('commission_rate', 10) }}"
                        class="form-input rounded-md h-10 w-full text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800" />
                    @error('commission_rate')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded">Save</button>
                    <button type="button" onclick="document.getElementById('affiliate-form').classList.add('hidden')"
                        class="px-4 py-2 text-gray-500 rounded">Cancel</button>
                </div>
            </form>
        </div>

        <div class="bg-white dark:bg-card-dark rounded-xl p-6 mb-6">
            <h3 class="font-semibold mb-4">Edit Role & Status</h3>
            <form action="{{ route('admin.user.update', $user) }}" method="post">
                @csrf
                @method('put')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Role</label>
                        <select name="role"
                            class="form-input rounded-md h-10 w-full text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800">
                            @php
                                $currentRole = old('role', $user->role->value ?? \App\Enums\UserRole::USER);
                            @endphp
                            @foreach (\App\Enums\UserRole::cases() as $role)
                                <option value="{{ $role->value }}" @if ($currentRole == $role->value) selected @endif
                                    class="{{ $role->color() }}">
                                    {{ $role->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Status</label>
                        <select name="status"
                            class="form-input rounded-md h-10 w-full text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800">
                            @php
                                $currentStatus = old('status', $user->status->value ?? \App\Enums\UserStatus::ACTIVE);
                            @endphp
                            @foreach (\App\Enums\UserStatus::cases() as $status)
                                <option value="{{ $status->value }}" @if ($currentStatus == $status->value) selected @endif
                                    class="{{ $status->color() }}">
                                    {{ $status->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded">Save</button>
                </div>
            </form>
        </div>

        <!-- Portfolios Table -->
        <x-table.index>
            <x-table.title>User Portfolios</x-table.title>

            <x-table.thead>
                <x-table.th>Title</x-table.th>
                <x-table.th>Template</x-table.th>
                <x-table.th>Actions</x-table.th>
            </x-table.thead>

            <x-table.tbody>
                @foreach ($portfolios as $portfolio)
                    <x-table.tr
                        class="bg-white dark:bg-[#20152d] border-b dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-800/20">
                        <x-table.td class="font-medium text-gray-900 dark:text-white">
                            {{ $portfolio->title }}
                        </x-table.td>
                        <x-table.td>
                            {{ $portfolio->template?->title ?? 'N/A' }}
                        </x-table.td>
                        <x-table.td>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.portfolio.edit', $portfolio) }}"
                                    class="p-1 text-gray-500 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                </a>

                                <form method="POST" action="{{ route('admin.portfolio.destroy', $portfolio) }}"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-background-danger hover:opacity-80"
                                        onclick="return confirm('Are you sure?')">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </form>
                            </div>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
            </x-table.tbody>
        </x-table.index>
    </div>
</x-layouts.app>
