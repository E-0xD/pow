<section
            class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/50 p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]">
                    Projects
                </h2>
                <button
                    wire:click="addProject"
                    class="flex items-center gap-2 min-w-[84px] cursor-pointer justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary/90 text-sm font-bold leading-normal transition-colors hover:bg-primary/20 dark:hover:bg-primary/30">
                    <span class="material-symbols-outlined text-base">add</span>
                    <span>Add Project</span>
                </button>
            </div>
            <div class="flex flex-col gap-4">
                @foreach($projects as $index => $project)
                <details class="group rounded-lg border border-gray-200 dark:border-gray-700 p-4" open="">
                    <summary class="flex cursor-pointer list-none items-center justify-between">
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $project['title'] }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-500">{{ $project['brief_description'] }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button
                                class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800"><span
                                    class="material-symbols-outlined text-base">edit</span></button>
                            <button
                                wire:click="removeProject({{ $index }})"
                                class="p-2 text-gray-500 dark:text-gray-400 hover:text-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900/30"><span
                                    class="material-symbols-outlined text-base">delete</span></button>
                            <span
                                class="material-symbols-outlined text-gray-500 transition-transform group-open:rotate-180">expand_more</span>
                        </div>
                    </summary>
                    @endforeach
                    <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                        <!-- Project Title (Full Width) -->
                        <label class="flex flex-col col-span-full mb-6">
                            <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">
                                Project Title
                            </p>
                            <input type="text" 
                                wire:model="projects.{{ $index }}.title"
                                placeholder="Enter project title..."
                                class="form-input w-full rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4" />
                        </label>

                        <!-- Two-column layout -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Description -->
                            <label class="flex flex-col">

                                <textarea 
                                    wire:model="projects.{{ $index }}.description"
                                    placeholder="Tell us about the project..."
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
                            <input id="project_thumbnail" 
                                wire:model="projects.{{ $index }}.thumbnail"
                                class="hidden" 
                                type="file"
                                accept="image/*" />

                        </div>

                        <label class="flex flex-col  col-span-full pt-6">
                            <p class="text-gray-800 dark:text-gray-200 text-sm font-medium pb-2">Project link</p>
                            <input type="url" 
                                wire:model="projects.{{ $index }}.link"
                                placeholder="https://example.com"
                                class="form-input w-full rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4" />
                        </label>

                        <label class="flex flex-col  col-span-full pt-6">
                            <p class="text-gray-800 dark:text-gray-200 text-sm font-medium pb-2">Skills used</p>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-xl">search</span>
                                <input
                                    wire:model.lazy="projectSkillSearch.{{ $index }}"
                                    wire:keydown.enter="addProjectSkill({{ $index }})"
                                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 pl-10 pr-4 py-2 text-base"
                                    placeholder="Search and add skills..." />
                            </div>
                            <div class="flex flex-wrap gap-2 pt-2">
                                @foreach($project['skills'] ?? [] as $skillIndex => $skill)
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 dark:bg-primary/20 px-3 py-1 text-sm font-medium text-primary dark:text-primary/90">
                                    {{ $skill }}
                                    <button
                                        wire:click="removeProjectSkill({{ $index }}, {{ $skillIndex }})"
                                        class="p-0.5 rounded-full hover:bg-primary/20 dark:hover:bg-primary/30"><span
                                            class="material-symbols-outlined text-xs">close</span></button>
                                </span>
                                @endforeach
                            </div>
                        </label>
                    </div>

                </details>
            </div>
        </section>