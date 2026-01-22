<x-layouts.app>
    <div class="mx-auto max-w-7xl">
        <!-- Header -->
        <div class="flex flex-wrap justify-between items-start gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-text-light dark:text-text-dark">Transactions</h1>
                <p class="mt-1 text-subtle-light dark:text-subtle-dark">Manage and view all transactions</p>
            </div>
        </div>

        <!-- Summary Cards -->
        <div
            class="bg-card-light dark:bg-card-dark rounded-lg shadow-sm p-6 border border-border-light dark:border-border-dark mb-8">
            <h2 class="text-lg font-semibold text-text-light dark:text-text-dark mb-6">Summary</h2>

            <!-- Date Range Filter -->
            <form method="GET" action="{{ route('admin.transaction.index') }}"
                class="mb-6 flex flex-col md:flex-row gap-4 items-start md:items-end">
                <div class="w-full md:w-auto">
                    <label class="block text-sm font-medium text-text-light dark:text-text-dark mb-2">From Date</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        class="w-full px-4 py-2 border border-border-light dark:border-border-dark rounded-lg bg-card-light dark:bg-gray-700 text-text-light dark:text-text-dark">
                </div>
                <div class="w-full md:w-auto">
                    <label class="block text-sm font-medium text-text-light dark:text-text-dark mb-2">To Date</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="w-full px-4 py-2 border border-border-light dark:border-border-dark rounded-lg bg-card-light dark:bg-gray-700 text-text-light dark:text-text-dark">
                </div>
                <input type="hidden" name="q" value="{{ request('q') }}">
                <input type="hidden" name="status" value="{{ request('status') }}">
                <div class="flex flex-col md:flex-row w-full md:w-auto gap-2">
                    <button type="submit"
                        class="w-full md:w-auto px-4 py-2 bg-primary text-text-dark rounded-lg hover:opacity-90 transition-opacity">
                        Apply Filter
                    </button>
                    <a href="{{ route('admin.transaction.index') }}"
                        class="w-full md:w-auto px-4 py-2 bg-primary/20 da text-light dark:text-dark rounded-lg hover:opacity-90 transition-opacity text-center">
                        Clear
                    </a>
                </div>
            </form>

            <!-- Total Amount -->
            <div class="mb-6">
                <p class="text-sm text-subtle-light dark:text-subtle-dark">Total Amount</p>
                <p class="text-4xl font-bold text-text-light dark:text-text-dark">
                    ${{ number_format($summary['total_amount'], 2) }}
                </p>
            </div>

            <!-- Status Summary Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($summary['by_status'] as $status => $data)
                    <div
                        class="border border-border-light dark:border-border-dark rounded-lg p-4 bg-background-light dark:bg-gray-700">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-medium text-text-light dark:text-text-dark">{{ $data['label'] }}
                            </h3>
                            <span class="px-2 py-1 text-xs font-medium rounded {{ $data['color'] }}">
                                {{ $data['count'] }}
                            </span>
                        </div>
                        <p class="text-2xl font-bold {{ $data['textColor'] }}">
                            ${{ number_format($data['amount'], 2) }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Filters & Search -->
        <div
            class="bg-card-light dark:bg-card-dark rounded-lg shadow-sm p-6 border border-border-light dark:border-border-dark mb-8">
            <form method="GET" action="{{ route('admin.transaction.index') }}"
                class="flex flex-col md:flex-row gap-4">
                <!-- Search -->
                <div class="w-full md:flex-1">
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Search by reference, email, or name..."
                        class="w-full px-4 py-2 border border-border-light dark:border-border-dark rounded-lg bg-card-light dark:bg-gray-700 text-text-light dark:text-text-dark placeholder-subtle-light dark:placeholder-subtle-dark">
                </div>

                <!-- Status Filter -->
                <div class="w-full md:w-auto">
                    <select name="status"
                        class="w-full px-4 py-2 border border-border-light dark:border-border-dark rounded-lg bg-card-light dark:bg-gray-700 text-text-light dark:text-text-dark">
                        <option value="">All Statuses</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->value }}" @selected(request('status') === $status->value)>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit -->
                <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                    <button type="submit"
                        class="w-full md:w-auto px-6 py-2 bg-primary text-text-dark rounded-lg hover:opacity-90 transition-opacity">
                        Filter
                    </button>
                    <a href="{{ route('admin.transaction.index') }}"
                        class="w-full md:w-auto px-6 py-2 bg-primary/20 da text-light dark:text-dark rounded-lg hover:opacity-90 transition-opacity text-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Transactions Table -->
        <x-table.index>
            <x-table.title>All Transactions</x-table.title>
            <x-table.thead>
                <x-table.th>User</x-table.th>
                <x-table.th>Amount</x-table.th>
                <x-table.th>Reference</x-table.th>
                <x-table.th>Gateway</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th>Date</x-table.th>
            </x-table.thead>

            <x-table.tbody>
                @forelse($transactions as $transaction)
                    <x-table.tr>
                        <x-table.td>
                            <div>
                                <p>{{ $transaction->user->name }}</p>
                                <p class="text-sm text-subtle-light dark:text-subtle-dark">
                                    {{ $transaction->user->email }}</p>
                            </div>
                        </x-table.td>
                        <x-table.td>
                            ${{ number_format($transaction->amount, 2) }}
                        </x-table.td>
                        <x-table.td class="text-sm text-subtle-light dark:text-subtle-dark">
                            {{ $transaction->reference }}
                        </x-table.td>
                        <x-table.td class="text-sm text-subtle-light dark:text-subtle-dark">
                            <span class="uppercase text-xs">{{ $transaction->gateway ?? 'N/A' }}</span>
                        </x-table.td>
                        <x-table.td>
                            <form method="POST" action="{{ route('admin.transaction.updateStatus', $transaction) }}"
                                class="flex gap-2 items-center">
                                @csrf
                                @method('PATCH')
                                <select name="status"
                                    class="px-3 py-1 text-sm border border-border-light dark:border-border-dark rounded bg-card-light dark:bg-gray-700 text-text-light dark:text-text-dark"
                                    onchange="this.form.submit()">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->value }}" @selected($transaction->status == $status->value)>
                                            {{ $status->label() }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </x-table.td>
                        <x-table.td class="text-sm text-subtle-light dark:text-subtle-dark">
                            {{ $transaction->created_at->format('M d, Y') }}
                        </x-table.td>
                    </x-table.tr>
                @empty
                    <x-table.tr>
                        <x-table.td class="text-center text-subtle-light dark:text-subtle-dark" colspan="6">
                            No transactions found.
                        </x-table.td>
                    </x-table.tr>
                @endforelse
            </x-table.tbody>
        </x-table.index>

        <x-pagination :paginator="$transactions" />

    </div>
</x-layouts.app>
