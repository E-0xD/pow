<x-layouts.app>
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-text-light dark:text-text-dark">Transactions</h1>
            <p class="mt-1 text-subtle-light dark:text-subtle-dark">Manage and view all transactions</p>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="bg-card-light dark:bg-card-dark rounded-lg shadow-sm p-6 border border-border-light dark:border-border-dark">
        <h2 class="text-lg font-semibold text-text-light dark:text-text-dark mb-6">Summary</h2>

        <!-- Date Range Filter -->
        <form method="GET" action="{{ route('admin.transaction.index') }}" class="mb-6 flex gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-text-light dark:text-text-dark mb-2">From Date</label>
                <input type="date" 
                    name="start_date" 
                    value="{{ request('start_date') }}"
                    class="px-4 py-2 border border-border-light dark:border-border-dark rounded-lg bg-card-light dark:bg-gray-700 text-text-light dark:text-text-dark">
            </div>
            <div>
                <label class="block text-sm font-medium text-text-light dark:text-text-dark mb-2">To Date</label>
                <input type="date" 
                    name="end_date" 
                    value="{{ request('end_date') }}"
                    class="px-4 py-2 border border-border-light dark:border-border-dark rounded-lg bg-card-light dark:bg-gray-700 text-text-light dark:text-text-dark">
            </div>
            <input type="hidden" name="q" value="{{ request('q') }}">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <div class="flex items-end gap-2">
                <button type="submit" 
                    class="px-4 py-2 bg-primary text-text-dark rounded-lg hover:opacity-90 transition-opacity">
                    Apply Filter
                </button>
                <a href="{{ route('admin.transaction.index') }}" 
                    class="px-4 py-2 bg-primary/20 da text-light dark:text-dark rounded-lg hover:opacity-90 transition-opacity text-center">
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
            @foreach($summary['by_status'] as $status => $data)
            <div class="border border-border-light dark:border-border-dark rounded-lg p-4 bg-background-light dark:bg-gray-700">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-text-light dark:text-text-dark">{{ $data['label'] }}</h3>
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
    <div class="bg-card-light dark:bg-card-dark rounded-lg shadow-sm p-6 border border-border-light dark:border-border-dark">
        <form method="GET" action="{{ route('admin.transaction.index') }}" class="flex gap-4">
            <!-- Search -->
            <div class="flex-1">
                <input type="text" 
                    name="q" 
                    value="{{ request('q') }}" 
                    placeholder="Search by reference, email, or name..."
                    class="w-full px-4 py-2 border border-border-light dark:border-border-dark rounded-lg bg-card-light dark:bg-gray-700 text-text-light dark:text-text-dark placeholder-subtle-light dark:placeholder-subtle-dark">
            </div>

            <!-- Status Filter -->
            <div>
                <select name="status" class="px-4 py-2 border border-border-light dark:border-border-dark rounded-lg bg-card-light dark:bg-gray-700 text-text-light dark:text-text-dark">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $status)
                    <option value="{{ $status->value }}" @selected(request('status') === $status->value)>
                        {{ $status->label() }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit -->
            <button type="submit" class="px-6 py-2 bg-primary text-text-dark rounded-lg hover:opacity-90 transition-opacity">
                Filter
            </button>
            <a href="{{ route('admin.transaction.index') }}" class="px-6 py-2 bg-primary/20 da text-light dark:text-dark rounded-lg hover:opacity-90 transition-opacity text-center">
                Reset
            </a>
        </form>
    </div>

    <!-- Transactions Table -->
    <div class="bg-card-light dark:bg-card-dark rounded-lg shadow-sm overflow-hidden border border-border-light dark:border-border-dark">
        <table class="w-full">
            <thead class="bg-background-light dark:bg-gray-700 border-b border-border-light dark:border-border-dark">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-subtle-light dark:text-subtle-dark uppercase">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-subtle-light dark:text-subtle-dark uppercase">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-subtle-light dark:text-subtle-dark uppercase">Reference</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-subtle-light dark:text-subtle-dark uppercase">Gateway</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-subtle-light dark:text-subtle-dark uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-subtle-light dark:text-subtle-dark uppercase">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-light dark:divide-border-dark">
                @forelse($transactions as $transaction)
                <tr class="hover:bg-background-light dark:hover:bg-gray-700 transition-colors">
                    <td class="px-6 py-4">
                        <div>
                            <p class="font-medium text-text-light dark:text-text-dark">{{ $transaction->user->name }}</p>
                            <p class="text-sm text-subtle-light dark:text-subtle-dark">{{ $transaction->user->email }}</p>
                        </div> 
                    </td>
                    <td class="px-6 py-4 font-medium text-text-light dark:text-text-dark">
                        ${{ number_format($transaction->amount, 2) }}
                    </td>
                    <td class="px-6 py-4 text-sm text-subtle-light dark:text-subtle-dark">
                        {{ $transaction->reference }}
                    </td>
                    <td class="px-6 py-4 text-sm text-subtle-light dark:text-subtle-dark">
                        <span class="uppercase text-xs">{{ $transaction->gateway ?? 'N/A' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <form method="POST" action="{{ route('admin.transaction.updateStatus', $transaction) }}" class="flex gap-2 items-center">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="px-3 py-1 text-sm border border-border-light dark:border-border-dark rounded bg-card-light dark:bg-gray-700 text-text-light dark:text-text-dark" onchange="this.form.submit()">
                                @foreach($statuses as $status)
                                <option value="{{ $status->value }}" @selected($transaction->status === $status->value)>
                                    {{ $status->label() }}
                                </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-sm text-subtle-light dark:text-subtle-dark">
                        {{ $transaction->created_at->format('M d, Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-subtle-light dark:text-subtle-dark">
                        No transactions found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <x-pagination :paginator="$transactions" />
    </div>

     
</div>
</x-layouts.app>
