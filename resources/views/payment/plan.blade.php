<x-layouts.app>
    <div class="flex flex-col max-w-6xl w-full flex-1 items-center">
        <!-- PageHeading -->
        <div class="flex flex-col items-center justify-center gap-4 text-center mb-8 sm:mb-12">
            <p class="text-4xl md:text-5xl font-black tracking-tighter max-w-3xl">Choose the plan that's right for you
            </p>
            <p class="text-base md:text-lg font-normal text-text-muted-light dark:text-text-muted-dark max-w-xl">Select a
                plan to get started with your portfolio. Cancel anytime.</p>
        </div>
        <!-- SegmentedButtons -->
        <div class="flex flex-col items-center gap-2 mb-10 w-full max-w-md">
            <div
                class="flex w-full max-w-xs items-center justify-center rounded-full bg-primary/10 dark:bg-primary/20 p-1">
                <label
                    class="flex cursor-pointer h-full flex-1 items-center justify-center overflow-hidden rounded-full px-2 py-1.5 has-[:checked]:bg-white dark:has-[:checked]:bg-background-dark has-[:checked]:shadow-soft text-text-muted-light dark:text-text-muted-dark has-[:checked]:text-text-light dark:has-[:checked]:text-text-dark text-sm font-medium transition-all duration-300">
                    <span class="truncate">Billed Monthly</span>
                    <input checked="" class="invisible w-0" name="billing-cycle" type="radio" value="monthly" />
                </label>
                <label
                    class="flex cursor-pointer h-full flex-1 items-center justify-center overflow-hidden rounded-full px-2 py-1.5 has-[:checked]:bg-white dark:has-[:checked]:bg-background-dark has-[:checked]:shadow-soft text-text-muted-light dark:text-text-muted-dark has-[:checked]:text-text-light dark:has-[:checked]:text-text-dark text-sm font-medium transition-all duration-300">
                    <span class="truncate">Billed Yearly</span>
                    <input class="invisible w-0" name="billing-cycle" type="radio" value="yearly" />
                </label>
            </div>
            <!-- MetaText -->
            <p class="text-primary text-sm font-medium">Save 20% with yearly!</p>
        </div>
        <!-- PricingCards -->
        <div class="grid w-full grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <!-- Card 1: Free -->
            <div
                class="flex flex-1 flex-col gap-6 rounded-xl border border-solid border-border-light dark:border-border-dark bg-white dark:bg-background-dark/50 p-6 shadow-soft hover:shadow-soft-lg hover:-translate-y-1 transition-all duration-300">
                <div class="flex flex-col gap-2">
                    <h3 class="text-lg font-bold">Free</h3>
                    <p class="flex items-baseline gap-1">
                        <span class="text-4xl font-black tracking-tight">$0</span>
                        <span class="text-base font-bold text-text-muted-light dark:text-text-muted-dark">/ month</span>
                    </p>
                    <p class="text-sm text-text-muted-light dark:text-text-muted-dark">For individuals starting out with
                        their first portfolio.</p>
                </div>
                <button
                    class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/10 dark:bg-primary/20 text-primary text-sm font-bold hover:bg-primary/20 dark:hover:bg-primary/30 transition-colors">
                    <span class="truncate">Get Started</span>
                </button>
                <div class="flex flex-col gap-3 pt-2 border-t border-border-light dark:border-border-dark">
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-primary text-base">check_circle</span> 1 Active
                        Project
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-primary text-base">check_circle</span> Basic
                        Templates
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-primary text-base">check_circle</span> Community
                        Support
                    </div>
                </div>
            </div>
            <!-- Card 2: Pro (Most Popular) -->
            <div
                class="relative flex flex-1 flex-col gap-6 rounded-xl border border-solid border-primary bg-white dark:bg-background-dark/50 p-6 shadow-soft-lg ring-2 ring-primary/50 -translate-y-2">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2">
                    <p
                        class="text-white text-xs font-bold tracking-wide rounded-full bg-gradient-to-r from-primary-gradient-start to-primary-gradient-end px-4 py-1.5 text-center">
                        Most Popular</p>
                </div>
                <div class="flex flex-col gap-2 pt-4">
                    <h3 class="text-lg font-bold">Pro</h3>
                    <p class="flex items-baseline gap-1">
                        <span class="text-4xl font-black tracking-tight">$12</span>
                        <span class="text-base font-bold text-text-muted-light dark:text-text-muted-dark">/ month</span>
                    </p>
                    <p class="text-sm text-text-muted-light dark:text-text-muted-dark">For professionals looking to
                        showcase their work.</p>
                </div>
                <button
                    class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-gradient-to-r from-primary-gradient-start to-primary-gradient-end text-white text-sm font-bold hover:opacity-90 transition-opacity shadow-lg shadow-primary/30">
                    <span class="truncate">Select Plan</span>
                </button>
                <div class="flex flex-col gap-3 pt-2 border-t border-border-light dark:border-border-dark">
                    <div class="flex items-center gap-3 text-sm font-medium">
                        <span class="material-symbols-outlined text-primary text-base">check_circle</span> Unlimited
                        Projects
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-primary text-base">check_circle</span> Custom Domain
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-primary text-base">check_circle</span> Advanced
                        Analytics
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-primary text-base">check_circle</span> Priority
                        Support
                    </div>
                </div>
            </div>
            <!-- Card 3: Business -->
            <div
                class="flex flex-1 flex-col gap-6 rounded-xl border border-solid border-border-light dark:border-border-dark bg-white dark:bg-background-dark/50 p-6 shadow-soft hover:shadow-soft-lg hover:-translate-y-1 transition-all duration-300">
                <div class="flex flex-col gap-2">
                    <h3 class="text-lg font-bold">Business</h3>
                    <p class="flex items-baseline gap-1">
                        <span class="text-4xl font-black tracking-tight">$25</span>
                        <span class="text-base font-bold text-text-muted-light dark:text-text-muted-dark">/ month</span>
                    </p>
                    <p class="text-sm text-text-muted-light dark:text-text-muted-dark">For freelancers and small teams
                        collaborating on projects.</p>
                </div>
                <button
                    class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/10 dark:bg-primary/20 text-primary text-sm font-bold hover:bg-primary/20 dark:hover:bg-primary/30 transition-colors">
                    <span class="truncate">Select Plan</span>
                </button>
                <div class="flex flex-col gap-3 pt-2 border-t border-border-light dark:border-border-dark">
                    <div class="flex items-center gap-3 text-sm font-medium">
                        <span class="material-symbols-outlined text-primary text-base">check_circle</span> Everything in
                        Pro
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-primary text-base">check_circle</span> Team
                        Collaboration
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-primary text-base">check_circle</span> Custom
                        Branding
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-primary text-base">check_circle</span> API Access
                    </div>
                </div>
            </div>
            <!-- Card 4: Enterprise -->
            <div
                class="flex flex-1 flex-col gap-6 rounded-xl border border-solid border-border-light dark:border-border-dark bg-white dark:bg-background-dark/50 p-6 shadow-soft hover:shadow-soft-lg hover:-translate-y-1 transition-all duration-300">
                <div class="flex flex-col gap-2">
                    <h3 class="text-lg font-bold">Enterprise</h3>
                    <p class="flex items-baseline gap-1">
                        <span class="text-4xl font-black tracking-tight">$40</span>
                        <span class="text-base font-bold text-text-muted-light dark:text-text-muted-dark">/ month</span>
                    </p>
                    <p class="text-sm text-text-muted-light dark:text-text-muted-dark">For large organizations with
                        advanced security needs.</p>
                </div>
                <button
                    class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/10 dark:bg-primary/20 text-primary text-sm font-bold hover:bg-primary/20 dark:hover:bg-primary/30 transition-colors">
                    <span class="truncate">Contact Sales</span>
                </button>
                <div class="flex flex-col gap-3 pt-2 border-t border-border-light dark:border-border-dark">
                    <div class="flex items-center gap-3 text-sm font-medium">
                        <span class="material-symbols-outlined text-primary text-base">check_circle</span> Everything in
                        Business
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-primary text-base">check_circle</span> Dedicated
                        Account Manager
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-primary text-base">check_circle</span> Enterprise
                        SSO
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-primary text-base">check_circle</span> Advanced
                        Security
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
