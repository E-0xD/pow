<x-layouts.app>
    <div class="mx-auto max-w-7xl">
        <!-- Page Heading & Filters -->
        <div class="flex flex-wrap justify-between items-start gap-4 mb-8">
            <div class="flex flex-col gap-2">
                <p
                    class="text-text-light-primary dark:text-text-dark-primary text-3xl lg:text-4xl font-black tracking-tighter">
                    Growth Analytics
                </p>
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-base font-normal leading-normal">
                    Insights into platform performance and user growth.
                </p>
            </div>
            <div class="flex gap-2 flex-wrap">
                <form method="get" class="flex items-center gap-2">
                    <label for="period" class="sr-only">Period</label>
                    <select id="period" name="period" onchange="this.form.submit()"
                        class="h-10 rounded-lg bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark px-3 text-text-light-secondary dark:text-text-dark-secondary">
                        <option value="daily" {{ request('period') == 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="weekly" {{ request('period') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="monthly"
                            {{ request('period') == 'monthly' || !request('period') ? 'selected' : '' }}>Monthly
                        </option>
                        <option value="quarterly" {{ request('period') == 'quarterly' ? 'selected' : '' }}>Quarterly
                        </option>
                        <option value="biannual" {{ request('period') == 'biannual' ? 'selected' : '' }}>Biannual
                        </option>
                        <option value="annually" {{ request('period') == 'annually' ? 'selected' : '' }}>Annually
                        </option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Stats Cards - 6 Column Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    Total Users</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">
                    {{ number_format($totalUsers ?? 0) }}</p>
                <p class="text-text-light-secondary text-xs">All time</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    New Users</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">
                    {{ number_format($newUsers ?? 0) }}</p>
                <p class="{{ $userGrowthRate >= 0 ? 'text-[#078847]' : 'text-[#e74808]' }} text-sm font-medium leading-normal flex items-center">
                    <span
                        class="material-symbols-outlined text-base">{{ $userGrowthRate >= 0 ? 'arrow_upward' : 'arrow_downward' }}</span>{{ number_format(abs($userGrowthRate ?? 0), 1) }}%
                </p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    MRR</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">
                    ${{ number_format($mrr ?? 0, 0) }}</p>
                <p class="{{ $revenueGrowthRate >= 0 ? 'text-[#078847]' : 'text-[#e74808]' }} text-sm font-medium leading-normal flex items-center">
                    <span
                        class="material-symbols-outlined text-base">{{ $revenueGrowthRate >= 0 ? 'arrow_upward' : 'arrow_downward' }}</span>{{ number_format(abs($revenueGrowthRate ?? 0), 1) }}%
                </p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    ARPU</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">
                    ${{ number_format($arpu ?? 0, 2) }}</p>
                <p class="text-text-light-secondary text-xs">Per user</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    Churn Rate</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">
                    {{ number_format($churnRate ?? 0, 1) }}%</p>
                <p class="text-negative text-sm font-medium leading-normal flex items-center">
                    <span
                        class="material-symbols-outlined text-base">arrow_downward</span>{{ number_format(abs($churnRate ?? 0.2), 1) }}%
                </p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    Conversion</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">
                    {{ number_format($portfolioConversionRate ?? 0, 1) }}%</p>
                <p class="text-text-light-secondary text-xs">Portfolio</p>
            </div>

            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    DAU</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-2xl font-bold">
                    {{ number_format($dau ?? 0) }}</p>
                <p class="text-text-light-secondary text-xs">Daily Active</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    WAU</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-2xl font-bold">
                    {{ number_format($wau ?? 0) }}</p>
                <p class="text-text-light-secondary text-xs">Weekly Active</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    MAU</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-2xl font-bold">
                    {{ number_format($mau ?? 0) }}</p>
                <p class="text-text-light-secondary text-xs">Monthly Active</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    ARR</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-2xl font-bold">
                    ${{ number_format($arr ?? 0, 0) }}</p>
                <p class="text-text-light-secondary text-xs">Annual Revenue</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    Retention</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-2xl font-bold">
                    {{ number_format($retentionRate ?? 0, 1) }}%</p>
                <p class="text-text-light-secondary text-xs">Keep using</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    Activation</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-2xl font-bold">
                    {{ number_format($activationRate ?? 0, 1) }}%</p>
                <p class="text-text-light-secondary text-xs">Created portfolio</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    LTV</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-2xl font-bold">
                    ${{ number_format($avgLTV ?? 0, 0) }}</p>
                <p class="text-text-light-secondary text-xs">Lifetime value</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    Portfolio TTV</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-2xl font-bold">
                    {{ number_format($avgPortfolioTTV ?? 0, 1) }}</p>
                <p class="text-text-light-secondary text-xs">Days to create</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    Sub TTV</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-2xl font-bold">
                    {{ number_format($avgSubscriptionTTV ?? 0, 1) }}</p>
                <p class="text-text-light-secondary text-xs">Days to subscribe</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    Sub Conv</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-2xl font-bold">
                    {{ number_format($subscriptionConversionRate ?? 0, 1) }}%</p>
                <p class="text-text-light-secondary text-xs">Subscription</p>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- User Signups vs Churn -->
            <div
                class="lg:col-span-2 flex flex-col gap-2 rounded-lg border border-border-light dark:border-border-dark p-6 bg-card-light dark:bg-card-dark">
                <p class="text-text-light-primary dark:text-text-dark-primary text-base font-medium leading-normal">User
                    Signups vs. Churn</p>
                <div class="flex items-center gap-1">
                    <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-normal">Last
                        {{ ucfirst($period ?? 'monthly') }}</p>
                </div>
                <div class="flex min-h-[250px] flex-1 flex-col gap-8 py-4">
                    <canvas id="signupsChart" class="w-full" style="height:320px"></canvas>
                </div>
            </div>
            <!-- Monthly Revenue -->
            <div
                class="flex flex-col gap-2 rounded-lg border border-border-light dark:border-border-dark p-6 bg-card-light dark:bg-card-dark">
                <p class="text-text-light-primary dark:text-text-dark-primary text-base font-medium leading-normal">
                    Monthly Revenue Growth</p>
                <div class="flex items-center gap-1">
                    <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-normal">Last 6
                        Months</p>
                </div>
                <div class="flex min-h-[250px] flex-1 flex-col gap-8 py-4">
                    <canvas id="revenueChart" class="w-full" style="height:320px"></canvas>
                </div>
            </div>
        </div>

        <!-- Active vs Inactive Data -->
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-6 gap-6 mb-8">
            <!-- Active vs Inactive Users -->
            <div
                class="xl:col-span-3 flex flex-col gap-4 rounded-lg border border-border-light dark:border-border-dark p-6 bg-card-light dark:bg-card-dark">
                <p class="text-text-light-primary dark:text-text-dark-primary text-base font-medium leading-normal">
                    Active vs Inactive Users</p>
                <div class="flex-1 flex items-center justify-center py-4">
                    <div class="w-48 h-48">
                        <canvas id="activePie" class="w-full h-full"></canvas>
                    </div>
                </div>
                <div class="flex justify-center gap-6 text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-primary"></span>
                        <p class="text-text-light-secondary dark:text-text-dark-secondary">Active
                            ({{ number_format($dau ?? 0) }})</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-border-light dark:bg-border-dark"></span>
                        <p class="text-text-light-secondary dark:text-text-dark-secondary">Inactive
                            ({{ number_format(max(0, ($totalUsers ?? 0) - ($dau ?? 0))) }})</p>
                    </div>
                </div>
            </div>

            <!-- Device Breakdown -->
            <div
                class="xl:col-span-3 flex flex-col gap-4 rounded-lg border border-border-light dark:border-border-dark p-6 bg-card-light dark:bg-card-dark">
                <p class="text-text-light-primary dark:text-text-dark-primary text-base font-medium leading-normal">
                    Active Users by Device</p>
                <div class="flex items-center gap-1">
                    <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-normal">Current
                        Period</p>
                </div>
                <div class="flex min-h-[250px] flex-1 flex-col gap-8 py-4">
                    <canvas id="deviceChart" class="w-full" style="height:300px"></canvas>
                </div>
            </div>

        </div>

        <!-- Geographic Breakdown by City & Users Summary -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Top Countries by Users -->
            <div>
                <x-table.index>
                    <x-table.title>Top Countries by Users</x-table.title>
                    <x-table.thead>
                        <x-table.th>Country</x-table.th>
                        <x-table.th class="text-right">Users</x-table.th>
                    </x-table.thead>
                    <x-table.tbody>
                        @forelse($topCountries as $item)
                            <x-table.tr>
                                <x-table.td>{{ $item['country'] }}</x-table.td>
                                <x-table.td class="text-right font-semibold">{{ number_format($item['users']) }}</x-table.td>
                            </x-table.tr>
                        @empty
                            <x-table.tr>
                                <x-table.td colspan="2" class="text-center">No geographic data available</x-table.td>
                            </x-table.tr>
                        @endforelse
                    </x-table.tbody>
                </x-table.index>
            </div>
            <!-- Top Cities -->
            <div>
                <x-table.index>
                    <x-table.title>Top Cities by Users</x-table.title>
                    <x-table.thead>
                        <x-table.th>City</x-table.th>
                        <x-table.th class="text-right">Users</x-table.th>
                    </x-table.thead>
                    <x-table.tbody>
                        @forelse($usersByCity as $city => $count)
                            <x-table.tr>
                                <x-table.td>{{ $city }}</x-table.td>
                                <x-table.td class="text-right font-semibold">{{ number_format($count) }}</x-table.td>
                            </x-table.tr>
                        @empty
                            <x-table.tr>
                                <x-table.td colspan="2" class="text-center">No city data available</x-table.td>
                            </x-table.tr>
                        @endforelse
                    </x-table.tbody>
                </x-table.index>
            </div>
            <!-- Countries Represented -->
            <div>
                <x-table.index>
                    <x-table.title>Countries Represented</x-table.title>
                    <x-table.thead>
                        <x-table.th>Country</x-table.th>
                        <x-table.th class="text-right">Users</x-table.th>
                    </x-table.thead>
                    <x-table.tbody>
                        @forelse($usersByCountry as $country => $count)
                            <x-table.tr>
                                <x-table.td>{{ $country }}</x-table.td>
                                <x-table.td class="text-right font-semibold">{{ number_format($count) }}</x-table.td>
                            </x-table.tr>
                        @empty
                            <x-table.tr>
                                <x-table.td colspan="2" class="text-center">No country data available</x-table.td>
                            </x-table.tr>
                        @endforelse
                    </x-table.tbody>
                </x-table.index>
            </div>
        </div>

        <!-- Engagement & Device Breakdown -->
       <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Engagement Metrics -->
    <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 content-start">
        
        <div class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
            <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                Portfolio Visits
            </p>
            <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">
                {{ number_format($visitsCount ?? 0) }}
            </p>
        </div>

        <div class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
            <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                Messages Received
            </p>
            <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">
                {{ number_format($messagesCount ?? 0) }}
            </p>
        </div>

        <div class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
            <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                Total Portfolios
            </p>
            <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">
                {{ number_format($totalPortfolios ?? 0) }}
            </p>
        </div>

        <div class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
            <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                New Portfolios
            </p>
            <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">
                {{ number_format($newPortfolios ?? 0) }}
            </p>
            <p class="text-text-light-secondary text-xs">This {{ $period ?? 'period' }}</p>
        </div>

        <div class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
            <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                Period Revenue
            </p>
            <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">
                ${{ number_format($revenueCurrent ?? 0, 0) }}
            </p>
            <p class="text-text-light-secondary text-xs">This {{ $period ?? 'period' }}</p>
        </div>

    </div>
</div>

        <!-- Template Statistics -->
        <div class="mt-8">
            <x-table.index>
                <x-table.title>Template Usage Statistics</x-table.title>
                <x-table.thead>
                    <x-table.th>Template</x-table.th>
                    <x-table.th class="text-right">Overall Portfolios</x-table.th>
                    <x-table.th class="text-right">Period Portfolios</x-table.th>
                    <x-table.th class="text-right">% of Period</x-table.th>
                </x-table.thead>
                <x-table.tbody>
                    @forelse($templateStats as $template)
                        <x-table.tr>
                            <x-table.td class="font-medium">{{ $template['title'] }}</x-table.td>
                            <x-table.td class="text-right">{{ number_format($template['overall_portfolios']) }}</x-table.td>
                            <x-table.td class="text-right font-semibold">{{ number_format($template['period_portfolios']) }}</x-table.td>
                            <x-table.td class="text-right">
                                @if($newPortfolios > 0)
                                    {{ number_format(($template['period_portfolios'] / $newPortfolios) * 100, 1) }}%
                                @else
                                    0%
                                @endif
                            </x-table.td>
                        </x-table.tr>
                    @empty
                        <x-table.tr>
                            <x-table.td colspan="4" class="text-center">No template data available</x-table.td>
                        </x-table.tr>
                    @endforelse
                </x-table.tbody>
            </x-table.index>
        </div>

        <!-- Cohort Retention Analysis -->
        <div class="mt-8">
            <x-table.index>
                <x-table.title>Cohort Retention Analysis (30-Day)</x-table.title>
                <x-table.thead>
                    <x-table.th>Signup Cohort</x-table.th>
                    <x-table.th class="text-right">Day 0</x-table.th>
                    <x-table.th class="text-right">Day 7</x-table.th>
                    <x-table.th class="text-right">Day 14</x-table.th>
                    <x-table.th class="text-right">Day 30</x-table.th>
                </x-table.thead>
                <x-table.tbody>
                    @forelse($cohortRetention ?? [] as $cohort => $retention)
                        <x-table.tr>
                            <x-table.td
                                class="text-text-light-secondary dark:text-text-dark-secondary font-medium">{{ $cohort }}</x-table.td>
                            <x-table.td class="text-right font-semibold">
                                <span
                                    class="bg-primary/20 text-primary px-2 py-1 rounded text-xs">{{ number_format(isset($retention['day_0']) ? $retention['day_0'] : 0, 1) }}%</span>
                            </x-table.td>
                            <x-table.td class="text-right">
                                <span
                                    class="px-2 py-1">{{ number_format(isset($retention['day_7']) ? $retention['day_7'] : 0, 1) }}%</span>
                            </x-table.td>
                            <x-table.td class="text-right">
                                <span
                                    class="px-2 py-1">{{ number_format(isset($retention['day_14']) ? $retention['day_14'] : 0, 1) }}%</span>
                            </x-table.td>
                            <x-table.td class="text-right font-semibold">
                                <span
                                    class="px-2 py-1">{{ number_format(isset($retention['day_30']) ? $retention['day_30'] : 0, 1) }}%</span>
                            </x-table.td>
                        </x-table.tr>
                    @empty
                        <x-table.tr>
                            <x-table.td colspan="5"
                                class="text-center text-text-light-secondary dark:text-text-dark-secondary">No cohort
                                retention data available yet</x-table.td>
                        </x-table.tr>
                    @endforelse
                </x-table.tbody>
            </x-table.index>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        const labels = @json($labels ?? []);
        const signupsData = @json($signupsData ?? []);
        const revenueData = @json($revenueData ?? []);
        const activeUsersData = @json($activeUsersData ?? []);
        const deviceBreakdown = @json($deviceBreakdown ?? []);
        const dau = @json($dau ?? 0);
        const totalUsers = @json($totalUsers ?? 0);

        const primaryColor = '#7f13ec';
        const secondaryColor = '#06b6d4';

        // Signups Chart
        (function() {
            const ctx = document.getElementById('signupsChart');
            if (!ctx) return;
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Signups',
                        data: signupsData,
                        borderColor: primaryColor,
                        backgroundColor: 'rgba(127,19,236,0.08)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointBackgroundColor: primaryColor,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        x: {
                            display: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })();

        // Revenue Chart
        (function() {
            const ctx = document.getElementById('revenueChart');
            if (!ctx) return;
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Revenue',
                        data: revenueData,
                        backgroundColor: primaryColor,
                        borderColor: primaryColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })();

        // Active Users Pie
        (function() {
            const ctx = document.getElementById('activePie');
            if (!ctx) return;
            const inactive = Math.max(0, (totalUsers || 0) - (dau || 0));
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Active', 'Inactive'],
                    datasets: [{
                        data: [dau || 0, inactive],
                        backgroundColor: [primaryColor, '#e6e6e6'],
                        borderColor: ['transparent', 'transparent']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            display: false
                        }
                    }
                }
            });
        })();

        // Device Breakdown Chart
        (function() {
            const ctx = document.getElementById('deviceChart');
            if (!ctx) return;
            const devices = deviceBreakdown || {};
            const labels = Object.keys(devices);
            const data = Object.values(devices);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels.map(d => d.charAt(0).toUpperCase() + d.slice(1)),
                    datasets: [{
                        label: 'Active Users',
                        data: data,
                        backgroundColor: [primaryColor, secondaryColor, '#48BB78'],
                        borderColor: [primaryColor, secondaryColor, '#48BB78'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })();
    </script>
</x-layouts.app>
