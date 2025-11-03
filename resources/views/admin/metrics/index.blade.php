<x-layouts.app>
    <div class="mx-auto max-w-7xl">
        <!-- Page Heading & Filters -->
        <div class="flex flex-wrap justify-between items-start gap-4 mb-8">
            <div class="flex flex-col gap-2">
                <p
                    class="text-text-light-primary dark:text-text-dark-primary text-3xl lg:text-4xl font-black tracking-tighter">
                    Growth Analytics</p>
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-base font-normal leading-normal">
                    Insights into platform performance and user growth.</p>
            </div>
            <div class="flex gap-2 flex-wrap">
                <button
                    class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark px-4 text-text-light-secondary dark:text-text-dark-secondary hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <p class="text-sm font-medium">Last 30 Days</p>
                    <span class="material-symbols-outlined text-xl">expand_more</span>
                </button>
            </div>
        </div>
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-8">
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    MRR</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">$12,450
                </p>
                <p class="text-positive text-sm font-medium leading-normal flex items-center"><span
                        class="material-symbols-outlined text-base">arrow_upward</span>5.2%</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    User Growth</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">15.2%
                </p>
                <p class="text-positive text-sm font-medium leading-normal flex items-center"><span
                        class="material-symbols-outlined text-base">arrow_upward</span>1.8%</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    ARPU</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">$25.50
                </p>
                <p class="text-positive text-sm font-medium leading-normal flex items-center"><span
                        class="material-symbols-outlined text-base">arrow_upward</span>0.5%</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    LTV</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">$310
                </p>
                <p class="text-positive text-sm font-medium leading-normal flex items-center"><span
                        class="material-symbols-outlined text-base">arrow_upward</span>3.1%</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    Churn Rate</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">2.1%
                </p>
                <p class="text-negative text-sm font-medium leading-normal flex items-center"><span
                        class="material-symbols-outlined text-base">arrow_downward</span>0.2%</p>
            </div>
            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                    Conversion</p>
                <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">4.8%
                </p>
                <p class="text-positive text-sm font-medium leading-normal flex items-center"><span
                        class="material-symbols-outlined text-base">arrow_upward</span>0.7%</p>
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
                    <svg class="h-full w-full" fill="none" preserveaspectratio="none" viewbox="0 0 478 150"
                        width="100%" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0 109C18.1538 109 18.1538 21 36.3077 21C54.4615 21 54.4615 41 72.6154 41C90.7692 41 90.7692 93 108.923 93C127.077 93 127.077 33 145.231 33C163.385 33 163.385 101 181.538 101C199.692 101 199.692 61 217.846 61C236 61 236 45 254.154 45C272.308 45 272.308 121 290.462 121C308.615 121 308.615 149 326.769 149C344.923 149 344.923 1 363.077 1C381.231 1 381.231 81 399.385 81C417.538 81 417.538 129 435.692 129C453.846 129 453.846 25 472 25V149H326.769H0V109Z"
                            fill="url(#line-chart-gradient)"></path>
                        <path
                            d="M0 109C18.1538 109 18.1538 21 36.3077 21C54.4615 21 54.4615 41 72.6154 41C90.7692 41 90.7692 93 108.923 93C127.077 93 127.077 33 145.231 33C163.385 33 163.385 101 181.538 101C199.692 101 199.692 61 217.846 61C236 61 236 45 254.154 45C272.308 45 272.308 121 290.462 121C308.615 121 308.615 149 326.769 149C344.923 149 344.923 1 363.077 1C381.231 1 381.231 81 399.385 81C417.538 81 417.538 129 435.692 129C453.846 129 453.846 25 472 25"
                            stroke="#7f13ec" stroke-linecap="round" stroke-width="3"></path>
                        <defs>
                            <lineargradient gradientunits="userSpaceOnUse" id="line-chart-gradient" x1="236"
                                x2="236" y1="1" y2="149">
                                <stop stop-color="#7f13ec" stop-opacity="0.2"></stop>
                                <stop offset="1" stop-color="#7f13ec" stop-opacity="0"></stop>
                            </lineargradient>
                        </defs>
                    </svg>
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
                <div
                    class="grid min-h-[250px] grid-flow-col gap-4 grid-rows-[1fr_auto] items-end justify-items-center pt-8">
                    <div class="bg-primary/20 w-full rounded-t" style="height: 50%;"></div>
                    <p class="text-text-light-secondary dark:text-text-dark-secondary text-xs font-bold leading-normal">
                        Jan</p>
                    <div class="bg-primary/20 w-full rounded-t" style="height: 20%;"></div>
                    <p class="text-text-light-secondary dark:text-text-dark-secondary text-xs font-bold leading-normal">
                        Feb</p>
                    <div class="bg-primary/20 w-full rounded-t" style="height: 80%;"></div>
                    <p class="text-text-light-secondary dark:text-text-dark-secondary text-xs font-bold leading-normal">
                        Mar</p>
                    <div class="bg-primary/20 w-full rounded-t" style="height: 20%;"></div>
                    <p class="text-text-light-secondary dark:text-text-dark-secondary text-xs font-bold leading-normal">
                        Apr</p>
                    <div class="bg-primary/20 w-full rounded-t" style="height: 30%;"></div>
                    <p class="text-text-light-secondary dark:text-text-dark-secondary text-xs font-bold leading-normal">
                        May</p>
                    <div class="bg-primary/20 w-full rounded-t" style="height: 60%;"></div>
                    <p class="text-text-light-secondary dark:text-text-dark-secondary text-xs font-bold leading-normal">
                        Jun</p>
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
                    <div class="relative w-48 h-48">
                        <svg class="w-full h-full" viewbox="0 0 36 36">
                            <path class="stroke-border-light dark:stroke-border-dark"
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none" stroke="#e6e6e6" stroke-width="3"></path>
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831" fill="none" stroke="#7f13ec"
                                stroke-dasharray="85, 100" stroke-linecap="round" stroke-width="3"></path>
                        </svg>
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-center">
                            <p class="text-3xl font-bold text-text-light-primary dark:text-text-dark-primary">85%</p>
                            <p class="text-sm text-text-light-secondary dark:text-text-dark-secondary">Active</p>
                        </div>
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
                        12.7</p>
                </div>
                <div
                    class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                    <p
                        class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                        Avg. Messages Received / Portfolio</p>
                    <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">
                        4.2</p>
                </div>
                <div
                    class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                    <p
                        class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">
                        Active Portfolios This Month</p>
                    <p class="text-text-light-primary dark:text-text-dark-primary tracking-tight text-3xl font-bold">
                        1,842</p>
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
                    <svg class="h-full w-full" fill="none" preserveaspectratio="none" viewbox="0 0 478 150"
                        width="100%" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0 130C18.1538 130 18.1538 80 36.3077 80C54.4615 80 54.4615 100 72.6154 100C90.7692 100 90.7692 40 108.923 40C127.077 40 127.077 90 145.231 90C163.385 90 163.385 20 181.538 20C199.692 20 199.692 60 217.846 60C236 60 236 10 254.154 10C272.308 10 272.308 110 290.462 110C308.615 110 308.615 130 326.769 130C344.923 130 344.923 50 363.077 50C381.231 50 381.231 90 399.385 90C417.538 90 417.538 40 435.692 40C453.846 40 453.846 120 472 120V149H0V130Z"
                            fill="url(#affiliate-chart-gradient)"></path>
                        <path
                            d="M0 130C18.1538 130 18.1538 80 36.3077 80C54.4615 80 54.4615 100 72.6154 100C90.7692 100 90.7692 40 108.923 40C127.077 40 127.077 90 145.231 90C163.385 90 163.385 20 181.538 20C199.692 20 199.692 60 217.846 60C236 60 236 10 254.154 10C272.308 10 272.308 110 290.462 110C308.615 110 308.615 130 326.769 130C344.923 130 344.923 50 363.077 50C381.231 50 381.231 90 399.385 90C417.538 90 417.538 40 435.692 40C453.846 40 453.846 120 472 120"
                            stroke="#7f13ec" stroke-linecap="round" stroke-width="3"></path>
                        <defs>
                            <lineargradient gradientunits="userSpaceOnUse" id="affiliate-chart-gradient"
                                x1="236" x2="236" y1="10" y2="149">
                                <stop stop-color="#7f13ec" stop-opacity="0.2"></stop>
                                <stop offset="1" stop-color="#7f13ec" stop-opacity="0"></stop>
                            </lineargradient>
                        </defs>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
