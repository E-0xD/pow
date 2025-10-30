<section 
    class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/50 p-6 shadow-sm">
    <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]">
        Skills
    </h2>

    <!-- Search Input -->
    <div class="relative">
        <span
            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-xl">
            search
        </span>
        <input 
            wire:model.live.debounce.300ms="skillSearch"
            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg 
                   text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 
                   border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark 
                   focus:border-primary h-12 placeholder:text-gray-400 pl-10 pr-4 py-2 text-base"
            placeholder="Search and add skills..." 
        />

        <!-- Dropdown Results -->
        @if(!empty($searchResults))
            <ul class="absolute z-10 mt-2 w-full bg-white dark:bg-gray-800 border border-gray-200 
                       dark:border-gray-700 rounded-lg shadow-md max-h-60 overflow-y-auto">
                @foreach($searchResults as $skill)
                    <li 
                        wire:click="selectSkill({{ $skill['id'] }})"
                        class="flex items-center gap-2 px-4 py-2 cursor-pointer hover:bg-gray-100 
                               dark:hover:bg-gray-700 transition">
                        <span class="material-symbols-outlined text-primary text-base">
                            {!! $skill['logo'] !!}
                        </span>
                        <span class="text-gray-900 dark:text-gray-100">{{ $skill['title'] }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Selected Skills -->
    <div class="flex flex-wrap gap-2 pt-2">
        @foreach ($selectedSkills as $index => $skill)
            <span
                class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 dark:bg-primary/20 
                       px-3 py-1 text-sm font-medium text-primary dark:text-primary/90">
                <span class="material-symbols-outlined text-sm">{!! $skill['logo'] !!}</span>
                {{ $skill['title'] }}
                <button type="button" wire:click="removeSkill({{ $index }})"
                    class="p-0.5 rounded-full hover:bg-primary/20 dark:hover:bg-primary/30">
                    <span class="material-symbols-outlined text-xs">close</span>
                </button>
            </span>
        @endforeach
    </div>
</section>
