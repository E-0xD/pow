<header
    class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-border-light dark:border-border-dark px-4 sm:px-10 py-3 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm -mx-4 sm:-mx-10">
    <div class="flex items-center gap-4 text-primary">
        <div class="size-6">
            <svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M24 4C25.7818 14.2173 33.7827 22.2182 44 24C33.7827 25.7818 25.7818 33.7827 24 44C22.2182 33.7827 14.2173 25.7818 4 24C14.2173 22.2182 22.2182 14.2173 24 4Z"
                    fill="currentColor"></path>
            </svg>
        </div>
        <h2 class="text-text-light dark:text-text-dark text-xl font-bold leading-tight tracking-[-0.015em]">
            POW</h2>
    </div>
    <div class="hidden md:flex flex-1 justify-around gap-8">
        <nav class="flex items-center gap-9">
            <a class="text-text-light dark:text-text-dark text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary"
                href="{{ route('guest.welcome') }}">Home</a>
            <a class="text-text-light dark:text-text-dark text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary"
                href="{{ route('guest.features') }}">Features</a>
            <a class="text-text-light dark:text-text-dark text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary"
                href="{{ route('guest.templates') }}">Templates</a>
            <a class="text-text-light dark:text-text-dark text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary"
                href="{{ route('guest.pricing') }}">Pricing</a>
            <a class="text-text-light dark:text-text-dark text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary"
                href="{{ route('guest.about') }}">About</a>
            <a class="text-text-light dark:text-text-dark text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary"
                href="{{ route('guest.contact') }}">Contact Us</a>
        </nav>
        <div class="flex gap-2">
            <a href="{{route('login')}}"
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-background-light dark:bg-card-dark text-text-light dark:text-text-dark border border-border-light dark:border-border-dark text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/10">
                <span class="truncate">Login</span>
            </a>
            <a href="{{route('register')}}"
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:opacity-90">
                <span class="truncate">Sign Up</span>
            </a>
        </div>
    </div>
    <button
        class="md:hidden flex items-center justify-center rounded-lg h-10 w-10 bg-background-light dark:bg-card-dark border border-border-light dark:border-border-dark">
        <span class="material-symbols-outlined text-text-light dark:text-text-dark">menu</span>
    </button>
</header>
