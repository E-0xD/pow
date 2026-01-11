<x-layouts.guest>

    <div
        class="relative flex min-h-screen w-full flex-col items-center justify-center bg-background-light dark:bg-background-dark p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-md">
            <div
                class="flex flex-col items-center rounded-xl dark:bg-zinc-900 dark:border-zinc-800 p-8 sm:p-10">

                <h3 class="text-[#111827] dark:text-white text-2xl font-bold text-center pb-4">Two-factor authentication
                </h3>

                <div x-data="{ recovery: false }" class="w-full">
                    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-show="! recovery">
                        {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                    </p>

                    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-cloak x-show="recovery">
                        {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                    </p>

                    <form method="POST" action="{{ route('two-factor.login') }}">
                        @csrf

                        <div class="mt-4" x-show="! recovery">
                            <x-label for="code" value="{{ __('Code') }}" />
                            <x-input id="code" class="block mt-1 w-full" type="text" inputmode="numeric"
                                name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                            @error('code')
                                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-4" x-cloak x-show="recovery">
                            <x-label for="recovery_code" value="{{ __('Recovery Code') }}" />
                            <x-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code"
                                x-ref="recovery_code" autocomplete="one-time-code" />
                            @error('recovery_code')
                                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="button" class="text-sm text-gray-600 dark:text-gray-300 hover:underline"
                                x-show="! recovery"
                                x-on:click="recovery = true; $nextTick(() => { $refs.recovery_code.focus() })">
                                {{ __('Use a recovery code') }}
                            </button>

                            <button type="button" class="text-sm text-gray-600 dark:text-gray-300 hover:underline"
                                x-cloak x-show="recovery"
                                x-on:click="recovery = false; $nextTick(() => { $refs.code.focus() })">
                                {{ __('Use an authentication code') }}
                            </button>

                            <x-button class="ms-4">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</x-layouts.guest>
