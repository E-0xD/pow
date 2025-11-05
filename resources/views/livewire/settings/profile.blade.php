<main class="gap-8 w-full">
    <x-layouts.app.page-heading title="Profile Settings" subtitle="Update your personal details, contact information" />
    <x-layouts.app.settings-header />

    <!-- Right Column: Content -->
    <div class="w-full">
        <div class="flex flex-col gap-8">
            <!-- Profile Section -->
            <form wire:submit="updateProfileInformation"
                class="flex flex-col gap-6 p-6 bg-container-light dark:bg-container-dark rounded-lg border border-border-light dark:border-border-dark shadow-sm">
                <h2 class="text-xl font-bold leading-tight tracking-tight">
                    Personal Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-2">
                    <label class="flex flex-col w-full">
                        <p class="text-sm font-medium leading-normal pb-2">
                            Full Name
                        </p>
                        <input wire:model.defer="name" name="name" required autofocus autocomplete="name"
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-light dark:text-text-dark focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark h-12 placeholder:text-subtext-light dark:placeholder:text-subtext-dark p-3 text-base font-normal leading-normal"
                            type="text" />
                        @error('name')
                            <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="flex flex-col w-full">
                        <p class="text-sm font-medium leading-normal pb-2">
                            Email
                        </p>
                        <input wire:model.defer="email" name="email" required autocomplete="email"
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-light dark:text-text-dark focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark h-12 placeholder:text-subtext-light dark:placeholder:text-subtext-dark p-3 text-base font-normal leading-normal"
                            type="email" />
                        @error('email')
                            <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                        @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                            <div>
                                <p class="mt-3 text-sm text-subtext-light dark:text-subtext-dark">
                                    {{ __('Your email address is unverified.') }}
                                    <button type="button" wire:click.prevent="resendVerificationNotification"
                                        class="ml-2 text-sm font-medium text-primary hover:underline">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium !dark:text-green-400 !text-green-600 text-sm">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </label>
                </div>

                <!-- Save Changes Section -->
                <div class="flex justify-end items-center gap-4 mt-2">
                    <button type="button"
                        class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 px-6 bg-transparent text-text-light dark:text-text-dark text-sm font-bold leading-normal tracking-wide hover:bg-black/5 dark:hover:bg-white/10"
                        wire:click.prevent="resetForm">
                        <span class="truncate">Cancel</span>
                    </button>

                    <button type="submit"
                        class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 px-6 bg-primary text-white text-sm font-bold leading-normal tracking-wide hover:bg-primary/90">
                        <span class="truncate">{{ __('Save') }}</span>
                    </button>

                    <x-action-message class="ms-3" on="profile-updated">
                        {{ __('Saved.') }}
                    </x-action-message>
                </div>
            </form>

            <livewire:settings.delete-user-form />
        </div>
    </div>
</main>
