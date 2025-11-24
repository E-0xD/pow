<x-layouts.guest>

    <div
        class="relative flex min-h-screen w-full flex-col items-center justify-center bg-background-light dark:bg-background-dark p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-md">
            <div
                class="flex flex-col items-center rounded-xl bg-white dark:bg-zinc-900 shadow-md border border-gray-200 dark:border-zinc-800 p-8 sm:p-10">

                <h3 class="text-[#111827] dark:text-white text-2xl font-bold text-center pb-4">Confirm your password</h3>

                <p class="mb-4 text-sm text-gray-600 dark:text-gray-400 text-center">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>

                <form method="POST" action="{{ route('password.confirm') }}" class="w-full">
                    @csrf

                    <div>
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" autofocus />
                        @error('password')
                            <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="flex w-full justify-center items-center rounded-lg h-12 mt-4 bg-primary text-white text-base font-bold hover:bg-primary/90 transition-colors">
                            Confirm
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</x-layouts.guest>
