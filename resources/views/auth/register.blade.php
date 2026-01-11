<x-layouts.guest>
    <div
        class="relative flex h-auto min-h-screen w-full flex-col items-center justify-center bg-background-light group/design-root dark:bg-background-dark p-4 sm:p-6 lg:p-8">

        <div class="w-full max-w-md rounded-xl p-8 dark:bg-zinc-900  sm:p-10">
            <div class="flex flex-col items-center">

                <h1
                    class="text-[#141118] tracking-light text-[32px] font-bold leading-tight text-center pb-3 pt-4 dark:text-white">

                    {{ config('app.status') == 'waitlist' ? 'Be an Early Adopter' : 'Create Your Account' }}

                </h1>
            </div>

            <form method="POST" action="{{ route('register.submit') }}" class="mt-8 space-y-6">
                @csrf

                <div class="flex flex-col">
                    <label class="flex flex-col">
                        <p class="text-[#141118] text-base font-medium pb-2 dark:text-gray-300">Full Name</p>
                        <input id="name" name="name" type="text" required autofocus autocomplete="name"
                            class="form-input w-full rounded-lg border border-[#e0dbe6] bg-white dark:bg-background-dark dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-primary/50 h-14 p-[15px] text-base"
                            placeholder="Enter your full name" value="{{ old('name') }}" />
                        @error('name')
                            <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <div class="flex flex-col">
                    <label class="flex flex-col">
                        <p class="text-[#141118] text-base font-medium pb-2 dark:text-gray-300">Email</p>
                        <input id="email" name="email" type="email" required autocomplete="username"
                            class="form-input w-full rounded-lg border border-[#e0dbe6] bg-white dark:bg-background-dark dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-primary/50 h-14 p-[15px] text-base"
                            placeholder="Enter your email" value="{{ old('email') }}" />
                        @error('email')
                            <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <div class="flex flex-col">
                    <label class="flex flex-col">
                        <p class="text-[#141118] text-base font-medium pb-2 dark:text-gray-300">Password</p>
                        <input id="password" name="password" type="password" required autocomplete="new-password"
                            class="form-input w-full rounded-lg border border-[#e0dbe6] bg-white dark:bg-background-dark dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-primary/50 h-14 p-[15px] text-base"
                            placeholder="Enter your password" />
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
                    {{ config('app.status') == 'waitlist' ? 'Join the waitlist' : 'Sign Up' }}
                </button>

                <div class="flex items-center gap-4">
                    <hr class="w-full border-t border-[#e0dbe6] dark:border-gray-700" />
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">OR</p>
                    <hr class="w-full border-t border-[#e0dbe6] dark:border-gray-700" />
                </div>

                <a href="{{ route('auth.google.initialize') }}"
                    class="flex h-14 w-full items-center justify-center gap-3 rounded-lg border border-[#e0dbe6] bg-white px-4 py-3 text-base font-semibold text-[#141118] transition-colors hover:bg-gray-50 dark:bg-background-dark dark:text-white dark:border-gray-700 dark:hover:bg-background-dark/80"
                    type="button">
                    <svg class="h-6 w-6" viewBox="0 0 48 48">
                        <path d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12
                            c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4
                            C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20
                            C44,22.659,43.862,21.35,43.611,20.083z" fill="#FFC107"></path>
                        <path d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12
                            c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657
                            C34.046,6.053,29.268,4,24,4
                            C16.318,4,9.656,8.337,6.306,14.691z" fill="#FF3D00"></path>
                        <path d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238
                            C29.211,35.091,26.715,36,24,36
                            c-5.222,0-9.619-3.317-11.28-7.946l-6.522,5.025
                            C9.505,39.556,16.227,44,24,44z" fill="#4CAF50"></path>
                        <path d="M43.611,20.083H42V20H24v8h11.303
                            c-0.792,2.237-2.231,4.166-4.087,5.571l6.19,5.238
                            C43.021,36.241,44,30.563,44,24
                            C44,22.659,43.862,21.35,43.611,20.083z" fill="#1976D2"></path>
                    </svg>
                    {{ config('app.status') == 'waitlist' ? 'Join the waitlist' : 'Sign Up' }} with Google
                </a>
            </form>

            <div class="mt-8 text-center">
                <p class="text-base text-gray-600 dark:text-gray-400">
                    {{ config('app.status') == 'waitlist' ? 'Joined the waitlist?' : 'Already have an account?' }}

                    <a class="font-semibold text-primary hover:underline" href="{{ route('login') }}">Log in</a>
                </p>
            </div>
        </div>
    </div>
</x-layouts.guest>
