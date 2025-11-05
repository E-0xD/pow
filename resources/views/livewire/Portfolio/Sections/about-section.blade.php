<section
    class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/50 p-4 sm:p-6 shadow-sm">

    <!-- Header -->
    <div class="flex justify-between items-center">
        <!-- Title -->
        <h2 class="text-gray-900 dark:text-white text-xl sm:text-[22px] font-bold leading-tight tracking-[-0.015em]">
            About
        </h2>

        <!-- Action buttons -->
        <div class="flex items-center gap-2 sm:gap-3">
            @if ($about['name'])
                <!-- Edit Button -->
                <button type="button" wire:click="toggleCollapse"
                    class="flex items-center gap-1 text-primary text-sm font-semibold hover:underline">
                    <span class="material-symbols-outlined text-base sm:text-[18px]">edit</span>
                    <span class="hidden md:inline">{{ $about['collapsed'] ? 'Edit' : 'Collapse' }}</span>
                </button>

                <!-- Delete Button -->
                <button type="button" wire:click="deleteAbout"
                    class="flex items-center gap-1 text-red-500 text-sm font-semibold hover:underline">
                    <span class="material-symbols-outlined text-base sm:text-[18px]">delete</span>
                    <span class="hidden md:inline">Delete</span>
                </button>
            @endif
        </div>
    </div>

    <!-- Collapsed View -->
    @if ($about['collapsed'] && $about['name'])
        <div
            class="flex flex-row items-start sm:items-center gap-4 sm:gap-6 border-t border-gray-200 dark:border-gray-700 pt-4">

            @if ($about['logo'])
                <img src="{{ Str::startsWith($about['logo'], 'http') ? $about['logo'] : Storage::url($about['logo']) }}"
                    alt="Logo"
                    class="w-14 h-14 sm:w-20 sm:h-20 object-cover rounded-lg border border-gray-200 dark:border-gray-700 shrink-0">
            @endif

            <div class="min-w-0 max-w-[150px] sm:max-w-[150px] lg:max-w-none">
                <!-- Name -->
                <p
                    class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white overflow-hidden text-ellipsis whitespace-nowrap lg:whitespace-normal">
                    {{ $about['name'] }}
                </p>

                <!-- Brief -->
                <p
                    class="text-sm text-gray-500 dark:text-gray-400 overflow-hidden text-ellipsis whitespace-nowrap lg:whitespace-normal">
                    {{ $about['brief'] }}
                </p>

                <!-- Description -->
                <p
                    class="mt-1 text-gray-700 dark:text-gray-300 text-sm overflow-hidden text-ellipsis whitespace-nowrap lg:whitespace-normal">
                    {{ $about['description'] }}
                </p>
            </div>

        </div>

        <!-- Expanded Edit Form -->
    @else
        <div class="flex flex-col gap-4 mt-2 sm:mt-4">
            <!-- Name + Brief -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <label class="flex flex-col">
                    <p class="text-gray-800 dark:text-gray-200 text-base font-medium pb-2">Name</p>
                    <input wire:model="about.name" placeholder="Jane Doe"
                        class="form-input flex w-full rounded-lg h-11 sm:h-12 px-4 py-2 text-sm sm:text-base font-normal text-gray-900 dark:text-gray-100 border
                        @error('about.name') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-700 @enderror
                        bg-background-light dark:bg-background-dark focus:outline-none focus:ring-2 focus:ring-primary/50" />
                    @error('about.name')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </label>

                <label class="flex flex-col">
                    <p class="text-gray-800 dark:text-gray-200 text-base font-medium pb-2">Brief</p>
                    <input wire:model="about.brief" placeholder="e.g. Senior Product Designer"
                        class="form-input flex w-full rounded-lg h-11 sm:h-12 px-4 py-2 text-sm sm:text-base font-normal text-gray-900 dark:text-gray-100 border
                        @error('about.brief') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-700 @enderror
                        bg-background-light dark:bg-background-dark focus:outline-none focus:ring-2 focus:ring-primary/50" />
                    @error('about.brief')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </label>
            </div>

            <!-- Description -->
            <label class="flex flex-col">
                <p class="text-gray-800 dark:text-gray-200 text-base font-medium pb-2">Description</p>
                <textarea wire:model="about.description" placeholder="Tell us about yourself..."
                    class="form-textarea flex w-full resize-y overflow-hidden rounded-lg text-gray-900 dark:text-gray-100
                    border @error('about.description') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-700 @enderror
                    bg-background-light dark:bg-background-dark min-h-28 sm:min-h-32 p-3 sm:p-4 text-sm sm:text-base font-normal
                    focus:outline-none focus:ring-2 focus:ring-primary/50"></textarea>
                @error('about.description')
                    <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                @enderror
            </label>

            <!-- Logo Upload -->
            <div>
                <h2
                    class="text-gray-800 dark:text-gray-200 text-base sm:text-lg font-bold leading-tight tracking-[-0.015em] pb-2">
                    Profile Picture
                </h2>

                <x-layouts.app.image-uploader name="about.logo" model="about.logo" :old="$about['logo'] ?? null"
                    placeholder-icon="person" placeholder-text="Upload your profile picture" height="h-48 sm:h-64" />

                @error('about.logo')
                    <span class="text-sm text-red-500 mt-2 block">{{ $message }}</span>
                @enderror

            </div>

            <!-- Save Button -->
            <div class="flex justify-end mt-4">
                <button type="button" wire:click="save"
                    class="w-full sm:w-auto px-6 py-2 bg-primary/10 text-primary font-bold rounded-lg hover:bg-primary/20 transition-colors">
                    Save
                </button>
            </div>
        </div>
    @endif
</section>
