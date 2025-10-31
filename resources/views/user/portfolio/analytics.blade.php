@push('scripts')
    <script>
        const trafficCtx = document.getElementById('trafficSourcesChart').getContext('2d');

        const trafficData = @json($stats['traffic_sources']);
        const labels = trafficData.map(source => source.source.charAt(0).toUpperCase() + source.source.slice(1));
        const values = trafficData.map(source => source.total);
        const backgroundColors = trafficData.map(source => source.color);

        new Chart(trafficCtx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: backgroundColors,
                    borderWidth: 0,
                    hoverOffset: 4,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                cutout: '75%',
                layout: {
                    padding: 20
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: '#1e1e1e',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const value = context.raw;
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${context.label}: ${value.toLocaleString()} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        const ctx = document.getElementById('engagementChart').getContext('2d');

        const engagementData = @json($stats['daily_engagement']);
        const dates = engagementData.map(item => item.date);
        const visits = engagementData.map(item => item.visits);
        const clicks = engagementData.map(item => item.clicks || 0);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                        label: 'Visits',
                        data: visits,
                        borderColor: '#603594',
                        backgroundColor: 'rgba(96, 53, 148, 0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Clicks',
                        data: clicks,
                        borderColor: '#BFAED4',
                        backgroundColor: 'rgba(191, 174, 212, 0.05)',
                        fill: true,
                        tension: 0.4,
                        borderDash: [5, 5]
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
@endpush

<x-layouts.app>

    <div class="w-full max-w-7xl mx-auto">
        <!-- PageHeading & Chips -->
        <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div class="flex flex-col gap-2">
                <h1 class="text-text-light dark:text-text-dark text-3xl font-black leading-tight tracking-tight">
                    Analytics</h1>
                <p class="text-subtle-light dark:text-subtle-dark text-base font-normal leading-normal">Detailed insights
                    into your portfolio performance.</p>
            </div>
            <div class="flex gap-2 flex-wrap">
                <button
                    class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-primary/10 dark:bg-primary/20 px-4">
                    <p class="text-primary text-sm font-medium leading-normal">Last 30 Days</p>
                    <span class="material-symbols-outlined text-primary text-base">expand_more</span>
                </button>
                <button
                    class="flex min-w-[84px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-10 px-4 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark text-text-light dark:text-text-dark text-sm font-bold leading-normal tracking-[0.015em] hover:bg-background-light dark:hover:bg-background-dark">
                    <span class="material-symbols-outlined text-base">download</span>
                    <span class="truncate">Export</span>
                </button>
            </div>
        </header>
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <div
                class="flex flex-col gap-2 rounded-xl p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-subtle-light dark:text-subtle-dark text-base font-medium leading-normal">Total Visits</p>
                <p class="text-text-light dark:text-text-dark tracking-tight text-3xl font-bold leading-tight">
                    {{ number_format($stats['total_visits']) }}</p>
                <div
                    class="flex items-center gap-1 {{ $stats['visits_growth_rate'] >= 0 ? 'text-[#078847]' : 'text-[#e74808]' }}">
                    <span
                        class="material-symbols-outlined text-base">{{ $stats['visits_growth_rate'] >= 0 ? 'trending_up' : 'trending_down' }}</span>
                    <p class="text-sm font-medium leading-normal">
                        {{ $stats['visits_growth_rate'] >= 0 ? '+' : '' }}{{ number_format($stats['visits_growth_rate'], 1) }}%
                    </p>
                </div>
            </div>
            <div
                class="flex flex-col gap-2 rounded-xl p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-subtle-light dark:text-subtle-dark text-base font-medium leading-normal">Total Clicks</p>
                <p class="text-text-light dark:text-text-dark tracking-tight text-3xl font-bold leading-tight">
                    {{ number_format($stats['total_clicks']) }}</p>
                <div
                    class="flex items-center gap-1 {{ $stats['clicks_growth_rate'] >= 0 ? 'text-[#078847]' : 'text-[#e74808]' }}">
                    <span
                        class="material-symbols-outlined text-base">{{ $stats['clicks_growth_rate'] >= 0 ? 'trending_up' : 'trending_down' }}</span>
                    <p class="text-sm font-medium leading-normal">
                        {{ $stats['clicks_growth_rate'] >= 0 ? '+' : '' }}{{ number_format($stats['clicks_growth_rate'], 1) }}%
                    </p>
                </div>
            </div>
            <div
                class="flex flex-col gap-2 rounded-xl p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-subtle-light dark:text-subtle-dark text-base font-medium leading-normal">Total Messages
                </p>
                <p class="text-text-light dark:text-text-dark tracking-tight text-3xl font-bold leading-tight">
                    {{ number_format($stats['total_messages']) }}</p>
                <div
                    class="flex items-center gap-1 {{ $stats['messages_growth_rate'] >= 0 ? 'text-[#078847]' : 'text-[#e74808]' }}">
                    <span
                        class="material-symbols-outlined text-base">{{ $stats['messages_growth_rate'] >= 0 ? 'trending_up' : 'trending_down' }}</span>
                    <p class="text-sm font-medium leading-normal">
                        {{ $stats['messages_growth_rate'] >= 0 ? '+' : '' }}{{ number_format($stats['messages_growth_rate'], 1) }}%
                    </p>
                </div>
            </div>
        </div>
        <!-- Main Chart & Data Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Engagement Over Time Chart -->
            <div
                class="lg:col-span-3 flex flex-col gap-4 rounded-xl border border-border-light dark:border-border-dark p-6 bg-card-light dark:bg-card-dark">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <p class="text-text-light dark:text-text-dark text-base font-medium leading-normal">30 Day
                            Engagement</p>
                        <div class="flex items-baseline gap-2">
                            <p
                                class="text-text-light dark:text-text-dark tracking-tight text-3xl font-bold leading-tight truncate">
                                {{ number_format($stats['total_engagement']) }}
                            </p>
                            <p
                                class="{{ $stats['engagement_growth_rate'] >= 0 ? 'text-[#078847]' : 'text-[#e74808]' }} text-sm font-medium leading-normal">
                                {{ $stats['engagement_growth_rate'] >= 0 ? '+' : '' }}{{ number_format($stats['engagement_growth_rate'], 1) }}%
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 text-sm">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-primary"></div>
                            <span>Visits</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-primary/40"></div>
                            <span>Clicks</span>
                        </div>
                    </div>
                </div>
                <div class="flex min-h-[250px] flex-1 flex-col justify-end">
                    <canvas id="engagementChart"></canvas>
                </div>
            </div>
            <!-- Top Traffic Sources -->
            <div
                class="lg:col-span-1 flex flex-col gap-4 rounded-xl border border-border-light dark:border-border-dark p-6 bg-card-light dark:bg-card-dark">
                <h3 class="text-text-light dark:text-text-dark text-base font-medium leading-normal">Top Traffic Sources
                </h3>
                <div class="flex items-center justify-center min-h-[160px]">
                    <div class="relative w-40 h-40">
                        <canvas id="trafficSourcesChart"></canvas>
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            <span
                                class="text-2xl font-bold text-text-light dark:text-text-dark">{{ number_format($stats['total_visits']) }}</span>
                            <span class="text-sm text-subtle-light dark:text-subtle-dark">Total</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3 text-sm">
                    @foreach ($stats['traffic_sources'] as $source)
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <div class="w-2.5 h-2.5 rounded-full"
                                    style="background-color: {{ $source['color'] }};"></div>
                                {{ ucfirst($source['source']) }}
                            </div>
                            <span
                                class="font-medium">{{ number_format(($source['total'] / $stats['total_visits']) * 100, 1) }}%</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Top Pages Table -->
            <div
                class="lg:col-span-2 flex flex-col gap-4 rounded-xl border border-border-light dark:border-border-dark p-6 bg-card-light dark:bg-card-dark">
                <h3 class="text-text-light dark:text-text-dark text-base font-medium leading-normal">Top Performing
                    Pages</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr
                                class="border-b border-border-light dark:border-border-dark text-subtle-light dark:text-subtle-dark">
                                <th class="py-2 font-medium">Page/Project</th>
                                <th class="py-2 font-medium text-right">Views</th>
                                <th class="py-2 font-medium text-right">CTR</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stats['top_pages'] as $page)
                                <tr class="border-b border-border-light dark:border-border-dark">
                                    <td class="py-3">{{ $page->page_url }}</td>
                                    <td class="py-3 text-right">{{ number_format($page->views) }}</td>
                                    <td class="py-3 text-right">
                                        {{ number_format(($page->views / $stats['total_visits']) * 100, 1) }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
