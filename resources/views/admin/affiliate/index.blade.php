<x-layouts.app>
    <div class="w-full max-w-7xl mx-auto">
        <!-- PageHeading -->
        <div class="flex flex-wrap justify-between gap-4 items-center mb-6">
            <h1 class="text-3xl font-bold leading-tight tracking-tight text-text-light dark:text-text-dark">Manage
                Affiliates</h1>
            <button
                class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/50">
                <span class="material-symbols-outlined text-base">add</span>
                <span>Add Affiliate</span>
            </button>
        </div>
        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <div
                class="flex flex-1 flex-col gap-2 rounded-xl p-6 border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark">
                <p class="text-base font-medium leading-normal text-text-secondary-light dark:text-text-secondary-dark">
                    Total Affiliates</p>
                <p class="tracking-tight text-3xl font-bold leading-tight text-text-light dark:text-text-dark">1,204</p>
            </div>
            <div
                class="flex flex-1 flex-col gap-2 rounded-xl p-6 border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark">
                <p class="text-base font-medium leading-normal text-text-secondary-light dark:text-text-secondary-dark">
                    Pending Withdrawals</p>
                <p class="tracking-tight text-3xl font-bold leading-tight text-text-light dark:text-text-dark">
                    $15,830.50</p>
            </div>
            <div
                class="flex flex-1 flex-col gap-2 rounded-xl p-6 border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark">
                <p class="text-base font-medium leading-normal text-text-secondary-light dark:text-text-secondary-dark">
                    Commissions Paid</p>
                <p class="tracking-tight text-3xl font-bold leading-tight text-text-light dark:text-text-dark">
                    $124,721.00</p>
            </div>
        </div>
        <!-- ToolBar -->
        <div class="flex flex-col md:flex-row justify-between gap-4 py-3 items-center mb-4">
            <div class="relative w-full md:max-w-xs">
                <span
                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary-light dark:text-text-secondary-dark">search</span>
                <input
                    class="w-full rounded-md border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark pl-10 pr-4 py-2 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary"
                    placeholder="Search by name or email..." type="text" />
            </div>
            <div class="flex gap-4">
                <select
                    class="rounded-md border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark px-3 py-2 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary">
                    <option>All</option>
                    <option>Active</option>
                    <option>Pending Withdrawal</option>
                </select>
            </div>
        </div>
        <!-- Table -->
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div
                    class="overflow-hidden rounded-lg border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark">
                    <table class="min-w-full divide-y divide-border-light dark:divide-border-dark">
                        <thead class="bg-background-light dark:bg-background-dark">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-text-secondary-light dark:text-text-secondary-dark"
                                    scope="col">Affiliate Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-text-secondary-light dark:text-text-secondary-dark"
                                    scope="col">Total Referrals</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-text-secondary-light dark:text-text-secondary-dark"
                                    scope="col">Total Earnings</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-text-secondary-light dark:text-text-secondary-dark"
                                    scope="col">Commission %</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-text-secondary-light dark:text-text-secondary-dark"
                                    scope="col">Balance</th>
                                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-text-secondary-light dark:text-text-secondary-dark"
                                    scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-light dark:divide-border-dark">
                            <tr class="relative hover:bg-background-light dark:hover:bg-background-dark">
                                <td class="w-px h-full absolute left-0 bg-warning"
                                    data-alt="indicator for pending withdrawal"></td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm font-medium text-text-light dark:text-text-dark">
                                    John Doe</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    152</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    $1,520.00</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    10%</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    $350.00</td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="p-2 rounded-md text-success hover:bg-success/10"><span
                                                class="material-symbols-outlined text-xl">check_circle</span></button>
                                        <button class="p-2 rounded-md text-danger hover:bg-danger/10"><span
                                                class="material-symbols-outlined text-xl">cancel</span></button>
                                        <button
                                            class="p-2 rounded-md text-text-secondary-light dark:text-text-secondary-dark hover:bg-primary/10 hover:text-primary"><span
                                                class="material-symbols-outlined text-xl">edit</span></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-background-light dark:hover:bg-background-dark">
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm font-medium text-text-light dark:text-text-dark">
                                    Jane Smith</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    128</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    $1,280.00</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    10%</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    $120.00</td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <button
                                            class="p-2 rounded-md text-text-secondary-light dark:text-text-secondary-dark hover:bg-primary/10 hover:text-primary"><span
                                                class="material-symbols-outlined text-xl">edit</span></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="relative hover:bg-background-light dark:hover:bg-background-dark">
                                <td class="w-px h-full absolute left-0 bg-warning"
                                    data-alt="indicator for pending withdrawal"></td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm font-medium text-text-light dark:text-text-dark">
                                    Mike Johnson</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    98</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    $1,470.00</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    15%</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    $450.00</td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="p-2 rounded-md text-success hover:bg-success/10"><span
                                                class="material-symbols-outlined text-xl">check_circle</span></button>
                                        <button class="p-2 rounded-md text-danger hover:bg-danger/10"><span
                                                class="material-symbols-outlined text-xl">cancel</span></button>
                                        <button
                                            class="p-2 rounded-md text-text-secondary-light dark:text-text-secondary-dark hover:bg-primary/10 hover:text-primary"><span
                                                class="material-symbols-outlined text-xl">edit</span></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-background-light dark:hover:bg-background-dark">
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm font-medium text-text-light dark:text-text-dark">
                                    Emily White</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    85</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    $850.00</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    10%</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    $50.00</td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <button
                                            class="p-2 rounded-md text-text-secondary-light dark:text-text-secondary-dark hover:bg-primary/10 hover:text-primary"><span
                                                class="material-symbols-outlined text-xl">edit</span></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-background-light dark:hover:bg-background-dark">
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm font-medium text-text-light dark:text-text-dark">
                                    Chris Green</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    76</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    $1,140.00</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    15%</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                    $210.00</td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <button
                                            class="p-2 rounded-md text-text-secondary-light dark:text-text-secondary-dark hover:bg-primary/10 hover:text-primary"><span
                                                class="material-symbols-outlined text-xl">edit</span></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Pagination -->
        <div class="flex items-center justify-between py-4">
            <span class="text-sm text-text-secondary-light dark:text-text-secondary-dark">Showing 1 to 5 of 1,204
                results</span>
            <div class="inline-flex items-center -space-x-px">
                <button
                    class="px-3 py-1.5 rounded-l-md border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark text-sm hover:bg-background-light dark:hover:bg-background-dark disabled:opacity-50"
                    disabled="">Previous</button>
                <button
                    class="px-3 py-1.5 border-y border-border-light dark:border-border-dark bg-primary/10 text-primary text-sm">1</button>
                <button
                    class="px-3 py-1.5 border-y border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark text-sm hover:bg-background-light dark:hover:bg-background-dark">2</button>
                <button
                    class="px-3 py-1.5 border-y border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark text-sm hover:bg-background-light dark:hover:bg-background-dark">3</button>
                <span
                    class="px-3 py-1.5 border-y border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark text-sm">...</span>
                <button
                    class="px-3 py-1.5 border-y border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark text-sm hover:bg-background-light dark:hover:bg-background-dark">241</button>
                <button
                    class="px-3 py-1.5 rounded-r-md border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark text-sm hover:bg-background-light dark:hover:bg-background-dark">Next</button>
            </div>
        </div>
    </div>
</x-layouts.app>
