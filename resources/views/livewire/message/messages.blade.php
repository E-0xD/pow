<!-- Message List Panel -->
{{-- <x-layouts.app> --}}

<div class="col-span-12 md:col-span-4 lg:col-span-3 border-r border-border-light dark:border-border-dark flex flex-col bg-surface-light dark:bg-surface-dark">
    <div class="p-4 border-b border-border-light dark:border-border-dark flex justify-between">
        <p class="text-2xl font-bold leading-tight tracking-tight">
            Inbox
        </p>
        <label class="flex flex-col w-70">
            <div class="flex w-full flex-1 items-stretch rounded h-11">
                <div class="text-text-secondary-light dark:text-text-secondary-dark flex bg-background-light dark:bg-background-dark items-center justify-center pl-3 rounded-l">
                    <span class="material-symbols-outlined text-xl">search</span>
                </div>
                <input
                    wire:model.live="search"
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded text-text-primary-light dark:text-text-primary-dark focus:outline-0 focus:ring-0 border-none bg-background-light dark:bg-background-dark focus:border-none h-full placeholder:text-text-secondary-light dark:placeholder:text-text-secondary-dark px-2 rounded-l-none text-sm font-normal leading-normal"
                    placeholder="Search messages..." />
            </div>
        </label>
    </div>
    <div class="p-4 border-b border-border-light dark:border-border-dark">
        <div class="flex gap-2 pt-3 overflow-x-auto">
            <button
                wire:click="setPortfolio()"
                class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded {{ !$selectedPortfolio ? 'bg-primary/10 text-primary' : 'bg-background-light dark:bg-background-dark hover:bg-primary/10 hover:text-primary' }} px-3">
                <p class="text-sm font-medium leading-normal">
                    All Portfolios
                </p>
            </button>
            @foreach($this->portfolios as $portfolio)
            <button
                wire:click="setPortfolio({{ $portfolio->id }})"
                class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded {{ $selectedPortfolio == $portfolio->id ? 'bg-primary/10 text-primary' : 'bg-background-light dark:bg-background-dark hover:bg-primary/10 hover:text-primary' }} px-3">
                <p class="text-sm font-medium leading-normal">
                    {{ $portfolio->title }}
                    @if($portfolio->messages_count > 0)
                    <span class="ml-1 text-xs bg-primary/20 px-1.5 py-0.5 rounded-full">{{ $portfolio->messages_count }}</span>
                    @endif
                </p>
            </button>
            @endforeach
        </div>
    </div>
    <div class="flex-1 overflow-y-auto">
        @foreach($this->messages as $message)
        <a href="{{route('user.messages.show', $message->uid)}}" 
            @class([
                'flex gap-x-3 p-4 flex-col cursor-pointer',
                'bg-primary/10 border-l-4 border-primary' => !$message->read,
                'border-b border-border-light dark:border-border-dark hover:bg-primary/5' => $message->read
            ])>
            <div class="flex justify-between items-start">
                <div class="flex items-center gap-2">
                    <p class="text-base font-bold text-text-primary-light dark:text-text-primary-dark">
                        {{ $message->name }}
                    </p>
                </div>
                <p class="text-xs text-text-secondary-light dark:text-text-secondary-dark">
                    {{ $message->created_at->diffForHumans() }}
                </p>
            </div>
            <p class="text-xs text-text-secondary-light dark:text-text-secondary-dark mt-1 pl-6">
                {{ Str::limit($message->message, 100) }}
            </p>
            <span class="text-xs font-medium bg-blue-200 text-blue-800 self-start rounded px-2 py-0.5 mt-2 ml-6">
                {{ $message->portfolio->title }}
            </span>
        </a>
        @endforeach
    </div>
</div>
{{-- </x-layouts.app> --}}
