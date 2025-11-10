<x-layouts.app>
    <div class="mx-auto max-w-7xl">
        <!-- Page Heading & Filters -->
        <div class="flex flex-wrap justify-between items-start gap-4 mb-8">
            <div class="flex flex-col gap-2">
                <p
                    class="text-text-light-primary dark:text-text-dark-primary text-3xl lg:text-4xl font-black tracking-tighter">
                    Growth Analytics</p>
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-base font-normal leading-normal">
                    Insights into platform performance and user growth</p>
            </div>
            <div class="flex gap-2 flex-wrap">
                <form method="get" class="flex items-center gap-2">
                    <label for="period" class="sr-only">Period</label>
                    <select id="period" name="period" onchange="this.form.submit()" class="h-10 rounded-lg bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark px-3 text-text-light-secondary dark:text-text-dark-secondary">
                        <option value="daily" {{ (request('period')=='daily') ? 'selected' : '' }}>Daily</option>
                        <option value="weekly" {{ (request('period')=='weekly') ? 'selected' : '' }}>Weekly</option>
                        <option value="monthly" {{ (request('period')=='monthly' || !request('period')) ? 'selected' : '' }}>Monthly</option>
                        <option value="quarterly" {{ (request('period')=='quarterly') ? 'selected' : '' }}>Quarterly</option>
                        <option value="biannual" {{ (request('period')=='biannual') ? 'selected' : '' }}>Biannual</option>
                        <option value="annually" {{ (request('period')=='annually') ? 'selected' : '' }}>Annually</option>
                    </select>
                </form>
            </div>
        </div>
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 mb-8">
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    Total Users</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">{{ number_format($totalUsers ?? 0) }}
                </p>
                <p class="text-text-light-secondary text-sm font-medium leading-normal">New: {{ number_format($newUsers ?? 0) }}</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    Active Portfolios</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">{{ number_format($activePortfolios ?? 0) }}
                </p>
                <p class="text-text-light-secondary text-sm font-medium leading-normal">Active subscriptions</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    Total Profit</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">${{ number_format($totalProfit ?? 0, 2) }}
                </p>
                <p class="text-text-light-secondary text-sm font-medium leading-normal">Period: {{ ucfirst($period ?? 'monthly') }}</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    LTV</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">${{ number_format($ltv ?? 0, 2) }}
                </p>
                <p class="text-positive text-sm font-medium leading-normal flex items-center"><span
                        class="material-symbols-outlined text-base">arrow_upward</span>{{ number_format($ltvChange ?? 0, 1) }}%</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    Churn Rate</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">{{ number_format($churnRate ?? 0, 1) }}%
                </p>
                <p class="text-negative text-sm font-medium leading-normal flex items-center"><span
                        class="material-symbols-outlined text-base">arrow_downward</span>{{ number_format($churnChange ?? 0, 1) }}%</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    Conversion</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">{{ number_format($conversionRate ?? 0, 1) }}%
                </p>
                <p class="text-positive text-sm font-medium leading-normal flex items-center"><span
                        class="material-symbols-outlined text-base">arrow_upward</span>{{ number_format($conversionChange ?? 0, 1) }}%</p>
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
                    <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-normal">Last 30 Days
                    </p>
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
                    <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-normal">Last 6 Months
                    </p>
                </div>
                <div class="grid min-h-[250px] grid-flow-col gap-4 grid-rows-[1fr_auto] items-end justify-items-center pt-8">
                    <canvas id="revenueChart" class="w-full" style="height:260px"></canvas>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-5 gap-6 mb-8">
            <!-- Active vs Inactive Users -->
            <div
                class="xl:col-span-2 flex flex-col gap-4 rounded-lg border border-border-light dark:border-border-dark p-6 bg-card-light dark:bg-card-dark">
                <p class="text-text-light-primary dark:text-text-dark-primary text-base font-medium leading-normal">
                    Active vs Inactive Users</p>
                <div class="flex-1 flex items-center justify-center py-4">
                    <div class="w-48 h-48">
                        <canvas id="activePie" class="w-full h-full"></canvas>
                    </div>
                </div>
                <div class="flex justify-center gap-6 text-sm">
                    <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-primary"></span>
                        <p class="text-text-light-secondary dark:text-text-dark-secondary">Active</p>
                    </div>
                    <div class="flex items-center gap-2"><span
                            class="w-3 h-3 rounded-full bg-border-light dark:bg-border-dark"></span>
                        <p class="text-text-light-secondary dark:text-text-dark-secondary">Inactive</p>
                    </div>
                </div>
            </div>
            <!-- Top 5 Countries -->
            <div
                class="xl:col-span-3 flex flex-col gap-4 rounded-lg border border-border-light dark:border-border-dark p-6 bg-card-light dark:bg-card-dark">
                <p class="text-text-light-primary dark:text-text-dark-primary text-base font-medium leading-normal">Top
                    5 Countries by Users</p>
                <div class="flex-1 flex items-center justify-center">
                    <img class="w-full h-auto object-contain max-h-[300px]"
                        data-alt="World map highlighting top user countries in shades of purple."
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCvgycUo8LxxbBRXGOM_mSGZ6RTeJCRon9M13xODljSH7ZT1ubrStFWjZCaQSugJiqiXZ0bzQAFftabRTn3Q_jph8J4G633qvXaibKhFLnUa6RlBYbv34_4bvegl6lZ0dCUJuuSSdujzGVFQ6JkHXuOP7-gxS-98YnY9O8YrMR1mdLnd1ALyAi_K_ybaQd9_thJlGVKVind2BO65Y0MpeMAUz3okSZ-vCpWFL9Z3aK6oyTAoywT5mvnpQaAU-fZrHI4fHx0jITONl8" />
                </div>
            </div>
        </div>
        <!-- Engagement & Affiliate Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Engagement Metrics -->
            <div class="lg:col-span-1 grid grid-cols-1 gap-6 content-start">
                <div
                    class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                    <p
                        class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                        Avg. Portfolio Views / User</p>
            <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">
                {{ number_format($avgViewsPerUser ?? 0, 1) }}</p>
                </div>
                <div
                    class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                    <p
                        class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                        Avg. Messages Received / Portfolio</p>
            <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">
                {{ number_format($avgMessagesPerPortfolio ?? 0, 1) }}</p>
                </div>
                <div
                    class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                    <p
                        class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                        Active Portfolios This Month</p>
                    <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">
                        {{ number_format($activePortfoliosThisMonth ?? 0) }}</p>
                </div>
            </div>
            <!-- Affiliate Conversions -->
            <div
                class="lg:col-span-2 flex flex-col gap-2 rounded-lg border border-border-light dark:border-border-dark p-6 bg-card-light dark:bg-card-dark">
                <p class="text-text-light-primary dark:text-text-dark-primary text-base font-medium leading-normal">
                    Affiliate Conversions &amp; Payouts</p>
                <div class="flex items-center gap-1">
                    <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-normal">Last 30 Days
                    </p>
                </div>
                <div class="flex min-h-[300px] flex-1 flex-col gap-8 py-4">
                    <canvas id="affiliateChart" class="w-full" style="height:320px"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        const labels = @json($labels ?? []);
        const signupsData = @json($signupsData ?? []);
        const revenueData = @json($revenueData ?? []);
        const affiliateData = @json($affiliateData ?? []);
        const totalPortfolios = @json($totalPortfolios ?? 0);
        const activePortfolios = @json($activePortfolios ?? 0);

        // Signups chart
        (function(){
            const ctx = document.getElementById('signupsChart');
            if (!ctx) return;
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Signups',
                            data: signupsData,
                            borderColor: '#7f13ec',
                            backgroundColor: 'rgba(127,19,236,0.08)',
                            tension: 0.3,
                            fill: true,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { display: true },
                        y: { beginAtZero: true }
                    }
                }
            });
        })();

        // Revenue chart
        (function(){
            const ctx = document.getElementById('revenueChart');
            if (!ctx) return;
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Revenue',
                        data: revenueData,
                        backgroundColor: 'rgba(127,19,236,0.8)'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });
        })();

        // Affiliate conversions chart
        (function(){
            const ctx = document.getElementById('affiliateChart');
            if (!ctx) return;
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Affiliate Conversions',
                        data: affiliateData,
                        borderColor: '#06b6d4',
                        backgroundColor: 'rgba(6,182,212,0.08)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
            });
        })();

        // Active vs inactive pie
        (function(){
            const ctx = document.getElementById('activePie');
            if (!ctx) return;
            const inactive = Math.max(0, (totalPortfolios || 0) - (activePortfolios || 0));
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Active', 'Inactive'],
                    datasets: [{
                        data: [activePortfolios || 0, inactive],
                        backgroundColor: ['#7f13ec', '#e6e6e6']
                    }]
                },
                options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
            });
        })();
    </script>
</x-layouts.app>
