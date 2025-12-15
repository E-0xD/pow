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
                            <div class="min-w-0 max-w-[150px] sm:max-w-[150px] lg:max-w-none">
                                <h3
                                    class="text-gray-900 dark:text-white font-semibold overflow-hidden text-ellipsis whitespace-nowrap lg:whitespace-normal">
                                    {{ $proj['title'] ?? 'Untitled Project' }}
                                </h3>
                                <p
                                    class="text-gray-600 dark:text-gray-400 text-sm overflow-hidden text-ellipsis whitespace-nowrap lg:whitespace-normal">
                                    {{ $proj['project_link'] ?? '' }}
                                </p>

                                @if (!empty($proj['brief_description']))
                                    <p
                                        class="text-gray-700 dark:text-gray-300 text-sm mt-2 overflow-hidden text-ellipsis line-clamp-2 lg:line-clamp-none">
                                        {{ $proj['brief_description'] }}
                                    </p>
                                @endif
                            </div>

                            <div class="flex items-center gap-2 ml-3 shrink-0">
                                <button type="button" wire:click="editProject({{ $index }})"
                                    class="flex items-center gap-1 text-primary hover:text-primary/80 text-sm font-medium">
                                    <span class="material-symbols-outlined text-base">edit</span>
                                    <span class="hidden lg:inline">Edit</span>
                                </button>
                                <button type="button" wire:click="deleteProject({{ $index }})"
                                    class="flex items-center gap-1 text-red-500 hover:text-red-400 text-sm font-medium">
                                    <span class="material-symbols-outlined text-base">delete</span>
                                    <span class="hidden lg:inline">Delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Edit Form for existing project -->
                @if ($editingProjectIndex === $index)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
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
                            <input type="url" wire:model="projectForm.project_link"
                                placeholder="https://example.com"
                                class="rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                            @error('projectForm.project_link')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2 md:col-span-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Brief
                                Description</label>
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

                            <!-- Skill Search Input -->
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-xl">
                                    search
                                </span>
                                <input wire:model.live.debounce.300ms="projectSkillSearch"
                                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg 
                                           text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 
                                           border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 
                                           focus:border-primary h-10 placeholder:text-gray-400 pl-10 pr-4 py-2 text-sm"
                                    placeholder="Search and add skills..." />

                                <!-- Dropdown Results -->
                                @if (!empty($projectSkillSearchResults))
                                    <ul
                                        class="absolute z-10 mt-2 w-full bg-white dark:bg-gray-800 border border-gray-200 
                                               dark:border-gray-700 rounded-lg shadow-md max-h-60 overflow-y-auto">
                                        @foreach ($projectSkillSearchResults as $skill)
                                            <li wire:click="addProjectSkill({{ $skill['id'] }})"
                                                class="flex items-center gap-2 px-4 py-2 cursor-pointer hover:bg-gray-100 
                                                       dark:hover:bg-gray-700 transition">
                                                <span class="material-symbols-outlined text-primary text-base">
                                                    {!! $skill['logo'] !!}
                                                </span>
                                                <span
                                                    class="text-gray-900 dark:text-gray-100">{{ $skill['title'] }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <!-- Selected Skills Display -->
                            <div class="flex flex-wrap gap-2 pt-2">
                                @foreach ($projectForm['skills'] as $skillId)
                                    @php
                                        $skill = \App\Models\Skill::find($skillId);
                                    @endphp
                                    @if ($skill)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 dark:bg-primary/20 
                                                   px-3 py-1 text-sm font-medium text-primary dark:text-primary/90">
                                            <span
                                                class="material-symbols-outlined text-sm">{!! $skill->logo !!}</span>
                                            {{ $skill->title }}
                                            <button type="button" wire:click="removeProjectSkill({{ $skillId }})"
                                                class="p-0.5 rounded-full hover:bg-primary/20 dark:hover:bg-primary/30">
                                                <span class="material-symbols-outlined text-xs">close</span>
                                            </button>
                                        </span>
                                    @endif
                                @endforeach
                            </div>
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

                    <x-layouts.app.image-uploader name="projectForm.thumbnail_path" model="projectForm.thumbnail_path"
                        placeholder-icon="person" placeholder-text="Project Thumbnail" height="h-48 sm:h-64" />
                    @error('projectForm.thumbnail_path')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2 md:col-span-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Skills</label>

                    <!-- Skill Search Input -->
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-xl">
                            search
                        </span>
                        <input wire:model.live.debounce.300ms="projectSkillSearch"
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg 
                                   text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 
                                   border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 
                                   focus:border-primary h-10 placeholder:text-gray-400 pl-10 pr-4 py-2 text-sm"
                            placeholder="Search and add skills..." />

                        <!-- Dropdown Results -->
                        @if (!empty($projectSkillSearchResults))
                            <ul
                                class="absolute z-10 mt-2 w-full bg-white dark:bg-gray-800 border border-gray-200 
                                       dark:border-gray-700 rounded-lg shadow-md max-h-60 overflow-y-auto">
                                @foreach ($projectSkillSearchResults as $skill)
                                    <li wire:click="addProjectSkill({{ $skill['id'] }})"
                                        class="flex items-center gap-2 px-4 py-2 cursor-pointer hover:bg-gray-100 
                                               dark:hover:bg-gray-700 transition">
                                        <span class="material-symbols-outlined text-primary text-base">
                                            {!! $skill['logo'] !!}
                                        </span>
                                        <span class="text-gray-900 dark:text-gray-100">{{ $skill['title'] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <!-- Selected Skills Display -->
                    <div class="flex flex-wrap gap-2 pt-2">
                        @foreach ($projectForm['skills'] as $skillId)
                            @php
                                $skill = \App\Models\Skill::find($skillId);
                            @endphp
                            @if ($skill)
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 dark:bg-primary/20 
                                           px-3 py-1 text-sm font-medium text-primary dark:text-primary/90">
                                    <span class="material-symbols-outlined text-sm">{!! $skill->logo !!}</span>
                                    {{ $skill->title }}
                                    <button type="button" wire:click="removeProjectSkill({{ $skillId }})"
                                        class="p-0.5 rounded-full hover:bg-primary/20 dark:hover:bg-primary/30">
                                        <span class="material-symbols-outlined text-xs">close</span>
                                    </button>
                                </span>
                            @endif
                        @endforeach
                    </div>
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
