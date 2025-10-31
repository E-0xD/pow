    <section id="skills">
        <h2 class="text-3xl sm:text-4xl font-heading font-bold text-zinc-900 dark:text-white mb-8">
            Skills</h2>
        <div class="flex flex-wrap gap-3">
            {{-- technical skills  --}}

            @foreach ($portfolio->skills->sortBy(fn($skill) => $skill->type->value === 'technical') as $skill)
                <div
                    class="px-4 py-1.5 rounded-full 
                {{ $skill->type->value == 'technical'
                    ? 'bg-primary/20 dark:bg-primary/30 text-primary-darker dark:text-primary'
                    : 'bg-electric-blue/20 dark:bg-electric-blue/30 text-electric-blue' }} 
                font-medium">
                    {!! $skill->logo !!} {{ ucfirst($skill->title) }}
                </div>
            @endforeach

        </div>
    </section>
