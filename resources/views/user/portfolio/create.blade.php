<x-layouts.app>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
        <!-- Main Header section -->
        <div class="flex flex-col gap-6">
            <!-- ProgressBar -->
            <div class="flex flex-col gap-3">
                <div class="flex gap-6 justify-between items-center">
                    <p class="text-slate-900 dark:text-white text-base font-medium leading-normal">Step 1 of 4</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Choose a Template</p>
                </div>
                <div class="rounded-full bg-slate-200 dark:bg-slate-700 h-2">
                    <div class="h-2 rounded-full bg-primary" style="width: 25%;"></div>
                </div>
            </div>
            <!-- PageHeading -->
            <div class="flex flex-wrap justify-between gap-3 items-center">
                <div class="flex flex-col gap-2">
                    <h1 class="text-slate-900 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">
                        Select a Template to Begin</h1>
                    <p class="text-slate-600 dark:text-slate-400 text-base font-normal leading-normal">Choose a template
                        that best fits your style or industry. You can customize it later.</p>
                </div>
            </div>
            <!-- Toolbar -->
            <div
                class="flex justify-between items-center gap-4 py-3 border-t border-b border-slate-200/80 dark:border-slate-800">
                <div class="flex-1 relative">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500">search</span>
                    <input
                        class="w-full max-w-xs pl-10 pr-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all"
                        placeholder="Search templates..." type="text" />
                </div>
                <div class="flex gap-2 items-center">
                    <!-- Chips -->
                    <button
                        class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-white dark:bg-slate-900/50 border border-slate-300 dark:border-slate-700 px-4">
                        <p class="text-slate-700 dark:text-slate-300 text-sm font-medium leading-normal">Industry</p>
                        <span
                            class="material-symbols-outlined text-lg text-slate-500 dark:text-slate-400">expand_more</span>
                    </button>
                    <button
                        class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-white dark:bg-slate-900/50 border border-slate-300 dark:border-slate-700 px-4">
                        <p class="text-slate-700 dark:text-slate-300 text-sm font-medium leading-normal">Style</p>
                        <span
                            class="material-symbols-outlined text-lg text-slate-500 dark:text-slate-400">expand_more</span>
                    </button>
                    <button
                        class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-white dark:bg-slate-900/50 border border-slate-300 dark:border-slate-700 px-4">
                        <p class="text-slate-700 dark:text-slate-300 text-sm font-medium leading-normal">Color</p>
                        <span
                            class="material-symbols-outlined text-lg text-slate-500 dark:text-slate-400">expand_more</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- Template Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
            <!-- Template Card 1 -->
            <div
                class="group relative overflow-hidden rounded-xl bg-white dark:bg-slate-900 shadow-sm hover:shadow-xl transition-shadow duration-300 template-card">
                <div class="overflow-hidden">
                    <div class="bg-center bg-no-repeat aspect-[4/3] bg-cover rounded-t-xl transition-transform duration-300 template-image"
                        data-alt="Abstract gradient from purple to pink"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAhqm797tQTb-kYmrHiBXKkkKD40qDCt7bgSOBBrhLpts2ZlmTTwkdbkYk6XFZ6-ZVoeV_8PoNtxS58sd1nCjDKF5cdZ_AZu0JTvBqlFT42sl93XG9W8a0bVqo76zo1uojwlyoaExXxZHCXt_Fea47p1B9qxw3bk8xM0-9qH4bxZEEeZg2v6NEbOGHRqaAL6N4jaEEfikqwT5aQI5LW9E3U4pkkGDwlNnTGfL7hzfN8TpBe0WqTSYcJOlLV3tcP1yURcZRlTGaABvU");'>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Minimalist Pro</h3>
                    <div class="flex gap-2 mt-2">
                        <span
                            class="text-xs font-semibold text-primary bg-primary/10 px-2 py-1 rounded-full">Photography</span>
                        <span
                            class="text-xs font-semibold text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-full">Modern</span>
                    </div>
                </div>
                <div
                    class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center gap-4 opacity-0 transition-opacity duration-300 template-overlay">
                    <button
                        class="bg-white/90 text-slate-900 font-semibold py-2 px-6 rounded-lg backdrop-blur-sm hover:bg-white transition-colors">Preview</button>
                    <button
                        class="bg-primary text-white font-semibold py-2 px-6 rounded-lg hover:bg-primary/90 transition-colors">Select</button>
                </div>
            </div>
            <!-- Template Card 2 -->
            <div
                class="group relative overflow-hidden rounded-xl bg-white dark:bg-slate-900 shadow-sm hover:shadow-xl transition-shadow duration-300 template-card">
                <div class="overflow-hidden">
                    <div class="bg-center bg-no-repeat aspect-[4/3] bg-cover rounded-t-xl transition-transform duration-300 template-image"
                        data-alt="Geometric pattern in shades of blue and green"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCq7FCsR3yf4VX7sBC47peDQShrf0hgR7A5PV93blKcaDnJW-LYmG5NGf1U-CHkMzfcJ0XCGqCTQAFk4aVeqBSrL-gSNnlcJ9IgSdGVwEQ8qmodFl6aXzi8AuiPOLSFdtIr94JXRHtVEjqyQ9eZdE6XOfCaqijr6ecQiCLbwxLstNhQmmQESjPMxC9DNbbYcrsk5kuXG-Rqhx1Mp1wiP1hDBiVv5Cp2MdcgMKwCuSb0jIBY8WX8I--erVPmSDjoLO-XEIKKLKrUaJU");'>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Creative Agency</h3>
                    <div class="flex gap-2 mt-2">
                        <span
                            class="text-xs font-semibold text-primary bg-primary/10 px-2 py-1 rounded-full">UX/UI</span>
                        <span
                            class="text-xs font-semibold text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-full">Corporate</span>
                    </div>
                </div>
                <div
                    class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center gap-4 opacity-0 transition-opacity duration-300 template-overlay">
                    <button
                        class="bg-white/90 text-slate-900 font-semibold py-2 px-6 rounded-lg backdrop-blur-sm hover:bg-white transition-colors">Preview</button>
                    <button
                        class="bg-primary text-white font-semibold py-2 px-6 rounded-lg hover:bg-primary/90 transition-colors">Select</button>
                </div>
            </div>
            <!-- Template Card 3 -->
            <div
                class="group relative overflow-hidden rounded-xl bg-white dark:bg-slate-900 shadow-sm hover:shadow-xl transition-shadow duration-300 template-card">
                <div class="overflow-hidden">
                    <div class="bg-center bg-no-repeat aspect-[4/3] bg-cover rounded-t-xl transition-transform duration-300 template-image"
                        data-alt="Wavy lines in pastel colors"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAk-ravoRF2AixmhvXoHsGrZotWxGQeuRNigeQ4_xJMa6g9y5hEQnIoZqHmDLLW5Z3fuiMNKi9jW9LgE_RT57aib3i_WHlUleAzhtkJZu3FKUjUbJTOtL1LOL95tUBUWVOIWX7vWL5gmJjMgOGPv9HBlknHQfPNvJBcQZFekrZr0P04q4fcFShIIZmU6UJDJXaJv933BfUCm_KOF9rBS4uK2psNnfiTkkMXdt5uiPWhbS6DWnnr0Sp5oC20HaE4wgS7hE5lF6Sc8Gw");'>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Writer's Desk</h3>
                    <div class="flex gap-2 mt-2">
                        <span
                            class="text-xs font-semibold text-primary bg-primary/10 px-2 py-1 rounded-full">Writer</span>
                        <span
                            class="text-xs font-semibold text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-full">Clean</span>
                    </div>
                </div>
                <div
                    class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center gap-4 opacity-0 transition-opacity duration-300 template-overlay">
                    <button
                        class="bg-white/90 text-slate-900 font-semibold py-2 px-6 rounded-lg backdrop-blur-sm hover:bg-white transition-colors">Preview</button>
                    <button
                        class="bg-primary text-white font-semibold py-2 px-6 rounded-lg hover:bg-primary/90 transition-colors">Select</button>
                </div>
            </div>
            <!-- Template Card 4 -->
            <div
                class="group relative overflow-hidden rounded-xl bg-white dark:bg-slate-900 shadow-sm hover:shadow-xl transition-shadow duration-300 template-card">
                <div class="overflow-hidden">
                    <div class="bg-center bg-no-repeat aspect-[4/3] bg-cover rounded-t-xl transition-transform duration-300 template-image"
                        data-alt="Dark abstract background with light streaks"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAz4i-nj0f6Gma71ed0Zee8zY4d9vh-2zLA9FHkJIHSwBjyvQQBVYQVZ_ksMPCN510KzaTts_nN6vqMY7TUbci7U8crg2u6SclsLu-JJuK2PXhnfD-BO3egUpBKqEAEqHFg_wDFDR0_gD0wJ69TY2SzQjryz4euaAyeIJQkK7KUBDnqtFhlgZ2qWicxlIMPWMz01tHFjx2e5067nXy6gFMV-dGiqPrTe0YON8uuJVsm1c6SYnPfAANOn8LDQXJbpMxvohJFSnDdXzE");'>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Consultant Hub</h3>
                    <div class="flex gap-2 mt-2">
                        <span
                            class="text-xs font-semibold text-primary bg-primary/10 px-2 py-1 rounded-full">Business</span>
                        <span
                            class="text-xs font-semibold text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-full">Professional</span>
                    </div>
                </div>
                <div
                    class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center gap-4 opacity-0 transition-opacity duration-300 template-overlay">
                    <button
                        class="bg-white/90 text-slate-900 font-semibold py-2 px-6 rounded-lg backdrop-blur-sm hover:bg-white transition-colors">Preview</button>
                    <button
                        class="bg-primary text-white font-semibold py-2 px-6 rounded-lg hover:bg-primary/90 transition-colors">Select</button>
                </div>
            </div>
            <!-- Template Card 5 -->
            <div
                class="group relative overflow-hidden rounded-xl bg-white dark:bg-slate-900 shadow-sm hover:shadow-xl transition-shadow duration-300 template-card">
                <div class="overflow-hidden">
                    <div class="bg-center bg-no-repeat aspect-[4/3] bg-cover rounded-t-xl transition-transform duration-300 template-image"
                        data-alt="Liquid marble texture in teal and gold"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBgAjXTgwVd9F7h5p5cwqXSNekK0wz6mer6kORtKdNB2AUFCD4eVH-wd-OhdAADew1p7NGPXneo2NARpqmLsIWC7_oHM9fRjtLjKu4fPA4IzZ_HZq7GtQ-pi7VNpBu48BIM3wpWWZH3AoJJ29z_GeXYSgmin2eP7trl1kllCBoevG0cYdhUAg81PPSK6fRq1nbA1GxvDy2YEuGMXYvrnTn4c-CeOPlFeclvX-vFVU1rTJpWc20qGvQ-gx-b_eIC-GyJ_4Ox8Zmamlg");'>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Digital Marketer</h3>
                    <div class="flex gap-2 mt-2">
                        <span
                            class="text-xs font-semibold text-primary bg-primary/10 px-2 py-1 rounded-full">Marketing</span>
                        <span
                            class="text-xs font-semibold text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-full">Bold</span>
                    </div>
                </div>
                <div
                    class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center gap-4 opacity-0 transition-opacity duration-300 template-overlay">
                    <button
                        class="bg-white/90 text-slate-900 font-semibold py-2 px-6 rounded-lg backdrop-blur-sm hover:bg-white transition-colors">Preview</button>
                    <button
                        class="bg-primary text-white font-semibold py-2 px-6 rounded-lg hover:bg-primary/90 transition-colors">Select</button>
                </div>
            </div>
            <!-- Template Card 6 -->
            <div
                class="group relative overflow-hidden rounded-xl bg-white dark:bg-slate-900 shadow-sm hover:shadow-xl transition-shadow duration-300 template-card">
                <div class="overflow-hidden">
                    <div class="bg-center bg-no-repeat aspect-[4/3] bg-cover rounded-t-xl transition-transform duration-300 template-image"
                        data-alt="Soft focused colorful lights bokeh"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA3nOFwQR0V5jqGPygoFSRX6u-XA0X8zeVzGrfLiX2Yic4nmYwaI4pJZ-c-JYutGriNLmY_MdqlKz4tlApzHOwNByt8stzDuU-Tw9YxDgXhWwC8MdJ_r3zOtWTuz9MV5QGJktiimSN6ZzJcu-RNdPW70R2zGSBrSb-Hq1GUvX_W-4io8_eIpa7577xkpU4no2K7qoB_k16O8SVQAJjJhxqJWXStGaGKxgoufiyktWfhd6EdvdDXoW-6KfqkP-okiCPmvPXw1H15LeE");'>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Photographer's Gallery</h3>
                    <div class="flex gap-2 mt-2">
                        <span
                            class="text-xs font-semibold text-primary bg-primary/10 px-2 py-1 rounded-full">Photography</span>
                        <span
                            class="text-xs font-semibold text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-full">Visual</span>
                    </div>
                </div>
                <div
                    class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center gap-4 opacity-0 transition-opacity duration-300 template-overlay">
                    <button
                        class="bg-white/90 text-slate-900 font-semibold py-2 px-6 rounded-lg backdrop-blur-sm hover:bg-white transition-colors">Preview</button>
                    <button
                        class="bg-primary text-white font-semibold py-2 px-6 rounded-lg hover:bg-primary/90 transition-colors">Select</button>
                </div>
            </div>
        </div>
        <!-- Pagination and Next Step -->
        <div class="mt-12 flex justify-between items-center border-t border-slate-200/80 dark:border-slate-800 pt-6">
            <nav class="flex items-center gap-2">
                <button
                    class="size-9 flex items-center justify-center rounded-lg border border-slate-300 dark:border-slate-700 text-slate-500 dark:text-slate-400">
                    <span class="material-symbols-outlined text-xl">chevron_left</span>
                </button>
                <button
                    class="size-9 flex items-center justify-center rounded-lg bg-primary text-white font-semibold">1</button>
                <button
                    class="size-9 flex items-center justify-center rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">2</button>
                <button
                    class="size-9 flex items-center justify-center rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">3</button>
                <button
                    class="size-9 flex items-center justify-center rounded-lg border border-slate-300 dark:border-slate-700 text-slate-500 dark:text-slate-400">
                    <span class="material-symbols-outlined text-xl">chevron_right</span>
                </button>
            </nav>
            <button
                class="bg-primary text-white font-semibold py-3 px-6 rounded-lg hover:bg-primary/90 transition-colors disabled:bg-slate-300 dark:disabled:bg-slate-700 disabled:cursor-not-allowed flex items-center gap-2"
                disabled="">
                Next Step
                <span class="material-symbols-outlined">arrow_forward</span>
            </button>
        </div>
    </div>
   
    <!-- Template Preview Modal -->
    <div
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
        <div
            class="bg-background-light dark:bg-background-dark w-full max-w-5xl h-[90vh] rounded-xl shadow-2xl flex flex-col">
            <header class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-slate-800">
                <div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">Preview: Minimalist Pro</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">A clean, modern template for photographers.
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="flex items-center p-1 bg-slate-200 dark:bg-slate-800 rounded-lg">
                        <button class="p-2 rounded-md bg-white dark:bg-slate-700 text-primary">
                            <span class="material-symbols-outlined">desktop_windows</span>
                        </button>
                        <button
                            class="p-2 rounded-md text-slate-500 dark:text-slate-400 hover:bg-white/50 dark:hover:bg-slate-700/50">
                            <span class="material-symbols-outlined">tablet_mac</span>
                        </button>
                        <button
                            class="p-2 rounded-md text-slate-500 dark:text-slate-400 hover:bg-white/50 dark:hover:bg-slate-700/50">
                            <span class="material-symbols-outlined">smartphone</span>
                        </button>
                    </div>
                    <button
                        class="text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 p-2 rounded-lg">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
            </header>
            <div class="flex-1 overflow-y-auto bg-slate-200 dark:bg-slate-900 p-8">
                <div class="bg-center bg-no-repeat w-full h-[1200px] bg-cover shadow-lg rounded-md"
                    data-alt="Detailed preview of a portfolio website template"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB0RWUe6JHc6E4GDZifRq9l0BQY9EepNhKk-2ClefztiV52cDIl9l7jVn1MoZioMEXf5FLEU8fH6DKbM1Gv_tP8eup2PdhgW6Wnd4kIx1PBrwiaI00GRkgbNduClSxMCMjeNEBXEI3TMn3uLF0wALOPJ-VlahXubzI_fqVRgL1hZ2o3oYNMR_-iUHwUWEyonns6aL1H_t5lc8oDFfzK3Mru-bmcCZ2M6-A9knyGDKlwl9cnxl-O7fXipAoMtt928Z2D32tmbyuXe5Q");'>
                </div>
            </div>
            <footer class="p-4 border-t border-slate-200 dark:border-slate-800 flex justify-end">
                <button
                    class="bg-primary text-white font-semibold py-3 px-8 rounded-lg hover:bg-primary/90 transition-colors">Select
                    This Template</button>
            </footer>
        </div>
    </div>
</x-layouts.app>
