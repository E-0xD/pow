<main class="gap-8 w-full">
    <x-layouts.app.page-heading title="Password & Security"
        subtitle="Manage your account password and enable additional security options to keep your data safe." />

    <x-layouts.app.settings-header />

    <div class="w-full">
        <div class="flex flex-col gap-8">
            <form wire:submit="updatePassword"
                class="flex flex-col gap-6 p-6 bg-container-light dark:bg-container-dark rounded-lg border border-border-light dark:border-border-dark shadow-sm">

                <h2 class="text-xl font-bold leading-tight tracking-tight">
                    Update Password
                </h2>
                <p class="text-sm text-subtext-light dark:text-subtext-dark">
                    Ensure your account is using a long, random password to stay secure.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-2">
                    <label class="flex flex-col w-full">
                        <p class="text-sm font-medium leading-normal pb-2">
                            Current Password
                        </p>
                        <input wire:model.defer="current_password" name="current_password" required
                            autocomplete="current-password"
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg 
                                   text-text-light dark:text-text-dark focus:outline-0 focus:ring-2 focus:ring-primary/50 
                                   border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark 
                                   h-12 placeholder:text-subtext-light dark:placeholder:text-subtext-dark p-3 text-base font-normal"
                            type="password" />
                        @error('current_password')
                            <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="flex flex-col w-full">
                        <p class="text-sm font-medium leading-normal pb-2">
                            New Password
                        </p>
                        <input wire:model.defer="password" name="password" required autocomplete="new-password"
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg 
                                   text-text-light dark:text-text-dark focus:outline-0 focus:ring-2 focus:ring-primary/50 
                                   border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark 
                                   h-12 placeholder:text-subtext-light dark:placeholder:text-subtext-dark p-3 text-base font-normal"
                            type="password" />
                        @error('password')
                            <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="flex flex-col w-full md:col-span-2">
                        <p class="text-sm font-medium leading-normal pb-2">
                            Confirm New Password
                        </p>
                        <input wire:model.defer="password_confirmation" name="password_confirmation" required
                            autocomplete="new-password"
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg 
                                   text-text-light dark:text-text-dark focus:outline-0 focus:ring-2 focus:ring-primary/50 
                                   border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark 
                                   h-12 placeholder:text-subtext-light dark:placeholder:text-subtext-dark p-3 text-base font-normal"
                            type="password" />
                        @error('password_confirmation')
                            <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </label>
                </div>

                <!-- Save Button -->
                <div class="flex justify-end items-center gap-4 mt-2">
                    <button type="button"
                        class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 px-6 
                               bg-transparent text-text-light dark:text-text-dark text-sm font-bold leading-normal tracking-wide 
                               hover:bg-black/5 dark:hover:bg-white/10"
                        wire:click.prevent="resetForm">
                        <span class="truncate">Cancel</span>
                    </button>

                    <button type="submit"
                        class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 px-6 
                               bg-primary text-white text-sm font-bold leading-normal tracking-wide hover:bg-primary/90">
                        <span class="truncate">{{ __('Save') }}</span>
                    </button>

                    <x-action-message class="ms-3" on="password-updated">
                        {{ __('Saved.') }}
                    </x-action-message>
                </div>
            </form>
        </div>
    </div>
</main>
