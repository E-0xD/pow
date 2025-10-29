<x-layouts.guest>
    <div
        class="relative flex min-h-screen w-full flex-col items-center justify-center bg-background-light dark:bg-background-dark p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-md">
            <div
                class="flex flex-col items-center rounded-xl bg-white dark:bg-zinc-900 shadow-md border border-gray-200 dark:border-zinc-800 p-8 sm:p-10">

                {{-- App Logo / Title --}}
                <div class="mb-4 flex items-center gap-2">
                    <div class="rounded-lg p-2 text-white size-20">
                        <img src="{{asset(config('app.logo'))}}" alt="" srcset="">
                    </div>
                    
                </div>
                <h3 class="text-[#111827] dark:text-white text-2xl font-bold text-center pb-8 pt-2">
                    Sign in to your account
                </h3>

                {{-- Google Login Button (Optional Integration Later) --}}
                <div class="w-full">
                    <button type="button"
                        class="flex w-full items-center justify-center rounded-lg h-12 px-5 bg-white dark:bg-zinc-800 text-[#111827] dark:text-white gap-3 text-base font-bold border border-gray-300 dark:border-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-700 transition-colors">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                            <g clip-path="url(#clip0_3033_558)">
                                <path
                                    d="M22.58 12.375a10.5 10.5 0 00-.21-2.43H12.24v4.56h5.91a5.5 5.5 0 01-2.25 3.39v2.61h3.75A10.7 10.7 0 0022.58 12.375z"
                                    fill="#4285F4" />
                                <path
                                    d="M12.24 23A10.4 10.4 0 0020.13 20.07l-3.73-2.6a6.6 6.6 0 01-8.58-3.4H2.07v2.67A10.8 10.8 0 0012.24 23z"
                                    fill="#34A853" />
                                <path
                                    d="M5.82 14.07A6.3 6.3 0 015.46 12a6.3 6.3 0 01.36-2.07V7.26H2.07A10.8 10.8 0 00.75 12a10.8 10.8 0 001.32 4.74l3.75-2.67z"
                                    fill="#FBBC05" />
                                <path
                                    d="M12.24 5.33a6.7 6.7 0 013.79 1.42l3.43-3.43A10.8 10.8 0 0012.24.49a10.8 10.8 0 00-10.17 6.26l3.75 2.67A6.7 6.7 0 0112.24 5.33z"
                                    fill="#EA4335" />
                            </g>
                            <defs>
                                <clipPath id="clip0_3033_558">
                                    <rect width="24" height="24" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span>Continue with Google</span>
                    </button>
                </div>

                {{-- Divider --}}
                <div class="flex w-full items-center gap-4 py-6">
                    <div class="h-px flex-1 bg-gray-200 dark:bg-zinc-700"></div>
                    <p class="text-subtext-light dark:text-subtext-dark text-sm">or</p>
                    <div class="h-px flex-1 bg-gray-200 dark:bg-zinc-700"></div>
                </div>


                {{-- Login Form --}}
                <form method="POST" action="{{ route('login') }}" class="flex w-full flex-col gap-5">
                    @csrf

                    {{-- Email --}}
                    <label class="flex flex-col flex-1">
                        <p class="text-text-light dark:text-text-dark text-base font-medium pb-2">
                            Email Address
                        </p>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus autocomplete="username" placeholder="you@example.com"
                            class="form-input w-full rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 h-14 px-[15px] text-base text-text-light dark:text-text-dark placeholder:text-subtext-light dark:placeholder:text-subtext-dark focus:outline-none focus:ring-2 focus:ring-primary transition-shadow" />
                    </label>

                    {{-- Password --}}
                    <label class="flex flex-col flex-1">
                        <div class="flex justify-between items-baseline pb-2">
                            <p class="text-text-light dark:text-text-dark text-base font-medium">Password</p>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-primary text-sm font-semibold hover:underline">
                                    Forgot Password?
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="Enter your password"
                            class="form-input w-full rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 h-14 px-[15px] text-base text-text-light dark:text-text-dark placeholder:text-subtext-light dark:placeholder:text-subtext-dark focus:outline-none focus:ring-2 focus:ring-primary transition-shadow" />
                    </label>

                    {{-- Remember Me --}}
                    <label class="flex items-center gap-2 mt-2">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="rounded border-gray-300 dark:border-zinc-700 text-primary focus:ring-primary" />
                        <span class="text-sm text-text-light dark:text-text-dark">Remember me</span>
                    </label>

                    {{-- Submit Button --}}
                    <button type="submit"
                        class="flex w-full justify-center items-center rounded-lg h-12 mt-4 bg-primary text-white text-base font-bold hover:bg-primary/90 transition-colors">
                        Sign In
                    </button>
                </form>

                {{-- Register CTA --}}
                <p class="text-subtext-light dark:text-subtext-dark text-sm pt-8 text-center">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="font-bold text-primary hover:underline">Sign Up</a>
                </p>
            </div>
        </div>
    </div>
</x-layouts.guest>
