<x-layouts.app>

    <div class="w-full max-w-7xl mx-auto">
        <!-- PageHeading -->
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
            <h1 class="text-neutral-text dark:text-white text-3xl font-bold leading-tight">Manage Subscriptions</h1>
            <button
                class="flex items-center justify-center gap-2 rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-wide shadow-sm hover:bg-primary/90 transition-colors">
                <span class="material-symbols-outlined">add</span>
                <span class="truncate">Add New Subscription</span>
            </button>
        </div>
        <div
            class="bg-white dark:bg-black/20 rounded-xl border border-neutral-border dark:border-gray-800 shadow-sm p-4">
            <!-- SearchBar and Chips -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-4">
                <div class="flex-grow">
                    <label class="flex flex-col min-w-40 h-11 w-full">
                        <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                            <div
                                class="text-gray-500 flex border border-neutral-border dark:border-gray-700 bg-white dark:bg-gray-800 items-center justify-center pl-3 rounded-l-lg border-r-0">
                                <span class="material-symbols-outlined">search</span>
                            </div>
                            <input
                                class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-r-lg text-neutral-text dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-neutral-border dark:border-gray-700 bg-white dark:bg-gray-800 h-full placeholder:text-gray-400 px-3 border-l-0 text-sm"
                                placeholder="Search by user name or email..." value="" />
                        </div>
                    </label>
                </div>
                <div class="flex gap-2 overflow-x-auto pb-2">
                    <button
                        class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-gray-100 dark:bg-gray-800 px-3 border border-neutral-border dark:border-gray-700">
                        <span class="material-symbols-outlined text-base">filter_list</span>
                        <p class="text-neutral-text dark:text-gray-300 text-sm font-medium leading-normal">Plan: All</p>
                        <span class="material-symbols-outlined text-base">expand_more</span>
                    </button>
                    <button
                        class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-gray-100 dark:bg-gray-800 px-3 border border-neutral-border dark:border-gray-700">
                        <span class="material-symbols-outlined text-base">filter_list</span>
                        <p class="text-neutral-text dark:text-gray-300 text-sm font-medium leading-normal">Status: All
                        </p>
                        <span class="material-symbols-outlined text-base">expand_more</span>
                    </button>
                    <button
                        class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-gray-100 dark:bg-gray-800 px-3 border border-neutral-border dark:border-gray-700">
                        <span class="material-symbols-outlined text-base">calendar_today</span>
                        <p class="text-neutral-text dark:text-gray-300 text-sm font-medium leading-normal">Date Range
                        </p>
                        <span class="material-symbols-outlined text-base">expand_more</span>
                    </button>
                </div>
            </div>
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead
                        class="text-xs text-neutral-text dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-800/50">
                        <tr>
                            <th class="p-4" scope="col"><input
                                    class="form-checkbox rounded border-gray-300 text-primary focus:ring-primary"
                                    type="checkbox" /></th>
                            <th class="px-6 py-3" scope="col">User</th>
                            <th class="px-6 py-3" scope="col">Plan</th>
                             <th class="px-6 py-3" scope="col">Title</th>
                             <th class="px-6 py-3" scope="col">slug</th>
                            <th class="px-6 py-3" scope="col">Payment Method</th>
                            <th class="px-6 py-3" scope="col">Start Date</th>
                            <th class="px-6 py-3" scope="col">Renewal Date</th>
                            <th class="px-6 py-3" scope="col">Status</th>
                            <th class="px-6 py-3 text-center" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="bg-white dark:bg-black/10 border-b dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="w-4 p-4"><input
                                    class="form-checkbox rounded border-gray-300 text-primary focus:ring-primary"
                                    type="checkbox" /></td>
                            <td class="px-6 py-4 font-medium text-neutral-text dark:text-white whitespace-nowrap">Olivia
                                Martin<div class="text-xs text-gray-400">olivia.m@email.com</div>
                            </td>
                            <td class="px-6 py-4">Pro</td>
                            <td class="px-6 py-4 flex items-center gap-2"><img alt="Visa card icon" class="h-4"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBYV69fFz4eBOz8SfTFDIJTLusEkLkl5m1VvpTUdFt3A25YsVKLOdC2-kERex6WKQD-n8WZfbRfensIuMy0HKrXjpu1OH00WZnVIEf2IwKS4JtSqKTiNo_7TKiKlPWVe1P40JZcNZfiFfu8b4uL1eIPqz-FMsmURFAuMkbAN53hrvKraAIG8ntmFR3qonm5cDLtPdi31EBNmOLSi5gIKFal_sfB6mX9fGPZHUAfGMAfc_CRVvOwYTCgrhBwYW-5ayvak2aX5m7Tmzc" />Visa
                                **** 4242</td>
                            <td class="px-6 py-4">Jan 15, 2024</td>
                            <td class="px-6 py-4">Jan 15, 2025</td>
                            <td class="px-6 py-4"><span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success/20 text-green-800 dark:bg-success/30 dark:text-success">Active</span>
                            </td>
                            <td class="px-6 py-4 text-center"><button
                                    class="text-gray-500 hover:text-primary dark:hover:text-primary"><span
                                        class="material-symbols-outlined">more_horiz</span></button></td>
                        </tr>
                        <tr
                            class="bg-white dark:bg-black/10 border-b dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="w-4 p-4"><input
                                    class="form-checkbox rounded border-gray-300 text-primary focus:ring-primary"
                                    type="checkbox" /></td>
                            <td class="px-6 py-4 font-medium text-neutral-text dark:text-white whitespace-nowrap">Liam
                                Harris<div class="text-xs text-gray-400">liam.h@email.com</div>
                            </td>
                            <td class="px-6 py-4">Business</td>
                            <td class="px-6 py-4 flex items-center gap-2"><img alt="Mastercard icon" class="h-4"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCMw8W7KkOIZwXFyzweZX4XYLl9oEroUoW6HL_ievAyVXz4QytheJMvTjIjiIBA3mYirw7z3rmWfk9yChfs6pBLEM-Pv0WA5Y64zwEsCL_T6uje2sJVigeBHrmVq9WxEgXu5twpsL1O7ly8dpXOhDUFXI1jqIDlCIZ7O3DzMWdorZ8RfmosvtYJUScBm6nUxEY5uGWyCjLwpedVk1G2hip9oYwtzZt02QHRIcC7UQFpn8Yp6SfwvLuYsWe9T6mvKlD7kT6_Bl761aI" />Mastercard
                                **** 5588</td>
                            <td class="px-6 py-4">Feb 01, 2024</td>
                            <td class="px-6 py-4">Feb 01, 2025</td>
                            <td class="px-6 py-4"><span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success/20 text-green-800 dark:bg-success/30 dark:text-success">Active</span>
                            </td>
                            <td class="px-6 py-4 text-center"><button
                                    class="text-gray-500 hover:text-primary dark:hover:text-primary"><span
                                        class="material-symbols-outlined">more_horiz</span></button></td>
                        </tr>
                        <tr
                            class="bg-white dark:bg-black/10 border-b dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="w-4 p-4"><input
                                    class="form-checkbox rounded border-gray-300 text-primary focus:ring-primary"
                                    type="checkbox" /></td>
                            <td class="px-6 py-4 font-medium text-neutral-text dark:text-white whitespace-nowrap">Sophia
                                Davis<div class="text-xs text-gray-400">sophia.d@email.com</div>
                            </td>
                            <td class="px-6 py-4">Pro</td>
                            <td class="px-6 py-4 flex items-center gap-2"><img alt="Visa card icon" class="h-4"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuB32JWt6ZxkKRMot3pGdDP6QOU_NVv-jD28cGMOLShJWpm6UZINpBJ_g7JE6moetCq7c3FpvfNiYbSIGb_FyR0SmShK7pvb0ehvpUuB5dJVzuewVZC7CaKMUUY8YyjiuFlui97xvSl227am8vRGWZbUDogWlnUqIpsdLfT7wwCNmoI5wLK63RI1mpC1DnXruwBLQzXfWnvSTwx9hxrT03yYZ5jC2KIw26YZ6cT5TMmHVNbYeKHA72IVq-UqpKG2TiRj_80_Dghhor0" />Visa
                                **** 9012</td>
                            <td class="px-6 py-4">Mar 10, 2023</td>
                            <td class="px-6 py-4">Mar 10, 2024</td>
                            <td class="px-6 py-4"><span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-error/10 text-error dark:bg-error/20">Canceled</span>
                            </td>
                            <td class="px-6 py-4 text-center"><button
                                    class="text-gray-500 hover:text-primary dark:hover:text-primary"><span
                                        class="material-symbols-outlined">more_horiz</span></button></td>
                        </tr>
                        <tr
                            class="bg-white dark:bg-black/10 border-b dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="w-4 p-4"><input
                                    class="form-checkbox rounded border-gray-300 text-primary focus:ring-primary"
                                    type="checkbox" /></td>
                            <td class="px-6 py-4 font-medium text-neutral-text dark:text-white whitespace-nowrap">Noah
                                Clark<div class="text-xs text-gray-400">noah.c@email.com</div>
                            </td>
                            <td class="px-6 py-4">Free</td>
                            <td class="px-6 py-4">-</td>
                            <td class="px-6 py-4">Apr 22, 2024</td>
                            <td class="px-6 py-4">-</td>
                            <td class="px-6 py-4"><span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success/20 text-green-800 dark:bg-success/30 dark:text-success">Active</span>
                            </td>
                            <td class="px-6 py-4 text-center"><button
                                    class="text-gray-500 hover:text-primary dark:hover:text-primary"><span
                                        class="material-symbols-outlined">more_horiz</span></button></td>
                        </tr>
                        <tr
                            class="bg-white dark:bg-black/10 border-b dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="w-4 p-4"><input
                                    class="form-checkbox rounded border-gray-300 text-primary focus:ring-primary"
                                    type="checkbox" /></td>
                            <td class="px-6 py-4 font-medium text-neutral-text dark:text-white whitespace-nowrap">Ava
                                Wilson<div class="text-xs text-gray-400">ava.w@email.com</div>
                            </td>
                            <td class="px-6 py-4">Business</td>
                            <td class="px-6 py-4 flex items-center gap-2"><img alt="Mastercard icon" class="h-4"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAQr7ljxMb1L9624we8h52Gp8koc_XPinbTazZBf02oC6gou1BheMnUFunI1tcujU72PQ7tCnKOkGkVu9NZDiVrGHSP2hHNS9e0ISMjBSiRz-wCc9K14ODAdzWp6BZr0Je9ixrc-2auu1xEvFnS4Ewu7uwmh35jU4JJ5K6pvx75nnGb_kPcGgYpQmIJUU9zBi1kV7Hh0hFKOfRS0X21iZPpxTzlV20WiJ1ShcLaqfS9SG2dl40B4KpkwmnXhPTozGMTYeMV1XHnJCQ" />Mastercard
                                **** 3456</td>
                            <td class="px-6 py-4">May 05, 2023</td>
                            <td class="px-6 py-4">May 05, 2024</td>
                            <td class="px-6 py-4"><span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-warning/20 text-yellow-800 dark:bg-warning/30 dark:text-warning">Expired</span>
                            </td>
                            <td class="px-6 py-4 text-center"><button
                                    class="text-gray-500 hover:text-primary dark:hover:text-primary"><span
                                        class="material-symbols-outlined">more_horiz</span></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <nav aria-label="Table navigation" class="flex items-center justify-between pt-4">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing <span
                        class="font-semibold text-neutral-text dark:text-white">1-5</span> of <span
                        class="font-semibold text-neutral-text dark:text-white">100</span></span>
                <div class="inline-flex items-center -space-x-px">
                    <a class="flex items-center justify-center h-8 px-3 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        href="#">Previous</a>
                    <a class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        href="#">1</a>
                    <a aria-current="page"
                        class="flex items-center justify-center h-8 px-3 text-primary border border-primary/50 bg-primary/10 hover:bg-primary/20 hover:text-blue-700 dark:border-primary/70 dark:bg-primary/20 dark:text-white"
                        href="#">2</a>
                    <a class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        href="#">3</a>
                    <a class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        href="#">Next</a>
                </div>
            </nav>
        </div>
    </div>
</x-layouts.app>
