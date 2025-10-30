 <section
            class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/50 p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]">
                    Contact
                </h2>
                <button
                    wire:click="addContact"
                    class="flex items-center gap-2 min-w-[84px] cursor-pointer justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary/90 text-sm font-bold leading-normal transition-colors hover:bg-primary/20 dark:hover:bg-primary/30">
                    <span class="material-symbols-outlined text-base">add</span>
                    <span>Add Contact Method</span>
                </button>
            </div>
            <div class="flex flex-col gap-4">
                @foreach($contacts as $index => $contact)
                <div class="flex items-center gap-4">
                    <svg aria-hidden="true" class="size-6 text-gray-500" fill="currentColor" viewbox="0 0 24 24">
                        <path clip-rule="evenodd"
                            d="M12 2C6.477 2 2 6.477 2 12c0 4.286 2.866 7.91 6.837 9.19.5.092.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.031-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.001 10.001 0 0022 12c0-5.523-4.477-10-10-10z"
                            fill-rule="evenodd"></path>
                    </svg>
                    <span class="w-24 font-medium text-gray-800 dark:text-gray-200">{{ $contact['method_id'] }}</span>
                    <input
                        wire:model="contacts.{{ $index }}.value"
                        class="form-input flex w-full min-w-0 flex-1 rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4"
                        placeholder="Enter {{ $contact['method_id'] }} handle" />
                    <button
                        wire:click="removeContact({{ $index }})"
                        class="p-2 text-gray-500 dark:text-gray-400 hover:text-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900/30"><span
                            class="material-symbols-outlined text-base">delete</span></button>
                </div>
                @endforeach
                    <svg aria-hidden="true" class="size-6 text-gray-500" fill="currentColor" viewbox="0 0 24 24">
                        <path
                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z">
                        </path>
                    </svg>
                    <span class="w-24 font-medium text-gray-800 dark:text-gray-200">LinkedIn</span>
                    <input
                        class="form-input flex w-full min-w-0 flex-1 rounded-lg text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-gray-400 px-4"
                        placeholder="Your LinkedIn profile handle" />
                    <button
                        class="p-2 text-gray-500 dark:text-gray-400 hover:text-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900/30"><span
                            class="material-symbols-outlined text-base">delete</span></button>
                </div>
            </div>
        </section>