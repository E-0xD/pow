        <section
            class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/50 p-6 shadow-sm">
            <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]">About</h2>

            <!-- Name + Brief -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <label class="flex flex-col col-span-1">
                    <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">Name</p>
                    <input wire:model="about.name" placeholder="Jane Doe"
                        class="form-input flex w-full min-w-0 flex-1 rounded-lg text-gray-900 dark:text-gray-100
                        focus:outline-none focus:ring-2 focus:ring-primary/50
                        border @error('about.name') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-700 @enderror
                        bg-background-light dark:bg-background-dark h-12 placeholder:text-gray-400 px-4 py-2 text-base font-normal" />
                    @error('about.name')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </label>

                <!-- Brief -->
                <label class="flex flex-col col-span-1">
                    <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">Brief</p>
                    <input wire:model="about.brief" placeholder="e.g. Senior Product Designer"
                        class="form-input flex w-full min-w-0 flex-1 rounded-lg text-gray-900 dark:text-gray-100
                        focus:outline-none focus:ring-2 focus:ring-primary/50
                        border @error('about.brief') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-700 @enderror
                        bg-background-light dark:bg-background-dark h-12 placeholder:text-gray-400 px-4 py-2 text-base font-normal" />
                    @error('about.brief')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </label>
            </div>

            <!-- Description -->
            <label class="flex flex-col">
                <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">Description</p>
                <textarea wire:model="about.description" placeholder="Tell us about yourself..."
                    class="form-textarea flex w-full min-w-0 flex-1 resize-y overflow-hidden rounded-lg text-gray-900 dark:text-gray-100
                    focus:outline-none focus:ring-2 focus:ring-primary/50
                    border @error('about.description') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-700 @enderror
                    bg-background-light dark:bg-background-dark min-h-32 placeholder:text-gray-400 p-4 text-base font-normal"></textarea>
                @error('about.description')
                    <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                @enderror
            </label>

            <!-- Logo Upload -->
            <div>
                <h2 class="text-gray-800 dark:text-gray-200 text-lg font-bold leading-tight tracking-[-0.015em] text-left pb-2">
                    Logo
                </h2>

                <div class="flex items-center justify-center w-full">
                    <label
                        for="logo"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-xl cursor-pointer
                        @error('about.logo') border-red-500 dark:border-red-500 @else border-[#D1D5DB] dark:border-gray-700 @enderror
                        bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">

                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <span class="material-symbols-outlined text-gray-500 dark:text-gray-400" style="font-size: 48px;">cloud_upload</span>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                <span class="font-semibold">Click to upload</span> or drag and drop
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or GIF (MAX. 2MB)</p>
                        </div>
                    </label>
                    <input id="logo" wire:model="about.logo" class="hidden" name="logo" type="file" accept="image/*" />
                </div>

                @error('about.logo')
                    <span class="text-sm text-red-500 mt-2 block">{{ $message }}</span>
                @enderror

                <!-- Optional preview -->
                @if ($about['logo'])
                    <div class="mt-4">
                        <img src="{{ $about['logo']->temporaryUrl() }}" alt="Logo Preview"
                            class="w-32 h-32 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                    </div>
                @endif
            </div>
        </section>