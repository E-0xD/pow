 <section
            class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/50 p-6 shadow-sm">
            <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]">Skills
            </h2>
            <div class="relative">
                <span
                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-xl">search</span>
                <input
                    wire:model.lazy="skillSearch"
                    wire:keydown.enter="addSkill"
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 pl-10 pr-4 py-2 text-base"
                    placeholder="Search and add skills..." />
            </div>
            <div class="flex flex-wrap gap-2 pt-2">
                @foreach($selectedSkills as $index => $skill)
                <span
                    class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 dark:bg-primary/20 px-3 py-1 text-sm font-medium text-primary dark:text-primary/90">
                    {{ $skill }}
                    <button wire:click="removeSkill({{ $index }})" class="p-0.5 rounded-full hover:bg-primary/20 dark:hover:bg-primary/30">
                        <span class="material-symbols-outlined text-xs">close</span>
                    </button>
                </span>
                @endforeach
            </div>
        </section>