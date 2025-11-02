<section class="flex flex-col gap-6 p-6 bg-container-light dark:bg-container-dark rounded-lg border border-border-light dark:border-border-dark shadow-sm">
    <div class="flex items-start justify-between gap-4">
        <div>
            <flux:heading>{{ __('Delete account') }}</flux:heading>
            <flux:subheading>{{ __('Delete your account and all of its resources') }}</flux:subheading>
        </div>

        <div>
            <flux:modal.trigger name="confirm-user-deletion">
                <flux:button
                    variant="danger"
                    class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 px-6 bg-red-600 text-white text-sm font-bold leading-normal tracking-wide hover:bg-red-700"
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                    {{ __('Delete account') }}
                </flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <flux:modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
        <form method="POST" wire:submit="deleteUser" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Are you sure you want to delete your account?') }}</flux:heading>

                <flux:subheading>
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </flux:subheading>
            </div>

            <flux:input wire:model="password" :label="__('Password')" type="password" />

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button
                    variant="danger"
                    type="submit"
                    class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 px-6 bg-red-600 text-white text-sm font-bold leading-normal tracking-wide hover:bg-red-700">
                    {{ __('Delete account') }}
                </flux:button>
            </div>
        </form>
    </flux:modal>
</section>
