<section
    class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/50 p-6 shadow-sm">
    <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]">Experience</h2>

    <div class="flex flex-col gap-4">
        @foreach ($experiences as $index => $experience)
            <div
                class="border border-gray-200 dark:border-gray-800 rounded-xl p-4 bg-white dark:bg-gray-900/50 shadow-sm">
                <!-- Collapsed View -->
                @if ($editingExperienceIndex !== $index)
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-gray-900 dark:text-white font-semibold">
                                {{ $experience['position'] ?? 'Untitled Position' }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">
                                {{ $experience['company'] ?? '' }} — {{ $experience['start_date']->format('d M Y') ?? '' }}
                                @if (!empty($experience['end_date']))
                                    to {{ $experience['end_date']->format('d M Y') }}
                                @endif
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button type="button" wire:click="editExperience({{ $index }})"
                                class="flex items-center gap-1 text-primary hover:text-primary/80 text-sm font-medium">
                                <span class="material-symbols-outlined text-base">edit</span>
                                Edit
                            </button>
                            <button type="button" wire:click="deleteExperience({{ $index }})"
                                class="flex items-center gap-1 text-red-500 hover:text-red-400 text-sm font-medium">
                                <span class="material-symbols-outlined text-base">delete</span>
                                Delete
                            </button>
                        </div>
                    </div>
                    @if (!empty($experience['description']))
                        <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">
                            {{ $experience['description'] }}
                        </p>
                    @endif
                @endif

                <!-- Edit Form -->
                @if ($editingExperienceIndex === $index)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Company</label>
                            <input type="text" wire:model="experienceForm.company"
                                class="rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                            @error('experienceForm.company')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Position</label>
                            <input type="text" wire:model="experienceForm.position"
                                class="rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                            @error('experienceForm.position')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
                            <input type="date" wire:model="experienceForm.start_date"
                                class="rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                            @error('experienceForm.start_date')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
                            <input type="date" wire:model="experienceForm.end_date"
                                class="rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                            @error('experienceForm.end_date')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="md:col-span-2 flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea wire:model="experienceForm.description" rows="3"
                                class="rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary"></textarea>
                            @error('experienceForm.description')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" wire:click="cancelEditExperience"
                            class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-medium">
                            Cancel
                        </button>
                        <button type="button" wire:click="saveExperience"
                            class="px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary/90 text-sm font-semibold">
                            Save
                        </button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Add New Experience -->
    @if ($editingExperienceIndex === 'new')
        <div class="border border-gray-200 dark:border-gray-800 rounded-xl p-4 bg-gray-50 dark:bg-gray-900/40 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Company</label>
                    <input type="text" wire:model="experienceForm.company"
                        class="rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                    @error('experienceForm.company')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Position</label>
                    <input type="text" wire:model="experienceForm.position"
                        class="rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                    @error('experienceForm.position')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
                    <input type="date" wire:model="experienceForm.start_date"
                        class="rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                    @error('experienceForm.start_date')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
                    <input type="date" wire:model="experienceForm.end_date"
                        class="rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                    @error('experienceForm.end_date')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="md:col-span-2 flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea wire:model="experienceForm.description" rows="3"
                        class="rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary"></textarea>
                    @error('experienceForm.description')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button"  wire:click="cancelEditExperience"
                    class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-medium">
                    Cancel
                </button>
                <button type="button"  wire:click="saveExperience"
                    class="px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary/90 text-sm font-semibold">
                    Save
                </button>
            </div>
        </div>
    @endif

    @if ($editingExperienceIndex !== 'new')
        <button type="button"  wire:click="addExperience"
            class="mt-2 flex items-center gap-2 min-w-[84px] cursor-pointer justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary/90 text-sm font-bold leading-normal transition-colors hover:bg-primary/20 dark:hover:bg-primary/30">
            <span class="material-symbols-outlined text-base">add</span>
            <span>Add New Experience</span>
        </button>
    @endif
</section>
