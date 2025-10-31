<section id="experience">
    <h2 class="text-3xl sm:text-4xl font-heading font-bold text-zinc-900 dark:text-white mb-12">
        Experience</h2>
    <div class="grid grid-cols-[auto_1fr] gap-x-4 sm:gap-x-6">

        @foreach ($portfolio->experiences as $experience)
            <!-- Timeline Item 1 -->
            <div class="flex flex-col items-center gap-1.5">
                <div
                    class="flex items-center justify-center h-8 w-8 rounded-full bg-electric-blue/10 dark:bg-electric-blue/20">
                    <span class="material-symbols-outlined text-electric-blue text-lg">work</span>
                </div>
                <div class="w-px bg-zinc-300 dark:bg-zinc-700 grow"></div>
            </div>
            <div class="flex flex-1 flex-col pb-12">
                <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $experience->start_date->format('Y') }} -
                    {{ $experience->end_date ? $experience->end_date->format('Y') : 'Present' }}</p>
                <p class="text-lg font-bold text-zinc-800 dark:text-zinc-100 mt-1">{{ ucFirst($experience->position) }}
                    at
                    {{ ucFirst($experience->company) }}</p>
                <p class="mt-2 text-base">{{ ucFirst($experience->description) }}</p>
            </div>
        @endforeach

    </div>
</section>
