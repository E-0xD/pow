<section class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/50 p-6 shadow-sm">
    <div class="flex justify-between items-center">
        <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]">
            About
        </h2>

        <div class="flex items-center gap-3">
            @if ($about['name'])
                <button type="button" wire:click="toggleCollapse"
                    class="flex items-center gap-1 text-primary text-sm font-semibold hover:underline">
                    <span class="material-symbols-outlined text-base">edit</span>
                    {{ $about['collapsed'] ? 'Edit' : 'Collapse' }}
                </button>
                <button type="button" wire:click="deleteAbout"
                    class="flex items-center gap-1 text-red-500 text-sm font-semibold hover:underline">
                    <span class="material-symbols-outlined text-base">delete</span> Delete
                </button>
            @endif
        </div>
    </div>

    @if ($about['collapsed'] && $about['name'])
        <div class="flex flex-col md:flex-row items-start md:items-center gap-6 border-t border-gray-200 dark:border-gray-700 pt-4">
            @if ($about['logo'])
                <img src="{{ Str::startsWith($about['logo'], 'http') ? $about['logo'] : Storage::url($about['logo']) }}"
                    alt="Logo" class="w-20 h-20 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
            @endif
            <div class="flex flex-col">
                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $about['name'] }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $about['brief'] }}</p>
                <p class="mt-2 text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                    {{ $about['description'] }}
                </p>
            </div>
        </div>
    @else
        <!-- Expanded Edit Form -->
        <div class="flex flex-col gap-4 mt-4">
            <!-- Name + Brief -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <label class="flex flex-col">
                    <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">Name</p>
                    <input wire:model="about.name" placeholder="Jane Doe"
                        class="form-input flex w-full rounded-lg h-12 px-4 py-2 text-base font-normal text-gray-900 dark:text-gray-100 border
                        @error('about.name') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-700 @enderror
                        bg-background-light dark:bg-background-dark focus:outline-none focus:ring-2 focus:ring-primary/50" />
                    @error('about.name') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
                </label>

                <label class="flex flex-col">
                    <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">Brief</p>
                    <input wire:model="about.brief" placeholder="e.g. Senior Product Designer"
                        class="form-input flex w-full rounded-lg h-12 px-4 py-2 text-base font-normal text-gray-900 dark:text-gray-100 border
                        @error('about.brief') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-700 @enderror
                        bg-background-light dark:bg-background-dark focus:outline-none focus:ring-2 focus:ring-primary/50" />
                    @error('about.brief') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
                </label>
            </div>

            <!-- Description -->
            <label class="flex flex-col">
                <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">Description</p>
                <textarea wire:model="about.description" placeholder="Tell us about yourself..."
                    class="form-textarea flex w-full min-w-0 resize-y overflow-hidden rounded-lg text-gray-900 dark:text-gray-100
                    border @error('about.description') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-700 @enderror
                    bg-background-light dark:bg-background-dark min-h-32 p-4 text-base font-normal
                    focus:outline-none focus:ring-2 focus:ring-primary/50"></textarea>
                @error('about.description') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
            </label>

            <!-- Logo Upload -->
            <div>
                <h2 class="text-gray-800 dark:text-gray-200 text-lg font-bold leading-tight tracking-[-0.015em] pb-2">Logo</h2>

                <div class="flex items-center justify-center w-full">
                    <label for="logo"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-xl cursor-pointer
                        @error('about.logo') border-red-500 @else border-[#D1D5DB] dark:border-gray-700 @enderror
                        bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 text-5xl">cloud_upload</span>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                <span class="font-semibold">Click to upload</span> or drag and drop
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or GIF (MAX. 1MB)</p>
                        </div>
                    </label>
                    <input id="logo" wire:model="about.logo" class="hidden" name="logo" type="file" accept="image/*" />
                </div>

                @error('about.logo')
                    <span class="text-sm text-red-500 mt-2 block">{{ $message }}</span>
                @enderror

                @if ($about['logo'] instanceof \Livewire\TemporaryUploadedFile)
                    <div class="mt-4">
                        <img src="{{ $about['logo']->temporaryUrl() }}" alt="Logo Preview"
                            class="w-32 h-32 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                    </div>
                @elseif ($about['logo'])
                    <div class="mt-4">
                        <img src="{{ Storage::url($about['logo']) }}" alt="Current Logo"
                            class="w-32 h-32 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                    </div>
                @endif
            </div>

            <div class="flex justify-end mt-4">
                <button type="button" wire:click="save"
                    class="px-6 py-2 bg-primary/10 text-primary font-bold rounded-lg hover:bg-primary/20 transition-colors">
                    Save
                </button>
            </div>
        </div>
    @endif
</section>
