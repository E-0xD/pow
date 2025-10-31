


<!-- Message Detail Panel -->
<div class="col-span-12 md:col-span-8 lg:col-span-9 flex flex-col bg-background-light dark:bg-background-dark">
    <div class="p-4 border-b border-border-light dark:border-border-dark flex items-center justify-between min-h-[73px]">
        <a  href="{{ route('user.messages.index') }}"
            class="flex items-center justify-center p-2 rounded hover:bg-primary/10 text-text-secondary-light dark:text-text-secondary-dark hover:text-primary">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>

        <div class="flex gap-2">
            <button wire:click="markAsUnread"
                class="flex items-center justify-center p-2 rounded hover:bg-primary/10 text-text-secondary-light dark:text-text-secondary-dark hover:text-primary">
                <span class="material-symbols-outlined text-xl">mark_email_unread</span>
            </button>

            <button wire:click="delete" wire:confirm="Are you sure you want to delete this message?"
                class="flex items-center justify-center p-2 rounded hover:bg-primary/10 text-text-secondary-light dark:text-text-secondary-dark hover:text-primary">
                <span class="material-symbols-outlined text-xl">delete</span>
            </button>
        </div>
    </div>
    <div class="flex-1 overflow-y-auto p-6 md:p-8">
        <div class="max-w-4xl mx-auto">
            <div class="pb-6 border-b border-border-light dark:border-border-dark">
                <h2 class="text-2xl font-bold text-text-primary-light dark:text-text-primary-dark mb-2">
                    {{ $message->subject }}
                </h2>
                <div class="flex items-center gap-4">
                    <div>
                        <p class="font-semibold text-text-primary-light dark:text-text-primary-dark">
                            {{ $message->name }}
                        </p>
                        <p class="text-sm text-text-secondary-light dark:text-text-secondary-dark">
                            {{ $message->email }}
                        </p>
                    </div>
                    <div class="ml-auto text-right">
                        <p class="text-sm text-text-secondary-light dark:text-text-secondary-dark">
                            {{ $message->created_at->format('M d, Y, h:i A') }}
                        </p>
                        <p class="text-xs text-text-secondary-light dark:text-text-secondary-dark mt-1">
                            Received via
                            <span class="font-medium text-text-primary-light dark:text-text-primary-dark">
                                '{{ $message->portfolio->title }}'
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div
                class="prose prose-lg dark:prose-invert max-w-none text-text-primary-light dark:text-text-primary-dark py-8 space-y-4">
                {!! nl2br(e($message->message)) !!}
            </div>
        </div>
    </div>

</div>
