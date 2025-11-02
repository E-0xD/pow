<section class="flex flex-col gap-6 p-6 bg-container-light dark:bg-container-dark rounded-lg border border-border-light dark:border-border-dark shadow-sm">
    <div class="mb-1">
        <flux:heading>{{ __('Update password') }}</flux:heading>
        <flux:subheading>{{ __('Ensure your account is using a long, random password to stay secure') }}</flux:subheading>
    </div>

    <form method="POST" wire:submit="updatePassword" class="mt-2 flex flex-col gap-6">
        <flux:input
            wire:model="current_password"
            :label="__('Current password')"
            type="password"
            required
            autocomplete="current-password"
        />

        <flux:input
            wire:model="password"
            :label="__('New password')"
            type="password"
            required
            autocomplete="new-password"
        />

        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirm Password')"
            type="password"
            required
            autocomplete="new-password"
        />

        <div class="flex justify-end items-center gap-4">
            <flux:button
                variant="primary"
                type="submit"
                class="flex min-w-[84px] items-center justify-center overflow-hidden rounded-lg h-11 px-6 bg-primary text-white text-sm font-bold leading-normal tracking-wide hover:bg-primary/90">
                {{ __('Save') }}
            </flux:button>

            <x-action-message class="ms-3" on="password-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
