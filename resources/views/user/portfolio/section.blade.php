<x-layouts.app>
    <div class="flex flex-col gap-8">
        <!-- About Section -->
        <section
            class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/50 p-6 shadow-sm">
            <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]">About</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <label class="flex flex-col col-span-1">
                    <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">Name</p>
                    <input
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4 py-2 text-base font-normal"
                        value="Jane Doe" />
                </label>
                <label class="flex flex-col col-span-1">
                    <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">Brief</p>
                    <input
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4 py-2 text-base font-normal"
                        placeholder="e.g. Senior Product Designer" />
                </label>
            </div>
            <label class="flex flex-col">
                <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">Description</p>
                <textarea
                    class="form-textarea flex w-full min-w-0 flex-1 resize-y overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary min-h-32 placeholder:text-gray-400 p-4 text-base font-normal"
                    placeholder="Tell us about yourself..."></textarea>
            </label>
            <div>
                <h2
                    class="text-gray-800 dark:text-gray-200 text-lg font-bold leading-tight tracking-[-0.015em] text-left pb-2">
                    Logo
                </h2>

                <div class="flex items-center justify-center w-full">
                    <label
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-[#D1D5DB] dark:border-gray-700 border-dashed rounded-xl cursor-pointer bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                        for="logo">

                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <span class="material-symbols-outlined text-gray-500 dark:text-gray-400"
                                style="font-size: 48px;">cloud_upload</span>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                <span class="font-semibold">Click to upload</span> or drag and drop
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or GIF (MAX. 2MB)</p>
                        </div>

                    </label>
                    <input id="logo" class="hidden" name="logo" type="file" accept="image/*" />
                </div>

            </div>
        </section>
        <!-- Work Experience Section -->
        <section
            class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/50 p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]">
                    Experience
                </h2>
                <button
                    class="flex items-center gap-2 min-w-[84px] cursor-pointer justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary/90 text-sm font-bold leading-normal transition-colors hover:bg-primary/20 dark:hover:bg-primary/30">
                    <span class="material-symbols-outlined text-base">add</span>
                    <span>Add Experience</span>
                </button>
            </div>
            <div class="flex flex-col gap-4">
                <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">Senior Product Designer</p>
                            <p class="text-gray-600 dark:text-gray-400">Stripe</p>
                            <p class="text-sm text-gray-500 dark:text-gray-500">Jan 2022 - Present</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button
                                class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800"><span
                                    class="material-symbols-outlined text-base">edit</span></button>
                            <button
                                class="p-2 text-gray-500 dark:text-gray-400 hover:text-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900/30"><span
                                    class="material-symbols-outlined text-base">delete</span></button>
                        </div>
                    </div>
                </div>
                <!-- Empty State Example -->
                <div
                    class="flex flex-col items-center justify-center gap-2 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-700 p-8 text-center">
                    <p class="text-gray-600 dark:text-gray-400">No work experience added yet.</p>
                    <button
                        class="mt-2 flex items-center gap-2 min-w-[84px] cursor-pointer justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary/90 text-sm font-bold leading-normal transition-colors hover:bg-primary/20 dark:hover:bg-primary/30">
                        <span class="material-symbols-outlined text-base">add</span>
                        <span>Add New Experience</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <label class="flex flex-col col-span-1">
                        <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">Company
                        </p>
                        <input
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4 py-2 text-base font-normal"
                            value="Company name" />
                    </label>
                    <label class="flex flex-col col-span-1">
                        <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">Brief</p>
                        <input
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4 py-2 text-base font-normal"
                            placeholder="e.g. Senior Product Designer" />
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <label class="flex flex-col col-span-1">
                        <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">Start Date
                        </p>
                        <input type="date"
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4 py-2 text-base font-normal"
                            value="Jane Doe" />
                    </label>
                    <label class="flex flex-col col-span-1">
                        <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">End date
                        </p>
                        <input type="date"
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4 py-2 text-base font-normal"
                            placeholder="e.g. Senior Product Designer" />
                    </label>
                </div>
            </div>
        </section>
        <!-- Skills Section -->
        <section
            class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/50 p-6 shadow-sm">
            <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]">Skills
            </h2>
            <div class="relative">
                <span
                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-xl">search</span>
                <input
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 pl-10 pr-4 py-2 text-base"
                    placeholder="Search and add skills..." />
            </div>
            <div class="flex flex-wrap gap-2 pt-2">
                <span
                    class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 dark:bg-primary/20 px-3 py-1 text-sm font-medium text-primary dark:text-primary/90">
                    Figma
                    <button class="p-0.5 rounded-full hover:bg-primary/20 dark:hover:bg-primary/30"><span
                            class="material-symbols-outlined text-xs">close</span></button>
                </span>
                <span
                    class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 dark:bg-primary/20 px-3 py-1 text-sm font-medium text-primary dark:text-primary/90">
                    UI/UX Design
                    <button class="p-0.5 rounded-full hover:bg-primary/20 dark:hover:bg-primary/30"><span
                            class="material-symbols-outlined text-xs">close</span></button>
                </span>
                <span
                    class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 dark:bg-primary/20 px-3 py-1 text-sm font-medium text-primary dark:text-primary/90">
                    Prototyping
                    <button class="p-0.5 rounded-full hover:bg-primary/20 dark:hover:bg-primary/30"><span
                            class="material-symbols-outlined text-xs">close</span></button>
                </span>
                <span
                    class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 dark:bg-blue-900/30 px-3 py-1 text-sm font-medium text-blue-800 dark:text-blue-300">
                    Tailwind CSS
                    <button class="p-0.5 rounded-full hover:bg-blue-200 dark:hover:bg-blue-900/50"><span
                            class="material-symbols-outlined text-xs">close</span></button>
                </span>
            </div>
        </section>
        <!-- Projects Section -->
        <section
            class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/50 p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]">
                    Projects
                </h2>
                <button
                    class="flex items-center gap-2 min-w-[84px] cursor-pointer justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary/90 text-sm font-bold leading-normal transition-colors hover:bg-primary/20 dark:hover:bg-primary/30">
                    <span class="material-symbols-outlined text-base">add</span>
                    <span>Add Project</span>
                </button>
            </div>
            <div class="flex flex-col gap-4">
                <details class="group rounded-lg border border-gray-200 dark:border-gray-700 p-4" open="">
                    <summary class="flex cursor-pointer list-none items-center justify-between">
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">Portfolio Builder SaaS</p>
                            <p class="text-sm text-gray-500 dark:text-gray-500">A platform to create stunning
                                portfolios.
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button
                                class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800"><span
                                    class="material-symbols-outlined text-base">edit</span></button>
                            <button
                                class="p-2 text-gray-500 dark:text-gray-400 hover:text-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900/30"><span
                                    class="material-symbols-outlined text-base">delete</span></button>
                            <span
                                class="material-symbols-outlined text-gray-500 transition-transform group-open:rotate-180">expand_more</span>
                        </div>
                    </summary>
                    <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                        <!-- Project Title (Full Width) -->
                        <label class="flex flex-col col-span-full mb-6">
                            <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">
                                Project Title
                            </p>
                            <input type="text" name="project_title" placeholder="Enter project title..."
                                class="form-input w-full rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4" />
                        </label>

                        <!-- Two-column layout -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Description -->
                            <label class="flex flex-col">

                                <textarea name="project_description" placeholder="Tell us about the project..."
                                    class="form-textarea flex w-full min-w-0 flex-1 resize-y overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary min-h-32 placeholder:text-gray-400 p-4 text-base font-normal"></textarea>
                            </label>
                            <!-- Project Thumbnail Upload -->
                            <label
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-xl cursor-pointer bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                                for="project_thumbnail">

                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 text-5xl">
                                        cloud_upload
                                    </span>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold">Click to upload</span> or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        PNG, JPG or GIF (MAX. 2MB)
                                    </p>
                                </div>
                            </label>
                            <input id="project_thumbnail" class="hidden" name="project_thumbnail" type="file"
                                accept="image/*" />

                        </div>

                        <label class="flex flex-col  col-span-full pt-6">
                            <p class="text-gray-800 dark:text-gray-200 text-sm font-medium pb-2">Project link</p>
                            <input type="url" name="project_link" placeholder="https://example.com"
                                class="form-input w-full rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4" />
                        </label>

                        <label class="flex flex-col  col-span-full pt-6">
                            <p class="text-gray-800 dark:text-gray-200 text-sm font-medium pb-2">Skills used</p>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-xl">search</span>
                                <input
                                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 pl-10 pr-4 py-2 text-base"
                                    placeholder="Search and add skills..." />
                            </div>
                            <div class="flex flex-wrap gap-2 pt-2">
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 dark:bg-primary/20 px-3 py-1 text-sm font-medium text-primary dark:text-primary/90">
                                    Figma
                                    <button
                                        class="p-0.5 rounded-full hover:bg-primary/20 dark:hover:bg-primary/30"><span
                                            class="material-symbols-outlined text-xs">close</span></button>
                                </span>
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 dark:bg-primary/20 px-3 py-1 text-sm font-medium text-primary dark:text-primary/90">
                                    UI/UX Design
                                    <button
                                        class="p-0.5 rounded-full hover:bg-primary/20 dark:hover:bg-primary/30"><span
                                            class="material-symbols-outlined text-xs">close</span></button>
                                </span>
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 dark:bg-primary/20 px-3 py-1 text-sm font-medium text-primary dark:text-primary/90">
                                    Prototyping
                                    <button
                                        class="p-0.5 rounded-full hover:bg-primary/20 dark:hover:bg-primary/30"><span
                                            class="material-symbols-outlined text-xs">close</span></button>
                                </span>
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 dark:bg-blue-900/30 px-3 py-1 text-sm font-medium text-blue-800 dark:text-blue-300">
                                    Tailwind CSS
                                    <button
                                        class="p-0.5 rounded-full hover:bg-blue-200 dark:hover:bg-blue-900/50"><span
                                            class="material-symbols-outlined text-xs">close</span></button>
                                </span>
                            </div>
                        </label>
                    </div>

                </details>
            </div>
        </section>
        <!-- Contact Section -->
        <section
            class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/50 p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]">
                    Contact
                </h2>
                <button
                    class="flex items-center gap-2 min-w-[84px] cursor-pointer justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary/90 text-sm font-bold leading-normal transition-colors hover:bg-primary/20 dark:hover:bg-primary/30">
                    <span class="material-symbols-outlined text-base">add</span>
                    <span>Add Contact Method</span>
                </button>
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-4">
                    <svg aria-hidden="true" class="size-6 text-gray-500" fill="currentColor" viewbox="0 0 24 24">
                        <path clip-rule="evenodd"
                            d="M12 2C6.477 2 2 6.477 2 12c0 4.286 2.866 7.91 6.837 9.19.5.092.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.031-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.001 10.001 0 0022 12c0-5.523-4.477-10-10-10z"
                            fill-rule="evenodd"></path>
                    </svg>
                    <span class="w-24 font-medium text-gray-800 dark:text-gray-200">GitHub</span>
                    <input
                        class="form-input flex w-full min-w-0 flex-1 rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4"
                        value="janedoe" />
                    <button
                        class="p-2 text-gray-500 dark:text-gray-400 hover:text-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900/30"><span
                            class="material-symbols-outlined text-base">delete</span></button>
                </div>
                <div class="flex items-center gap-4">
                    <svg aria-hidden="true" class="size-6 text-gray-500" fill="currentColor" viewbox="0 0 24 24">
                        <path
                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z">
                        </path>
                    </svg>
                    <span class="w-24 font-medium text-gray-800 dark:text-gray-200">LinkedIn</span>
                    <input
                        class="form-input flex w-full min-w-0 flex-1 rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4"
                        placeholder="Your LinkedIn profile handle" />
                    <button
                        class="p-2 text-gray-500 dark:text-gray-400 hover:text-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900/30"><span
                            class="material-symbols-outlined text-base">delete</span></button>
                </div>
            </div>
        </section>
        {{-- education section  --}}

        <!-- Work Experience Section -->
        <section
            class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/50 p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]">
                    Education
                </h2>
                <button
                    class="flex items-center gap-2 min-w-[84px] cursor-pointer justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary/90 text-sm font-bold leading-normal transition-colors hover:bg-primary/20 dark:hover:bg-primary/30">
                    <span class="material-symbols-outlined text-base">add</span>
                    <span>Add Education</span>
                </button>
            </div>
            <div class="flex flex-col gap-4">
                <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">B.Sc ENG</p>
                            <p class="text-gray-600 dark:text-gray-400">UNIversuity of colorado</p>
                            <p class="text-sm text-gray-500 dark:text-gray-500">Jan 2022 - Present</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button
                                class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800"><span
                                    class="material-symbols-outlined text-base">edit</span></button>
                            <button
                                class="p-2 text-gray-500 dark:text-gray-400 hover:text-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900/30"><span
                                    class="material-symbols-outlined text-base">delete</span></button>
                        </div>
                    </div>
                </div>
                <!-- Empty State Example -->
                <div
                    class="flex flex-col items-center justify-center gap-2 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-700 p-8 text-center">
                    <p class="text-gray-600 dark:text-gray-400">No Education added yet.</p>
                    <button
                        class="mt-2 flex items-center gap-2 min-w-[84px] cursor-pointer justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary/90 text-sm font-bold leading-normal transition-colors hover:bg-primary/20 dark:hover:bg-primary/30">
                        <span class="material-symbols-outlined text-base">add</span>
                        <span>Add Education</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <label class="flex flex-col col-span-1">
                        <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">School
                        </p>
                        <input
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4 py-2 text-base font-normal"
                            value="Company name" />
                    </label>
                    <label class="flex flex-col col-span-1">
                        <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">Course
                        </p>
                        <input
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4 py-2 text-base font-normal"
                            placeholder="e.g. Senior Product Designer" />
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <label class="flex flex-col col-span-1">
                        <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">Admission
                            Date</p>
                        <input type="date"
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4 py-2 text-base font-normal"
                            value="Jane Doe" />
                    </label>
                    <label class="flex flex-col col-span-1">
                        <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">
                            Graduation Date</p>
                        <input type="date"
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4 py-2 text-base font-normal"
                            placeholder="e.g. Senior Product Designer" />
                    </label>
                </div>
            </div>
        </section>
    </div>
</x-layouts.app>
