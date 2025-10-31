    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center" id="home">
        <div class="lg:col-span-2 space-y-6">
            <h1 class="text-5xl sm:text-7xl font-heading font-bold text-zinc-900 dark:text-white">
                {{ $portfolio->about->name }}
            </h1>
            <h2 class="text-xl sm:text-2xl font-medium text-zinc-800 dark:text-zinc-200">
                {{ $portfolio->about->brief }}
            </h2>
            <p class="max-w-xl text-base leading-relaxed">
                {{ $portfolio->about->description }}
            </p>
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 pt-4">
                <button
                    class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-background-dark text-base font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity">
                    <span class="truncate">Contact Me</span>
                </button>
                <div class="flex items-center gap-2">
                    @foreach ($portfolio->contactMethods as $contactMethod)
                        <a class="flex items-center justify-center h-10 w-10 rounded-full bg-zinc-200/50 dark:bg-zinc-800/50 hover:bg-zinc-200 dark:hover:bg-zinc-800 transition-colors"
                            href="{{ $contactMethod->value }}">
                            {!! $contactMethod->contactMethod->logo !!}
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
        @if ($portfolio->about->logo)
            <div class="relative flex justify-center lg:justify-end">
                <div class="absolute inset-0 -m-8 bg-magenta/20 dark:bg-magenta/10 rounded-full blur-3xl opacity-50">
                </div>
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full h-56 w-56 sm:h-72 sm:w-72 border-4 border-background-light dark:border-background-dark shadow-xl"
                    data-alt="A portrait of Jamie Doe, a creative product designer."
                    style='background-image: url("{{ Storage::url($portfolio->about->logo) }}");'>
                </div>
            </div>
        @endif
    </section>
