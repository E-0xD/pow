<header 
    x-data="{ open: false }"
    class="sticky top-0 z-[60] flex items-center justify-between whitespace-nowrap border-b border-border-light dark:border-border-dark px-4 sm:px-10 py-3 bg-background-light dark:bg-background-dark backdrop-blur-sm -mx-4 sm:-mx-10">

    <!-- Logo -->
    <div class="flex items-center gap-4 text-primary bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark p-2 rounded-lg">
        <div class="size-10">
            <img src="{{ asset(config('app.logo')) }}" alt="Logo">
        </div>
        <h2 class="text-text-light dark:text-text-dark text-xl font-bold tracking-[-0.015em]">
            {{ config('app.name') }}
        </h2>
    </div>

    <!-- Desktop Navigation -->
    <div class="hidden md:flex flex-1 justify-around gap-8 bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark p-2 rounded-lg mx-4">
        <nav class="flex items-center gap-9 bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark p-2 rounded-lg">
            <a class="text-text-light dark:text-text-dark text-sm font-medium hover:text-primary dark:hover:text-primary bg-background-light dark:bg-background-dark px-3 py-1 rounded"
                href="{{ route('guest.welcome') }}">Home</a>
            <a class="text-text-light dark:text-text-dark text-sm font-medium hover:text-primary dark:hover:text-primary bg-background-light dark:bg-background-dark px-3 py-1 rounded"
                href="{{ route('guest.features') }}">Features</a>
            <a class="text-text-light dark:text-text-dark text-sm font-medium hover:text-primary dark:hover:text-primary bg-background-light dark:bg-background-dark px-3 py-1 rounded"
                href="{{ route('guest.templates') }}">Templates</a>
            <a class="text-text-light dark:text-text-dark text-sm font-medium hover:text-primary dark:hover:text-primary bg-background-light dark:bg-background-dark px-3 py-1 rounded"
                href="{{ route('guest.pricing') }}">Pricing</a>
            <a class="text-text-light dark:text-text-dark text-sm font-medium hover:text-primary dark:hover:text-primary bg-background-light dark:bg-background-dark px-3 py-1 rounded"
                href="{{ route('guest.about') }}">About</a>
            <a class="text-text-light dark:text-text-dark text-sm font-medium hover:text-primary dark:hover:text-primary bg-background-light dark:bg-background-dark px-3 py-1 rounded"
                href="{{ route('guest.contact') }}">Contact Us</a>
        </nav>

        <div class="flex gap-2 bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark p-2 rounded-lg">
            <a href="{{ route('login') }}"
                class="flex items-center justify-center rounded-lg h-10 px-4 bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark border border-border-light dark:border-border-dark text-sm font-bold hover:bg-primary/10">
                Login
            </a>
            <a href="{{ route('register') }}"
                class="flex items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:opacity-90">
                Sign Up
            </a>
        </div>
    </div>

    <!-- Mobile Menu Button -->
    <button 
        @click="open = true"
        class="md:hidden flex items-center justify-center rounded-lg h-10 w-10 bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark border border-border-light dark:border-border-dark">
        <span class="material-symbols-outlined text-text-light dark:text-text-dark">menu</span>
    </button>

    <!-- Offcanvas Menu -->
    <div 
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 z-[70]  flex justify-end md:hidden"
        @click.self="open = false">

        <div 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="w-3/4 max-w-xs h-full bg-background-light dark:bg-background-dark shadow-xl flex flex-col p-6 space-y-6 border-l border-border-light dark:border-border-dark">

            <div class="flex justify-between items-center bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark p-2 rounded-lg">
                <h2 class="text-lg font-bold text-text-light dark:text-text-dark">{{ config('app.name') }}</h2>
                <button @click="open = false" class="text-text-light dark:text-text-dark">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <nav class="flex flex-col gap-4 text-text-light dark:text-text-dark bg-background-light dark:bg-background-dark p-4 rounded-lg">
                <a href="{{ route('guest.welcome') }}" class="hover:text-primary dark:hover:text-primary bg-background-light dark:bg-background-dark p-2 rounded">Home</a>
                <a href="{{ route('guest.features') }}" class="hover:text-primary dark:hover:text-primary bg-background-light dark:bg-background-dark p-2 rounded">Features</a>
                <a href="{{ route('guest.templates') }}" class="hover:text-primary dark:hover:text-primary bg-background-light dark:bg-background-dark p-2 rounded">Templates</a>
                <a href="{{ route('guest.pricing') }}" class="hover:text-primary dark:hover:text-primary bg-background-light dark:bg-background-dark p-2 rounded">Pricing</a>
                <a href="{{ route('guest.about') }}" class="hover:text-primary dark:hover:text-primary bg-background-light dark:bg-background-dark p-2 rounded">About</a>
                <a href="{{ route('guest.contact') }}" class="hover:text-primary dark:hover:text-primary bg-background-light dark:bg-background-dark p-2 rounded">Contact Us</a>
            </nav>

            <div class="mt-auto flex flex-col gap-3 bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark p-4 rounded-lg">
                <a href="{{ route('login') }}"
                    class="block text-center rounded-lg py-2 border border-border-light dark:border-border-dark hover:bg-primary/10 bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="block text-center rounded-lg py-2 bg-primary text-white hover:opacity-90">
                    Sign Up
                </a>
            </div>
        </div>
    </div>
</header>