<x-layouts.app>
    <div class="flex flex-col max-w-7xl mx-auto w-full">
        <!-- PageHeading -->
        <header class="flex flex-wrap justify-between gap-3 mb-8">
            <div class="flex flex-col gap-2">
                <p
                    class="text-slate-900 dark:text-white text-3xl lg:text-4xl font-black leading-tight tracking-[-0.033em]">
                    Arrange Your Portfolio Sections</p>
                <p class="text-slate-500 dark:text-slate-400 text-base font-normal leading-normal">Drag and drop the
                    sections you want to include, and reorder them to your liking.</p>
            </div>
        </header>
        {{-- step 1 --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 flex-1">
            <!-- Available Sections -->
            <div class="flex flex-col gap-4">
                <h3 class="text-slate-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] px-4">
                    Available Sections</h3>
                <div
                    class="flex flex-col gap-2 p-2 bg-slate-100 dark:bg-black/30 rounded-xl border border-slate-200 dark:border-slate-800">
                    <!-- ListItem 1 -->
                    <div
                        class="flex items-center gap-4 bg-white dark:bg-slate-900/50 px-4 min-h-[72px] py-2 justify-between rounded-lg shadow-sm">
                        <div class="flex items-center gap-4">
                            <div
                                class="text-slate-700 dark:text-slate-300 flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 shrink-0 size-12">
                                <span class="material-symbols-outlined">person</span>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p
                                    class="text-slate-900 dark:text-white text-base font-medium leading-normal line-clamp-1">
                                    About</p>
                                <p
                                    class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal line-clamp-2">
                                    A brief introduction about yourself.</p>
                            </div>
                        </div>
                        <div class="shrink-0 cursor-grab active:cursor-grabbing">
                            <div class="text-slate-500 dark:text-slate-400 flex size-7 items-center justify-center">
                                <span class="material-symbols-outlined">drag_indicator</span>
                            </div>
                        </div>
                    </div>
                    <!-- ListItem 2 -->
                    <div
                        class="flex items-center gap-4 bg-white dark:bg-slate-900/50 px-4 min-h-[72px] py-2 justify-between rounded-lg shadow-sm">
                        <div class="flex items-center gap-4">
                            <div
                                class="text-slate-700 dark:text-slate-300 flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 shrink-0 size-12">
                                <span class="material-symbols-outlined">work</span>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p
                                    class="text-slate-900 dark:text-white text-base font-medium leading-normal line-clamp-1">
                                    Experience</p>
                                <p
                                    class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal line-clamp-2">
                                    Detail your professional history.</p>
                            </div>
                        </div>
                        <div class="shrink-0 cursor-grab active:cursor-grabbing">
                            <div class="text-slate-500 dark:text-slate-400 flex size-7 items-center justify-center">
                                <span class="material-symbols-outlined">drag_indicator</span>
                            </div>
                        </div>
                    </div>
                    <!-- ListItem 3 -->
                    <div
                        class="flex items-center gap-4 bg-white dark:bg-slate-900/50 px-4 min-h-[72px] py-2 justify-between rounded-lg shadow-sm">
                        <div class="flex items-center gap-4">
                            <div
                                class="text-slate-700 dark:text-slate-300 flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 shrink-0 size-12">
                                <span class="material-symbols-outlined">lightbulb</span>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p
                                    class="text-slate-900 dark:text-white text-base font-medium leading-normal line-clamp-1">
                                    Skills</p>
                                <p
                                    class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal line-clamp-2">
                                    List your technical and soft skills.</p>
                            </div>
                        </div>
                        <div class="shrink-0 cursor-grab active:cursor-grabbing">
                            <div class="text-slate-500 dark:text-slate-400 flex size-7 items-center justify-center">
                                <span class="material-symbols-outlined">drag_indicator</span>
                            </div>
                        </div>
                    </div>
                    <!-- ListItem 4 -->
                    <div
                        class="flex items-center gap-4 bg-white dark:bg-slate-900/50 px-4 min-h-[72px] py-2 justify-between rounded-lg shadow-sm">
                        <div class="flex items-center gap-4">
                            <div
                                class="text-slate-700 dark:text-slate-300 flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 shrink-0 size-12">
                                <span class="material-symbols-outlined">school</span>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p
                                    class="text-slate-900 dark:text-white text-base font-medium leading-normal line-clamp-1">
                                    Education</p>
                                <p
                                    class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal line-clamp-2">
                                    Your academic background.</p>
                            </div>
                        </div>
                        <div class="shrink-0 cursor-grab active:cursor-grabbing">
                            <div class="text-slate-500 dark:text-slate-400 flex size-7 items-center justify-center">
                                <span class="material-symbols-outlined">drag_indicator</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Your Portfolio Sections -->
            <div class="flex flex-col gap-4">
                <h3 class="text-slate-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] px-4">Your
                    Portfolio Sections</h3>
                <div
                    class="flex flex-col gap-2 p-2 bg-slate-100 dark:bg-black/30 rounded-xl border-2 border-dashed border-slate-300 dark:border-slate-700 min-h-[480px]">
                    <!-- ListItem 1 (added) -->
                    <div
                        class="flex items-center gap-4 bg-white dark:bg-slate-900/50 px-4 min-h-[72px] py-2 justify-between rounded-lg shadow-sm">
                        <div class="flex items-center gap-4">
                            <div
                                class="text-slate-700 dark:text-slate-300 flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 shrink-0 size-12">
                                <span class="material-symbols-outlined">grid_view</span>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p
                                    class="text-slate-900 dark:text-white text-base font-medium leading-normal line-clamp-1">
                                    Projects</p>
                                <p
                                    class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal line-clamp-2">
                                    Showcase your best work.</p>
                            </div>
                        </div>
                        <div class="shrink-0 cursor-grab active:cursor-grabbing">
                            <div class="text-slate-500 dark:text-slate-400 flex size-7 items-center justify-center">
                                <span class="material-symbols-outlined">drag_indicator</span>
                            </div>
                        </div>
                    </div>
                    <!-- ListItem 2 (added) -->
                    <div
                        class="flex items-center gap-4 bg-white dark:bg-slate-900/50 px-4 min-h-[72px] py-2 justify-between rounded-lg shadow-sm">
                        <div class="flex items-center gap-4">
                            <div
                                class="text-slate-700 dark:text-slate-300 flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 shrink-0 size-12">
                                <span class="material-symbols-outlined">mail</span>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p
                                    class="text-slate-900 dark:text-white text-base font-medium leading-normal line-clamp-1">
                                    Contact</p>
                                <p
                                    class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal line-clamp-2">
                                    How people can get in touch.</p>
                            </div>
                        </div>
                        <div class="shrink-0 cursor-grab active:cursor-grabbing">
                            <div class="text-slate-500 dark:text-slate-400 flex size-7 items-center justify-center">
                                <span class="material-symbols-outlined">drag_indicator</span>
                            </div>
                        </div>
                    </div>
                    <!-- Empty State (visible when no sections are added) -->
                    <div class="hidden items-center justify-center flex-col flex-1 text-center p-4">
                        <span
                            class="material-symbols-outlined text-4xl text-slate-400 dark:text-slate-600 mb-2">add_to_photos</span>
                        <p class="font-bold text-slate-600 dark:text-slate-400">Your portfolio is empty</p>
                        <p class="text-sm text-slate-500 dark:text-slate-500">Drag sections here to start building.</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- step 1 ends here --}}

        {{-- step 2 --}}
        <!-- Left: Input Panel -->
        <div
            class="lg:col-span- xl:col-span-2 flex h-[calc(100vh-4rem)] flex-col overflow-y-auto border-r border-neutral-light-gray dark:border-neutral-dark-gray/20">
            <div class="p-8">
                <div class="flex flex-col gap-2">
                    <h1 class="text-2xl font-bold text-neutral-dark-gray dark:text-neutral-white">Portfolio Content</h1>
                    <p class="text-neutral-medium-gray text-base font-normal">Fill in the details for your portfolio.
                        Your changes will be saved automatically.</p>
                </div>
            </div>
            <div class="flex flex-col gap-4 px-8 pb-8">
                <details
                    class="flex flex-col rounded-xl border border-neutral-light-gray dark:border-neutral-dark-gray/20 bg-neutral-white dark:bg-background-dark/50 px-4 group"
                    open="">
                    <summary class="flex cursor-pointer items-center justify-between gap-6 py-3.5">
                        <p class="text-neutral-dark-gray dark:text-neutral-white text-base font-semibold">Hero Section
                        </p>
                        <span
                            class="material-symbols-outlined text-neutral-medium-gray group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <div class="flex flex-col gap-4 pb-4">
                        <label class="flex flex-col w-full">
                            <p class="text-sm font-medium text-neutral-dark-gray dark:text-neutral-white pb-1.5">
                                Headline</p>
                            <input
                                class="form-input w-full rounded-lg border-neutral-light-gray bg-neutral-white text-neutral-dark-gray placeholder:text-neutral-medium-gray/70 focus:border-primary focus:ring-primary/20 focus:ring-2 dark:bg-neutral-white/5 dark:border-neutral-dark-gray/30 dark:text-neutral-white dark:focus:border-primary"
                                placeholder="e.g., Senior Product Designer at Acme Inc."
                                value="Designing experiences that matter." />
                        </label>
                        <label class="flex flex-col w-full">
                            <p class="text-sm font-medium text-neutral-dark-gray dark:text-neutral-white pb-1.5">
                                Sub-heading</p>
                            <textarea
                                class="form-textarea w-full rounded-lg border-neutral-light-gray bg-neutral-white text-neutral-dark-gray placeholder:text-neutral-medium-gray/70 focus:border-primary focus:ring-primary/20 focus:ring-2 dark:bg-neutral-white/5 dark:border-neutral-dark-gray/30 dark:text-neutral-white dark:focus:border-primary"
                                placeholder="A brief description about you and your work." rows="3">I specialize in creating intuitive and beautiful user interfaces. Passionate about solving complex problems through design.</textarea>
                        </label>
                        <div class="flex w-full flex-col">
                            <p class="text-sm font-medium text-neutral-dark-gray dark:text-neutral-white pb-1.5">Hero
                                Image</p>
                            <div
                                class="flex w-full items-center justify-center rounded-lg border-2 border-dashed border-neutral-light-gray bg-neutral-offwhite dark:border-neutral-dark-gray/30 dark:bg-neutral-dark-gray/20 p-6 text-center">
                                <div class="flex flex-col items-center gap-1">
                                    <span class="material-symbols-outlined text-3xl text-primary">cloud_upload</span>
                                    <p class="text-sm font-semibold text-neutral-dark-gray dark:text-neutral-white">
                                        <span class="text-primary">Click to upload</span> or drag and drop
                                    </p>
                                    <p class="text-xs text-neutral-medium-gray">SVG, PNG, JPG or GIF (max. 800x400px)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </details>
                <details
                    class="flex flex-col rounded-xl border border-neutral-light-gray dark:border-neutral-dark-gray/20 bg-neutral-white dark:bg-background-dark/50 px-4 group">
                    <summary class="flex cursor-pointer items-center justify-between gap-6 py-3.5">
                        <p class="text-neutral-dark-gray dark:text-neutral-white text-base font-semibold">About Section
                        </p>
                        <span
                            class="material-symbols-outlined text-neutral-medium-gray group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <div class="flex flex-col gap-4 pb-4 pt-2">
                        <label class="flex flex-col w-full">
                            <p class="text-sm font-medium text-neutral-dark-gray dark:text-neutral-white pb-1.5">
                                Biography</p>
                            <textarea
                                class="form-textarea w-full rounded-lg border-neutral-light-gray bg-neutral-white text-neutral-dark-gray placeholder:text-neutral-medium-gray/70 focus:border-primary focus:ring-primary/20 focus:ring-2 dark:bg-neutral-white/5 dark:border-neutral-dark-gray/30 dark:text-neutral-white dark:focus:border-primary"
                                placeholder="Tell your story..." rows="5"></textarea>
                        </label>
                    </div>
                </details>
                <details
                    class="flex flex-col rounded-xl border border-neutral-light-gray dark:border-neutral-dark-gray/20 bg-neutral-white dark:bg-background-dark/50 px-4 group">
                    <summary class="flex cursor-pointer items-center justify-between gap-6 py-3.5">
                        <p class="text-neutral-dark-gray dark:text-neutral-white text-base font-semibold">Projects</p>
                        <span
                            class="material-symbols-outlined text-neutral-medium-gray group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <div class="flex flex-col gap-4 pb-4 pt-2">
                        <div class="rounded-lg border border-neutral-light-gray dark:border-neutral-dark-gray/30 p-4">
                            <div class="flex items-center justify-between mb-3">
                                <p class="font-semibold text-neutral-dark-gray dark:text-neutral-white">Project 1</p>
                                <button
                                    class="flex items-center justify-center rounded-md p-1.5 hover:bg-neutral-light-gray/80 dark:hover:bg-white/10">
                                    <span
                                        class="material-symbols-outlined text-lg text-neutral-medium-gray">delete</span>
                                </button>
                            </div>
                            <div class="flex flex-col gap-4">
                                <label class="flex flex-col w-full">
                                    <p
                                        class="text-sm font-medium text-neutral-dark-gray dark:text-neutral-white pb-1.5">
                                        Project Title</p>
                                    <input
                                        class="form-input w-full rounded-lg border-neutral-light-gray bg-neutral-white text-neutral-dark-gray placeholder:text-neutral-medium-gray/70 focus:border-primary focus:ring-primary/20 focus:ring-2 dark:bg-neutral-white/5 dark:border-neutral-dark-gray/30 dark:text-neutral-white dark:focus:border-primary"
                                        placeholder="e.g., Redesign of Acme Mobile App" value="" />
                                </label>
                                <label class="flex flex-col w-full">
                                    <p
                                        class="text-sm font-medium text-neutral-dark-gray dark:text-neutral-white pb-1.5">
                                        Project Link</p>
                                    <input
                                        class="form-input w-full rounded-lg border-neutral-light-gray bg-neutral-white text-neutral-dark-gray placeholder:text-neutral-medium-gray/70 focus:border-primary focus:ring-primary/20 focus:ring-2 dark:bg-neutral-white/5 dark:border-neutral-dark-gray/30 dark:text-neutral-white dark:focus:border-primary"
                                        placeholder="https://example.com/my-project" type="url" value="" />
                                </label>
                            </div>
                        </div>
                        <button
                            class="flex w-full items-center justify-center gap-2 rounded-lg border border-neutral-light-gray dark:border-neutral-dark-gray/30 py-2 text-sm font-semibold text-neutral-dark-gray dark:text-neutral-white hover:bg-neutral-offwhite dark:hover:bg-neutral-dark-gray/20 transition-colors">
                            <span class="material-symbols-outlined text-lg">add_circle</span>
                            Add Another Project
                        </button>
                    </div>
                </details>
                <details
                    class="flex flex-col rounded-xl border border-neutral-light-gray dark:border-neutral-dark-gray/20 bg-neutral-white dark:bg-background-dark/50 px-4 group">
                    <summary class="flex cursor-pointer items-center justify-between gap-6 py-3.5">
                        <p class="text-neutral-dark-gray dark:text-neutral-white text-base font-semibold">Contact &amp;
                            Links</p>
                        <span
                            class="material-symbols-outlined text-neutral-medium-gray group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <div class="flex flex-col gap-4 pb-4 pt-2">
                        <label class="flex flex-col w-full">
                            <p class="text-sm font-medium text-neutral-dark-gray dark:text-neutral-white pb-1.5">Email
                            </p>
                            <input
                                class="form-input w-full rounded-lg border-neutral-light-gray bg-neutral-white text-neutral-dark-gray placeholder:text-neutral-medium-gray/70 focus:border-primary focus:ring-primary/20 focus:ring-2 dark:bg-neutral-white/5 dark:border-neutral-dark-gray/30 dark:text-neutral-white dark:focus:border-primary"
                                placeholder="you@example.com" type="email" value="" />
                        </label>
                        <label class="flex flex-col w-full">
                            <p class="text-sm font-medium text-neutral-dark-gray dark:text-neutral-white pb-1.5">
                                LinkedIn Profile</p>
                            <input
                                class="form-input w-full rounded-lg border-neutral-light-gray bg-neutral-white text-neutral-dark-gray placeholder:text-neutral-medium-gray/70 focus:border-primary focus:ring-primary/20 focus:ring-2 dark:bg-neutral-white/5 dark:border-neutral-dark-gray/30 dark:text-neutral-white dark:focus:border-primary"
                                placeholder="https://linkedin.com/in/..." type="url" value="" />
                        </label>
                    </div>
                </details>
            </div>
        </div>
        <!-- Right: Preview Panel -->
        <div
            class="lg:col-span-3 xl:col-span-2 hidden h-[calc(100vh-4rem)] flex-col bg-neutral-offwhite dark:bg-black/20 p-8 md:flex">
            <div
                class="flex-1 rounded-xl bg-neutral-white dark:bg-background-dark shadow-lg ring-1 ring-black/5 dark:ring-white/10 overflow-hidden">
                <div
                    class="h-12 w-full bg-neutral-white dark:bg-neutral-dark-gray/50 flex items-center px-4 border-b border-neutral-light-gray dark:border-neutral-dark-gray/20">
                    <div class="flex items-center gap-1.5">
                        <div class="size-3 rounded-full bg-red-400"></div>
                        <div class="size-3 rounded-full bg-yellow-400"></div>
                        <div class="size-3 rounded-full bg-green-400"></div>
                    </div>
                    <div class="ml-4 flex-1 rounded bg-neutral-light-gray dark:bg-neutral-dark-gray/30 h-8"></div>
                </div>
                <div class="w-full h-[calc(100%-3rem)] overflow-y-auto">
                    <!-- This is where the live preview would be rendered -->
                    <div class="w-full">
                        <!-- Hero Section Preview -->
                        <section class="bg-neutral-offwhite dark:bg-background-dark/30 py-20 px-6 text-center">
                            <div class="max-w-4xl mx-auto">
                                <h1
                                    class="text-5xl font-extrabold text-neutral-dark-gray dark:text-neutral-white tracking-tight">
                                    Designing experiences that matter.</h1>
                                <p class="mt-4 text-lg text-neutral-medium-gray dark:text-neutral-light-gray/80">I
                                    specialize in creating intuitive and beautiful user interfaces. Passionate about
                                    solving complex problems through design.</p>
                                <div class="mt-8 flex justify-center">
                                    <div class="h-12 w-40 rounded-lg bg-primary"></div>
                                </div>
                            </div>
                            <div class="mt-12 mx-auto h-96 w-full max-w-5xl rounded-xl bg-neutral-light-gray dark:bg-neutral-dark-gray/30"
                                data-alt="Placeholder for hero image"></div>
                        </section>
                        <!-- About Section Preview -->
                        <section class="py-16 px-6">
                            <div class="max-w-4xl mx-auto grid grid-cols-3 gap-8 items-center">
                                <div class="col-span-1 size-40 rounded-full bg-neutral-light-gray dark:bg-neutral-dark-gray/30 mx-auto"
                                    data-alt="Placeholder for profile picture"></div>
                                <div class="col-span-2">
                                    <h2 class="text-3xl font-bold text-neutral-dark-gray dark:text-neutral-white">About
                                        Me</h2>
                                    <div class="mt-4 space-y-2">
                                        <div
                                            class="h-4 w-full rounded bg-neutral-light-gray dark:bg-neutral-dark-gray/30">
                                        </div>
                                        <div
                                            class="h-4 w-full rounded bg-neutral-light-gray dark:bg-neutral-dark-gray/30">
                                        </div>
                                        <div
                                            class="h-4 w-5/6 rounded bg-neutral-light-gray dark:bg-neutral-dark-gray/30">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Projects Section Preview -->
                        <section class="bg-neutral-offwhite dark:bg-background-dark/30 py-16 px-6">
                            <div class="max-w-5xl mx-auto">
                                <h2
                                    class="text-3xl font-bold text-center text-neutral-dark-gray dark:text-neutral-white">
                                    My Work</h2>
                                <div class="mt-12 grid grid-cols-2 gap-8">
                                    <div
                                        class="rounded-xl border border-neutral-light-gray dark:border-neutral-dark-gray/20 bg-neutral-white dark:bg-background-dark/50 p-4">
                                        <div
                                            class="w-full h-48 rounded-lg bg-neutral-light-gray dark:bg-neutral-dark-gray/30">
                                        </div>
                                        <div
                                            class="mt-4 h-6 w-3/4 rounded bg-neutral-light-gray dark:bg-neutral-dark-gray/30">
                                        </div>
                                        <div
                                            class="mt-2 h-4 w-1/2 rounded bg-neutral-light-gray dark:bg-neutral-dark-gray/30">
                                        </div>
                                    </div>
                                    <div
                                        class="rounded-xl border border-neutral-light-gray dark:border-neutral-dark-gray/20 bg-neutral-white dark:bg-background-dark/50 p-4">
                                        <div
                                            class="w-full h-48 rounded-lg bg-neutral-light-gray dark:bg-neutral-dark-gray/30">
                                        </div>
                                        <div
                                            class="mt-4 h-6 w-3/4 rounded bg-neutral-light-gray dark:bg-neutral-dark-gray/30">
                                        </div>
                                        <div
                                            class="mt-2 h-4 w-1/2 rounded bg-neutral-light-gray dark:bg-neutral-dark-gray/30">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        {{-- step 2 ends here --}}

        <!-- Action Buttons -->
        <div class="flex justify-between items-center mt-10 pt-6 border-t border-slate-200 dark:border-slate-800">
            <button
                class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 text-slate-700 dark:text-slate-300 text-sm font-bold leading-normal tracking-wide hover:bg-slate-200 dark:hover:bg-slate-800">
                <span class="truncate">Back</span>
            </button>
            <button
                class="flex min-w-[84px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-10 px-5 bg-primary text-white text-sm font-bold leading-normal shadow-lg shadow-primary/30 hover:bg-primary/90">
                <span class="truncate">Next: Add Content</span>
                <span class="material-symbols-outlined">arrow_forward</span>
            </button>
        </div>
    </div>
</x-layouts.app>

