<section 
    class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 
           bg-white dark:bg-gray-900/50 p-6 shadow-sm w-full max-w-4xl mx-auto">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] text-center sm:text-left">
            Contact
        </h2>

        <!-- Search / Add -->
        <div class="relative w-full sm:w-64">
            <input
                wire:model.live.debounce.300ms="contactSearch"
                class="form-input flex w-full rounded-lg border border-gray-300 dark:border-gray-700
                       bg-background-light dark:bg-background-dark text-gray-900 dark:text-gray-100
                       focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary h-10 px-4
                       placeholder:text-gray-400"
                placeholder="Search contact method..."
            />

            @if(!empty($searchResults))
                <ul class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-800 border border-gray-200 
                           dark:border-gray-700 rounded-lg shadow-md max-h-60 overflow-y-auto">
                    @foreach($searchResults as $method)
                        <li 
                            wire:click="selectMethod({{ $method['id'] }})"
                            class="flex items-center gap-2 px-4 py-2 cursor-pointer hover:bg-gray-100 
                                   dark:hover:bg-gray-700 transition">
                            <span class="material-symbols-outlined text-primary text-base">
                                {!! $method['logo'] !!}
                            </span>
                            <span class="text-gray-900 dark:text-gray-100">{{ $method['title'] }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <!-- Contact List -->
    <div class="flex flex-col gap-3 mt-4">
        @foreach($contacts as $index => $contact)
            <div class="flex flex-col gap-2 border rounded-xl border-gray-200 dark:border-gray-700 p-4">

                @if($contact['collapsed'])
                    <!-- Collapsed View -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="flex items-start sm:items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-xl shrink-0">
                                {!! $contact['logo'] !!}
                            </span>
                            <div class="min-w-0">
                                <p class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ $contact['method'] }}
                                </p>
                                <p class="text-gray-500 text-sm break-all">{{ $contact['value'] }}</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center justify-end gap-2">
                            <button type="button" 
                                wire:click="toggleCollapse({{ $index }})"
                                class="flex items-center gap-1 text-primary hover:text-primary/80 text-sm font-medium">
                                <span class="material-symbols-outlined text-base">edit</span>
                                Edit
                            </button>
                            <button type="button" 
                                wire:click="removeContact({{ $index }})"
                                class="flex items-center gap-1 text-red-500 hover:text-red-400 text-sm font-medium">
                                <span class="material-symbols-outlined text-base">delete</span>
                                Delete
                            </button>
                        </div>
                    </div>
                @else
                    <!-- Edit Form -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                        <div class="flex items-center gap-2 w-full sm:w-auto">
                            <span class="material-symbols-outlined text-primary text-xl shrink-0">{!! $contact['logo'] !!}</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $contact['method'] }}</span>
                        </div>

                        <input
                            wire:model="contacts.{{ $index }}.value"
                            class="form-input flex w-full rounded-lg text-gray-900 dark:text-gray-100 
                                   focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 
                                   dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary 
                                   h-12 placeholder:text-gray-400 px-4"
                            placeholder="Enter {{ $contact['method'] }} handle" />

                        <button type="button"
                            wire:click="saveContact({{ $index }})"
                            class="w-full sm:w-auto px-4 py-2 rounded-lg bg-primary/10 dark:bg-primary/20 text-primary font-medium 
                                   hover:bg-primary/20 dark:hover:bg-primary/30 transition">
                            Save
                        </button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</section>
