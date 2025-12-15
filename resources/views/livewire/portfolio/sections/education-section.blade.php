<section
    class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/50 p-6 shadow-sm">
    <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]">Education</h2>

    <div class="flex flex-col gap-4">
        @foreach ($education as $index => $edu)
            <div
                class="border border-gray-200 dark:border-gray-800 rounded-xl p-4 bg-white dark:bg-gray-900/50 shadow-sm">
                <!-- Collapsed View -->
                @if ($editingEducationIndex !== $index)
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-gray-900 dark:text-white font-semibold">
                                {{ $edu['degree'] ?? 'Untitled Degree' }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">
                                {{ $edu['school'] ?? '' }} —
                                {{ $edu['year_of_admission'] ?? '' }}
                                @if (!empty($edu['year_of_graduation']))
                                    to {{ $edu['year_of_graduation'] }}
                                @endif
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button type="button" wire:click="editEducation({{ $index }})"
                                class="flex items-center gap-1 text-primary hover:text-primary/80 text-sm font-medium">
                                <span class="material-symbols-outlined text-base">edit</span>
                                <span class="hidden lg:inline">Edit</span>
                            </button>
                            <button type="button" wire:click="deleteEducation({{ $index }})"
                                class="flex items-center gap-1 text-red-500 hover:text-red-400 text-sm font-medium">
                                <span class="material-symbols-outlined text-base">delete</span>
                                <span class="hidden lg:inline">Delete</span>
                            </button>
                        </div>

                    </div>
                    @if (!empty($edu['description']))
                        <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">
                            {{ $edu['description'] }}
                        </p>
                    @endif
                @endif

                <!-- Edit Form -->
                @if ($editingEducationIndex === $index)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">School</label>
                            <input type="text" wire:model="educationForm.school"
                                class="rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                            @error('educationForm.school')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Degree</label>
                            <input type="text" wire:model="educationForm.degree"
                                class="rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                            @error('educationForm.degree')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Year of
                                Admission</label>
                            <input type="number" wire:model="educationForm.year_of_admission" placeholder="Example : 2000"
                                class="rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                            @error('educationForm.year_of_admission')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Year of
                                Graduation</label>
                            <input type="number" wire:model="educationForm.year_of_graduation" placeholder="Example : {{date('Y')}}"
                                class="rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                            @error('educationForm.year_of_graduation')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" wire:click="cancelEditEducation"
                            class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-medium">
                            Cancel
                        </button>
                        <button type="button" wire:click="saveEducation"
                            class="px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary/90 text-sm font-semibold">
                            Save
                        </button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Add New Education -->
    @if ($editingEducationIndex === 'new')
        <div
            class="border border-gray-200 dark:border-gray-800 rounded-xl p-4 bg-gray-50 dark:bg-gray-900/40 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">School</label>
                    <input type="text" wire:model="educationForm.school"
                        class="rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                    @error('educationForm.school')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Degree</label>
                    <input type="text" wire:model="educationForm.degree"
                        class="rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                    @error('educationForm.degree')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Year of Admission</label>
                    <input type="number" wire:model="educationForm.year_of_admission" placeholder="Example : 2000"
                        class="rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                    @error('educationForm.year_of_admission')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Year of Graduation</label>
                    <input type="number" wire:model="educationForm.year_of_graduation" placeholder="Example : {{date('Y')}}"
                        class="rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary focus:border-primary">
                    @error('educationForm.year_of_graduation')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" wire:click="cancelEditEducation"
                    class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-medium">
                    Cancel
                </button>
                <button type="button" wire:click="saveEducation"
                    class="px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary/90 text-sm font-semibold">
                    Save
                </button>
            </div>
        </div>
    @endif

    @if ($editingEducationIndex !== 'new')
        <button type="button" wire:click="addEducation"
            class="mt-2 flex items-center gap-2 min-w-[84px] cursor-pointer justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary/90 text-sm font-bold leading-normal transition-colors hover:bg-primary/20 dark:hover:bg-primary/30">
            <span class="material-symbols-outlined text-base">add</span>
            <span>Add New Education</span>
        </button>
    @endif
</section>
