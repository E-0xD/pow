<x-layouts.guest>

    <div class="relative flex min-h-screen w-full flex-col items-center justify-center bg-background-light dark:bg-background-dark p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-md">
            <div class="flex flex-col items-center rounded-xl dark:bg-zinc-900 dark:border-zinc-800 p-8 sm:p-10">

                <h3 class="text-[#111827] dark:text-white text-2xl font-bold text-center pb-4">
                    Verify your email
                </h3>

                <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-6">
                    {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600 text-center">
                        {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
                    </div>
                @endif

                <div class="w-full mt-4">
                    <form method="POST" action="{{ route('verification.send') }}" class="flex gap-3">
                        @csrf
                        <x-button type="submit" class="flex-1">
                            {{ __('Resend Verification Email') }}
                        </x-button>
                    </form>

                    <div class="mt-4 flex items-center justify-between">
                        <a href="{{ route('profile.show') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
                            {{ __('Edit Profile') }}
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-gray-600 dark:text-gray-300 hover:underline ms-2">{{ __('Log Out') }}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-layouts.guest>
