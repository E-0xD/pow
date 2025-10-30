<section
    class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/50 p-6 shadow-sm">
    <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]">Projects</h2>

    <div class="flex flex-col gap-4">
        @foreach ($projects as $index => $proj)
            <div
                class="border border-gray-200 dark:border-gray-800 rounded-xl p-4 bg-white dark:bg-gray-900/50 shadow-sm">
                <!-- Collapsed View -->
                @if ($editingProjectIndex !== $index)
                    <div class="flex items-center gap-3">
                        @if (!empty($proj['thumbnail_path']) && is_string($proj['thumbnail_path']))
                            <img src="{{ Storage::url($proj['thumbnail_path']) }}"
                                class="w-16 h-16 rounded-lg object-cover border border-gray-200 dark:border-gray-700" />
                        @endif
                        <div class="flex justify-between items-center flex-1">
                            <div>
                                <h3 class="text-gray-900 dark:text-white font-semibold">
                                    {{ $proj['title'] ?? 'Untitled Project' }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                    {{ $proj['project_link'] ?? '' }}
                                </p>

                                @if (!empty($proj['brief_description']))
                                    <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">
                                        {{ $proj['brief_description'] }}
                                    </p>
                                @endif
                            </div>
                            <div class="flex items-center gap-2">
                                <button type="button" wire:click="editProject({{ $index }})"
                                    class="flex items-center gap-1 text-primary hover:text-primary/80 text-sm font-medium">
                                    <span class="material-symbols-outlined text-base">edit</span>
                                    Edit
                                </button>
                                <button type="button" wire:click="deleteProject({{ $index }})"
                                    class="flex items-center gap-1 text-red-500 hover:text-red-400 text-sm font-medium">
                                    <span class="material-symbols-outlined text-base">delete</span>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Edit Form -->
                @if ($editingProjectIndex === $index)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <!-- Project Title -->
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Project Title</label>
                            <input type="text" wire:model="projectForm.title"
                                class="rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                            @error('projectForm.title')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Project Link -->
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Project Link</label>
                            <input type="url" wire:model="projectForm.project_link"
                                placeholder="https://example.com"
                                class="rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                            @error('projectForm.project_link')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Thumbnail -->
                        <div class="flex flex-col gap-2 md:col-span-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Thumbnail</label>
                            <input type="file" wire:model="projectForm.thumbnail_path"
                                class="rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                            @if (isset($projectForm['thumbnail_path']) && is_string($projectForm['thumbnail_path']))
                                <img src="{{ Storage::url($projectForm['thumbnail_path']) }}"
                                    class="w-32 h-24 rounded-lg mt-2 object-cover border border-gray-200 dark:border-gray-700" />
                            @endif
                            @error('projectForm.thumbnail_path')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="flex flex-col gap-2 md:col-span-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Brief
                                Description</label>
                            <textarea wire:model="projectForm.brief_description" rows="3"
                                class="rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary"></textarea>
                            @error('projectForm.brief_description')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Skills -->
                        <div class="flex flex-col gap-2 md:col-span-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Skills</label>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($availableSkills as $skill)
                                    <label class="flex items-center gap-2 text-sm">
                                        <input type="checkbox" wire:model="projectForm.skills"
                                            value="{{ $skill->id }}"
                                            class="rounded text-primary focus:ring-primary">
                                        <span class="text-gray-700 dark:text-gray-300">{{ $skill->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('projectForm.skills')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" wire:click="cancelEditProject"
                            class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-medium">
                            Cancel
                        </button>
                        <button type="button" wire:click="saveProject"
                            class="px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary/90 text-sm font-semibold">
                            Save
                        </button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Add New Project -->
    @if ($editingProjectIndex === 'new')
        <div
            class="border border-gray-200 dark:border-gray-800 rounded-xl p-4 bg-gray-50 dark:bg-gray-900/40 shadow-sm mt-2">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Project Title</label>
                    <input type="text" wire:model="projectForm.title"
                        class="rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                    @error('projectForm.title')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Project Link</label>
                    <input type="url" wire:model="projectForm.project_link" placeholder="https://example.com"
                        class="rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                    @error('projectForm.project_link')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2 md:col-span-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Brief Description</label>
                    <textarea wire:model="projectForm.brief_description" rows="3"
                        class="rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary"></textarea>
                    @error('projectForm.brief_description')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2 md:col-span-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Thumbnail</label>
                    <input type="file" wire:model="projectForm.thumbnail_path"
                        class="rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                    @error('projectForm.thumbnail_path')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2 md:col-span-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Skills</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach ($availableSkills as $skill)
                            <label class="flex items-center gap-2 text-sm">
                                <input type="checkbox" wire:model="projectForm.skills" value="{{ $skill->id }}"
                                    class="rounded text-primary focus:ring-primary">
                                <span class="text-gray-700 dark:text-gray-300">{{ $skill->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('projectForm.skills')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" wire:click="cancelEditProject"
                    class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-medium">
                    Cancel
                </button>
                <button type="button" wire:click="saveProject"
                    class="px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary/90 text-sm font-semibold">
                    Save
                </button>
            </div>
        </div>
    @endif

    @if ($editingProjectIndex !== 'new')
        <button type="button" wire:click="addProject"
            class="mt-2 flex items-center gap-2 min-w-[84px] cursor-pointer justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary/90 text-sm font-bold leading-normal transition-colors hover:bg-primary/20 dark:hover:bg-primary/30">
            <span class="material-symbols-outlined text-base">add</span>
            <span>Add New Project</span>
        </button>
    @endif
</section>
