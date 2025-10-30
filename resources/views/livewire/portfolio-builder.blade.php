<div>
    @if ($currentStep === 1)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 flex-1">
            <!-- Available Sections -->
            <div class="flex flex-col gap-4">
                <h3 class="text-slate-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] px-4">
                    Available Sections</h3>
                <div
                    class="flex flex-col gap-2 p-2 bg-slate-100 dark:bg-black/30 rounded-xl border border-slate-200 dark:border-slate-800 min-h-[480px]">
                    @if (count($availableSections) === 0)
                        <div class="flex items-center justify-center flex-col flex-1 text-center p-4 pointer-events-none"
                            id="available-empty-state">
                            <span class="material-symbols-outlined text-4xl text-slate-400 dark:text-slate-600 mb-2">
                                workspace_premium
                            </span>
                            <p class="font-bold text-slate-600 dark:text-slate-400">
                                You’ve added every section, impressive!
                            </p>
                            <p class="text-sm text-slate-500 dark:text-slate-500">
                                Your portfolio already reflects a professional Proof of Work.
                                Keep it polished or reorder sections as you like.
                            </p>
                        </div>
                    @endif

                    @foreach ($availableSections as $section)
                        <div wire:key="available-{{ $section['id'] }}"
                            class="flex items-center gap-4 bg-white dark:bg-slate-900/50 px-4 min-h-[72px] py-2 justify-between rounded-lg shadow-sm transition-transform duration-150 hover:scale-[1.02]">
                            <div class="flex items-center gap-4">
                                <div
                                    class="text-slate-700 dark:text-slate-300 flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 shrink-0 size-12">
                                    <span class="material-symbols-outlined">{{ $section['icon'] }}</span>
                                </div>
                                <div class="flex flex-col justify-center">
                                    <p
                                        class="text-slate-900 dark:text-white text-base font-medium leading-normal line-clamp-1">
                                        {{ $section['title'] }}
                                    </p>
                                    <p
                                        class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal line-clamp-2">
                                        {{ $section['description'] }}
                                    </p>
                                </div>
                            </div>

                            <div class="shrink-0">
                                <button type="button" wire:click.prevent="addSection('{{ $section['id'] }}')"
                                    class="text-slate-500 dark:text-slate-400 flex size-7 items-center justify-center">
                                    <span class="material-symbols-outlined">add</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Your Portfolio Sections -->
            <div class="flex flex-col gap-4">
                <h3 class="text-slate-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] px-4">Your
                    Portfolio Sections</h3>
                <div class="flex flex-col gap-2 p-2 bg-slate-100 dark:bg-black/30 rounded-xl border-2 border-dashed border-slate-300 dark:border-slate-700 min-h-[480px]"
                    id="selected-sections">

                    @if (count($selectedSections) === 0)
                        <div class="flex items-center justify-center flex-col flex-1 text-center p-4 pointer-events-none"
                            id="empty-state">
                            <span
                                class="material-symbols-outlined text-4xl text-slate-400 dark:text-slate-600 mb-2">add_to_photos</span>
                            <p class="font-bold text-slate-600 dark:text-slate-400">Your portfolio is empty</p>
                            <p class="text-sm text-slate-500 dark:text-slate-500">Drag sections here to start building.
                            </p>
                        </div>
                    @endif

                    @foreach ($selectedSections as $section)
                        <div wire:key="selected-{{ $section['id'] }}"
                            class="flex items-center gap-4 bg-white dark:bg-slate-900/50 px-4 min-h-[72px] py-2 justify-between rounded-lg shadow-sm draggable select-none"
                            data-section="{{ json_encode($section) }}" data-section-id="{{ $section['id'] }}">
                            <div class="flex items-center gap-4">
                                <div
                                    class="text-slate-700 dark:text-slate-300 flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 shrink-0 size-12">
                                    <span class="material-symbols-outlined">{{ $section['icon'] }}</span>
                                </div>
                                <div class="flex flex-col justify-center">
                                    <p
                                        class="text-slate-900 dark:text-white text-base font-medium leading-normal line-clamp-1">
                                        {{ $section['title'] }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 shrink-0">
                                @if (!$loop->first)
                                    <button type="button" wire:click.prevent="moveUp('{{ $section['id'] }}')"
                                        class="text-slate-500 dark:text-slate-400 flex size-7 items-center justify-center">
                                        <span class="material-symbols-outlined">arrow_upward</span>
                                    </button>
                                @endif

                                @if (!$loop->last)
                                    <button type="button" wire:click.prevent="moveDown('{{ $section['id'] }}')"
                                        class="text-slate-500 dark:text-slate-400 flex size-7 items-center justify-center">
                                        <span class="material-symbols-outlined">arrow_downward</span>
                                    </button>
                                @endif

                                <button type="button" wire:click.prevent="removeSection('{{ $section['id'] }}')"
                                    class="text-slate-500 dark:text-slate-400 flex size-7 items-center justify-center">
                                    <span class="material-symbols-outlined">remove</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <!-- Step 2: Content Editor -->
        <div
            class="lg:col-span- xl:col-span-2 flex h-[calc(100vh-4rem)] flex-col overflow-y-auto border-r border-neutral-light-gray dark:border-neutral-dark-gray/20">
            <div class="p-8">
                <div class="flex flex-col gap-2">
                    <h1 class="text-2xl font-bold text-neutral-dark-gray dark:text-neutral-white">Portfolio Content</h1>
                    <p class="text-neutral-medium-gray text-base font-normal">Fill in the details for your portfolio.
                        Your changes will be saved automatically.</p>
                </div>
            </div>
            <div class="flex flex-col gap-4 px-8 pb-8">
                @foreach ($selectedSections as $section)
                    <div x-data="{ open: true }"
                        class="flex flex-col rounded-xl border border-neutral-light-gray dark:border-neutral-dark-gray/20 bg-neutral-white dark:bg-background-dark/50 px-4">
                        <summary @click="open = !open"
                            class="flex cursor-pointer items-center justify-between gap-6 py-3.5">
                            <p class="text-neutral-dark-gray dark:text-neutral-white text-base font-semibold">
                                {{ $section['title'] }}</p>
                            <span class="material-symbols-outlined text-neutral-medium-gray transition-transform"
                                :class="{ 'rotate-180': open }">expand_more</span>
                        </summary>
                        <div x-show="open" class="flex flex-col gap-4 pb-4 pt-2">
                            @include("livewire.sections.{$section['id']}")
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if (session()->has('message'))
        <div
            class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="flex justify-between items-center mt-10 pt-6 border-t border-slate-200 dark:border-slate-800">
        <button wire:click="previousStep"
            class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 text-slate-700 dark:text-slate-300 text-sm font-bold leading-normal tracking-wide hover:bg-slate-200 dark:hover:bg-slate-800">
            <span class="truncate">Back</span>
        </button>
        <button wire:click="nextStep"
            class="flex min-w-[84px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-10 px-5 bg-primary text-white text-sm font-bold leading-normal shadow-lg shadow-primary/30 hover:bg-primary/90">
            <span class="truncate">{{ $currentStep === 1 ? 'Next: Add Content' : 'Next: Preview' }}</span>
            <span class="material-symbols-outlined">arrow_forward</span>
        </button>
    </div>

</div>
