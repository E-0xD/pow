
<div class="w-full max-w-7xl mx-auto">
    <!-- PageHeading & ToolBar -->
    <x-layouts.app.page-heading 
        title="Your Portfolio Messages"
        subtitle="View and manage all messages and inquiries sent through your portfolios." 
    />

      <div class="bg-white dark:bg-[#20152d] rounded-xl p-4 mb-6">
        <div class="flex flex-col lg:flex-row gap-3">
            <!-- Search Input -->
            <label class="flex flex-col w-full lg:flex-1">
                <div class="flex w-full flex-1 items-stretch rounded h-11">
                    <div
                        class="text-text-secondary-light dark:text-text-secondary-dark flex bg-background-light dark:bg-background-dark items-center justify-center pl-3 rounded-l">
                        <span class="material-symbols-outlined text-xl">search</span>
                    </div>
                    <input wire:model.live="search"
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded text-text-primary-light dark:text-text-primary-dark focus:outline-0 focus:ring-0 border-none bg-background-light dark:bg-background-dark focus:border-none h-full placeholder:text-text-secondary-light dark:placeholder:text-text-secondary-dark px-2 rounded-l-none text-sm font-normal leading-normal"
                        placeholder="Search messages..." />
                </div>
            </label>

            <!-- Portfolio Filter Dropdown -->
            <div class="relative w-full lg:w-64">
                <select wire:model.live="selectedPortfolio"
                    class="form-select w-full h-11 rounded bg-background-light dark:bg-background-dark text-text-primary-light dark:text-text-primary-dark border-none focus:outline-0 focus:ring-0 px-3 text-sm font-normal appearance-none cursor-pointer pr-10">
                    <option value="">All Portfolios</option>
                    @foreach ($this->portfolios as $portfolio)
                        <option value="{{ $portfolio->id }}">
                            {{ $portfolio->title }}
                            @if ($portfolio->messages_count > 0)
                                ({{ $portfolio->messages_count }})
                            @endif
                        </option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-text-secondary-light dark:text-text-secondary-dark">
                    <span class="material-symbols-outlined text-xl">expand_more</span>
                </div>
            </div>
        </div>
    </div>


    <div class="flex-1 overflow-y-auto">
        @forelse($this->messages as $message)
            <a href="{{ route('user.messages.show', $message->uid) }}" @class([
                'flex gap-x-3 p-4 flex-col cursor-pointer',
                'bg-primary/10 border-l-4 border-primary' => !$message->read,
                'border-b border-border-light dark:border-border-dark hover:bg-primary/5' =>
                    $message->read,
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
                <p class="text-xs text-text-secondary-light dark:text-text-secondary-dark mt-1">
                    {{ Str::limit($message->message, 100) }}
                </p>
                <span class="text-xs font-medium bg-blue-200 text-blue-800 self-start rounded px-2 py-0.5 mt-2">
                    {{ $message->portfolio->title }}
                </span>
            </a>
        @empty
            <div class="flex flex-col items-center justify-center gap-6 mt-16 text-center">
                <!-- Icon -->
                <div class="text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" fill="currentColor"
                        class="bi bi-chat-dots" viewBox="0 0 16 16">
                        <path
                            d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c-.13.435.317.812.731.594A11.934 11.934 0 0 0 8 14c3.314 0 6-1.79 6-4s-2.686-4-6-4-6 1.79-6 4c0 .864.426 1.667 1.078 2.293a1 1 0 0 1 .6.601z" />
                        <path
                            d="M5 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                    </svg>
                </div>

                <!-- Text -->
                <div class="flex max-w-md flex-col items-center gap-2">
                    <p class="text-gray-900 dark:text-white text-lg font-bold">No messages yet</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-normal">
                        When users contact you through your portfolio, their messages will appear here.
                    </p>
                </div>

                <!-- Optional Button (for portfolio creation shortcut) -->
                <a href="{{ route('user.portfolio.create') }}"
                    class="flex items-center justify-center gap-2 bg-primary rounded-lg h-10 px-4 text-white text-sm font-bold shadow-sm hover:opacity-90 transition-opacity">
                    <span class="material-symbols-outlined">add_circle</span>
                    <span class="truncate">Create Portfolio</span>
                </a>
            </div>
        @endforelse
    </div>
</div>

