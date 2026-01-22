<x-layouts.app>
    <div class="w-full max-w-7xl mx-auto">
        <!-- PageHeading -->
        <div class="flex flex-wrap justify-between gap-4 items-center mb-6">
            <h1 class="text-3xl font-bold leading-tight tracking-tight text-text-light dark:text-text-dark">Manage
                Affiliates</h1>
        </div>
        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <div
                class="flex flex-1 flex-col gap-2 rounded-xl p-6 border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark">
                <p class="text-base font-medium leading-normal text-text-secondary-light dark:text-text-secondary-dark">
                    Total Affiliates</p>
                <p class="tracking-tight text-3xl font-bold leading-tight text-text-light dark:text-text-dark">
                    {{ number_format($totalAffiliates) }}</p>
            </div>
            <div
                class="flex flex-1 flex-col gap-2 rounded-xl p-6 border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark">
                <p class="text-base font-medium leading-normal text-text-secondary-light dark:text-text-secondary-dark">
                    Pending Withdrawals</p>
                <p class="tracking-tight text-3xl font-bold leading-tight text-text-light dark:text-text-dark">
                    ${{ number_format($pendingWithdrawals, 2) }}</p>
            </div>
            <div
                class="flex flex-1 flex-col gap-2 rounded-xl p-6 border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark">
                <p class="text-base font-medium leading-normal text-text-secondary-light dark:text-text-secondary-dark">
                    Commissions Paid</p>
                <p class="tracking-tight text-3xl font-bold leading-tight text-text-light dark:text-text-dark">
                    ${{ number_format($totalPaid, 2) }}</p>
            </div>
        </div>
        <!-- ToolBar -->
        <div class="flex flex-col md:flex-row justify-between gap-4 py-3 items-center mb-4">
            <div class="relative w-full md:max-w-xs">
                <span
                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary-light dark:text-text-secondary-dark">search</span>
                <input
                    class="w-full rounded-md pl-10 pr-4 py-2 text-sm text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800"
                    placeholder="Search by name or email..." type="text" />
            </div>
            <div class="flex gap-4">
                <select
                    class="rounded-md px-3 py-2 text-sm text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800">
                    <option>All</option>
                    <option>Active</option>
                    <option>Pending Withdrawal</option>
                </select>
            </div>
        </div>
        <!-- Table -->
        <x-table.index>
            <x-table.thead>
                <x-table.th>Affiliate Name</x-table.th>
                <x-table.th>Total Referrals</x-table.th>
                <x-table.th>Total Earnings</x-table.th>
                <x-table.th>Commission %</x-table.th>
                <x-table.th>Balance</x-table.th>
                <x-table.th>Actions</x-table.th>
            </x-table.thead>
            <x-table.tbody>
                @foreach ($affiliates as $affiliate)
                    <x-table.tr>
                        <x-table.td>
                            <div>
                                <div class="font-medium">{{ $affiliate->user->name }}</div>
                                <div class="text-gray-500 text-xs">{{ $affiliate->user->email }}</div>
                            </div>
                        </x-table.td>
                        <x-table.td>
                            {{ $affiliate->user->referredBy()->count() }}
                        </x-table.td>
                        <x-table.td>
                            ${{ number_format($affiliate->total_commission ?? 0, 2) }}
                        </x-table.td>
                        <x-table.td>
                            {{ $affiliate->commission_rate }}%
                        </x-table.td>
                        <x-table.td>
                            ${{ number_format($affiliate->balance, 2) }}
                        </x-table.td>
                        <x-table.td>
                            <div class="flex items-center justify-end gap-2">
                                @if ($affiliate->balance > 0)
                                    <button
                                        onclick="document.getElementById('payout-modal-{{ $affiliate->id }}').classList.remove('hidden')"
                                        class="p-2 rounded-md text-green-600 hover:bg-green-100 dark:hover:bg-green-900/30">
                                        <span class="material-symbols-outlined text-lg">payments</span>
                                    </button>
                                @endif
                                <a href="{{ route('admin.affiliate.edit', $affiliate) }}"
                                    class="p-2 rounded-md text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                </a>
                                <form action="{{ route('admin.affiliate.destroy', $affiliate) }}" method="post"
                                    class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to remove this affiliate?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="p-2 rounded-md text-red-500 hover:bg-red-100 dark:hover:bg-red-900/30">
                                        <span class="material-symbols-outlined text-lg">person_remove</span>
                                    </button>
                                </form>
                            </div>

                            <!-- Payout Modal -->
                            @if ($affiliate->balance > 0)
                                <div id="payout-modal-{{ $affiliate->id }}"
                                    class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                                    <div class="bg-white dark:bg-card-dark rounded-xl p-6 max-w-md w-full mx-4">
                                        <h3 class="text-lg font-semibold mb-4">Process Payout</h3>
                                        <form action="{{ route('admin.affiliate.payout', $affiliate) }}"
                                            method="post">
                                            @csrf
                                            <div>
                                                <label class="block text-sm font-medium">Amount</label>
                                                <input type="number" name="amount" min="0"
                                                    max="{{ $affiliate->balance }}" step="0.01"
                                                    value="{{ old('amount', $affiliate->balance) }}"
                                                    class="form-input rounded-md h-10 w-full mt-1 text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800" />
                                                @error('amount')
                                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="mt-4">
                                                <button type="submit"
                                                    class="px-4 py-2 bg-primary text-white rounded">Process</button>
                                                <button type="button"
                                                    onclick="document.getElementById('payout-modal-{{ $affiliate->id }}').classList.add('hidden')"
                                                    class="px-4 py-2 text-gray-500">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </x-table.td>
                    </x-table.tr>
                @endforeach
            </x-table.tbody>
        </x-table.index>
        <!-- Pagination -->

        <x-pagination :paginator="$affiliates" />
    </div>
    </div>
</x-layouts.app>
