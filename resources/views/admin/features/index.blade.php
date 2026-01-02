<x-layouts.app>
    <div class="mx-auto max-w-7xl">
        <!-- Page Heading -->
        <div class="flex flex-col gap-2 mb-8">
            <p class="text-text-light dark:text-text-dark text-3xl lg:text-4xl font-black tracking-tighter">
                Admin Features
            </p>
            <p class="text-subtle-light dark:text-subtle-dark text-base font-normal leading-normal">
                Access all admin management tools and features
            </p>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach ($features as $feature)
                <a href="{{ route($feature['route']) }}"
                    class="flex flex-col items-center justify-center gap-4 p-6 rounded-lg bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark hover:shadow-md dark:hover:shadow-lg transition-shadow duration-200">
                    
                    <!-- Icon -->
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-primary/10 dark:bg-primary/20">
                        <span class="material-symbols-outlined text-2xl text-primary">
                            {{ $feature['icon'] }}
                        </span>
                    </div>

                    <!-- Feature Name -->
                    <p class="text-text-light dark:text-text-dark text-center font-semibold text-sm lg:text-base">
                        {{ $feature['name'] }}
                    </p>

                    <!-- Description -->
                    <p class="text-subtle-light dark:text-subtle-dark text-center text-xs lg:text-sm leading-relaxed">
                        {{ $feature['description'] }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</x-layouts.app>
