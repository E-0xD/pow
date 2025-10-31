<section id="experience">
    <h2 class="text-3xl sm:text-4xl font-heading font-bold text-zinc-900 dark:text-white mb-12">
        Education</h2>
    <div class="grid grid-cols-[auto_1fr] gap-x-4 sm:gap-x-6">
        @foreach ($portfolio->educationRecords as $education)
            <!-- Timeline Item 3 -->
            <div class="flex flex-col items-center gap-1.5">
                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-magenta/10 dark:bg-magenta/20">
                    <span class="material-symbols-outlined text-magenta text-lg">school</span>
                </div>
                     <div class="w-px bg-zinc-300 dark:bg-zinc-700 grow"></div>
            </div>
            <div class="flex flex-1 flex-col pb-12">
                <p class="text-sm text-zinc-500 dark:text-zinc-400">
                    {{ $education->year_of_admission->format('Y') }} -
                    {{ $education->year_of_graduation ? $education->year_of_graduation->format('Y') : 'Present' }}
                </p>
                <p class="text-lg font-bold text-zinc-800 dark:text-zinc-100 mt-1">{{ $education->degree }}</p>
                <p class="mt-1 text-base text-zinc-600 dark:text-zinc-400">{{ $education->school }}</p>
            </div>
        @endforeach
    </div>
</section>
