<x-layouts.guest>

    <div
        class="relative flex min-h-screen w-full flex-col items-center justify-center bg-background-light dark:bg-background-dark p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-md rounded-xl p-8 dark:bg-zinc-900 sm:p-10">
            <div class="flex flex-col items-center">

                <h1
                    class="text-[#141118] tracking-light text-[32px] font-bold leading-tight text-center pb-3 pt-4 dark:text-white">
                    Reset Your Password
                </h1>

                <p class="text-subtext-light dark:text-subtext-dark text-sm text-center mt-2 mb-8">
                    {{ __('Enter your email and create a new password to regain access to your account.') }}
                </p>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="mt-8 space-y-6">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="flex flex-col">
                    <label class="flex flex-col">
                        <p class="text-[#141118] text-base font-medium pb-2 dark:text-gray-300">Email</p>
                        <input id="email" name="email" type="email" required autocomplete="email"
                            class="form-input w-full rounded-lg border border-[#e0dbe6] bg-white dark:bg-background-dark dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-primary/50 h-14 p-[15px] text-base"
                            placeholder="Enter your email" value="{{ old('email', $request->email ?? '') }}" />
                        @error('email')
                            <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <div class="flex flex-col">
                    <label class="flex flex-col">
                        <p class="text-[#141118] text-base font-medium pb-2 dark:text-gray-300">New Password</p>
                        <input id="password" name="password" type="password" required autocomplete="new-password"
                            class="form-input w-full rounded-lg border border-[#e0dbe6] bg-white dark:bg-background-dark dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-primary/50 h-14 p-[15px] text-base"
                            placeholder="Enter your new password" />
                        @error('password')
                            <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <div class="flex flex-col">
                    <label class="flex flex-col">
                        <p class="text-[#141118] text-base font-medium pb-2 dark:text-gray-300">Confirm Password</p>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            autocomplete="new-password"
                            class="form-input w-full rounded-lg border border-[#e0dbe6] bg-white dark:bg-background-dark dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-primary/50 h-14 p-[15px] text-base"
                            placeholder="Confirm your password" />
                    </label>
                </div>

                <button
                    class="flex h-14 w-full items-center justify-center gap-2 rounded-lg bg-primary px-4 py-3 text-base font-semibold text-white transition-colors hover:bg-primary/90"
                    type="submit">
                    Reset Password
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-base text-gray-600 dark:text-gray-400">
                    Remember your password?
                    <a class="font-semibold text-primary hover:underline" href="{{ route('login') }}">Sign in</a>
                </p>
            </div>
        </div>
    </div>

</x-layouts.guest>
