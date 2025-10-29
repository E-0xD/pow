<x-layouts.app>
    <div class="mx-auto flex max-w-7xl flex-col gap-6">
        <!-- PageHeading -->
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h1 class="text-4xl font-black tracking-tighter text-text-light dark:text-text-dark">
                Portfolio Templates
            </h1>
            <button
                class="flex h-12 min-w-[84px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg bg-primary px-5 text-white shadow-lg shadow-primary/30 transition-all hover:bg-primary/90">
                <span class="material-symbols-outlined">add</span>
                <a href="{{ route('admin.portfolio.create') }}" class="truncate text-sm font-bold">Add New Template</a>
            </button>
        </div>
        <!-- Search and Filters -->
        <div class="flex flex-wrap items-center gap-4">
            <!-- SearchBar -->
            <div class="flex-1">
                <label class="flex h-12 min-w-64 flex-col">
                    <div class="flex h-full w-full flex-1 items-stretch rounded-lg">
                        <div
                            class="flex items-center justify-center rounded-l-lg border border-r-0 border-border-light bg-white pl-4 text-subtle-light dark:border-border-dark dark:bg-gray-800 dark:text-subtle-dark">
                            <span class="material-symbols-outlined text-2xl">search</span>
                        </div>
                        <input
                            class="form-input h-full min-w-0 flex-1 resize-none overflow-hidden rounded-r-lg border border-l-0 border-border-light bg-white px-4 text-base font-normal leading-normal text-text-light placeholder:text-subtle-light focus:border-primary focus:ring-0 dark:border-border-dark dark:bg-gray-800 dark:text-text-dark dark:placeholder:text-subtle-dark"
                            placeholder="Search templates by name..." value="" />
                    </div>
                </label>
            </div>
            <!-- Chips/Filters -->
            <div class="flex gap-2">
                <button
                    class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-primary/10 px-4 text-primary dark:bg-primary/20">
                    <p class="text-sm font-medium leading-normal">
                        All
                    </p>
                </button>
                <button
                    class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-lg border border-border-light bg-white px-4 hover:bg-gray-50 dark:border-border-dark dark:bg-gray-800 dark:hover:bg-gray-700">
                    <p class="text-sm font-medium leading-normal text-subtle-light dark:text-subtle-dark">
                        Published
                    </p>
                </button>
                <button
                    class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-lg border border-border-light bg-white px-4 hover:bg-gray-50 dark:border-border-dark dark:bg-gray-800 dark:hover:bg-gray-700">
                    <p class="text-sm font-medium leading-normal text-subtle-light dark:text-subtle-dark">
                        Draft
                    </p>
                </button>
            </div>
        </div>
        <!-- ImageGrid -->
        <div class="grid grid-cols-[repeat(auto-fill,minmax(280px,1fr))] gap-6">

            @foreach ($portfolios as $portfolio)
                <div
                    class="group relative flex flex-col overflow-hidden rounded-lg border border-border-light bg-white shadow-sm transition-all hover:shadow-lg dark:border-border-dark dark:bg-gray-800">
                    <div class="aspect-video w-full bg-cover bg-center bg-no-repeat"
                        data-alt="Minimalist Grid Template Thumbnail"
                        style="
                                    background-image: url({{ Storage::url($portfolio->thumbnail_path) }});
                                ">
                    </div>
                    <div class="flex flex-1 items-start justify-between gap-4 p-4">
                        <div class="flex flex-col">
                            <p class="font-bold text-text-light dark:text-text-dark">
                                {{ $portfolio->title }}
                            </p>
                            <span
                                class="text-xs font-semibold text-green-500">{{ ucFirst($portfolio->status->value) }}</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('admin.portfolio.edit', $portfolio->uid) }}"
                                class="flex size-8 items-center justify-center rounded-full text-subtle-light transition-colors hover:bg-gray-100 hover:text-text-light dark:text-subtle-dark dark:hover:bg-gray-700 dark:hover:text-text-dark">
                                <span class="material-symbols-outlined text-xl">edit</span>
                            </a>
                            <form action="{{ route('admin.portfolio.destroy', $portfolio->uid) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="flex size-8 items-center justify-center rounded-full text-subtle-light transition-colors hover:bg-red-50 hover:text-danger dark:text-subtle-dark dark:hover:bg-red-500/10 dark:hover:text-danger">
                                    <span class="material-symbols-outlined text-xl">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
