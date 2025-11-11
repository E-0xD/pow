<x-layouts.app>
    <div class="max-w-4xl mx-auto">

        <div class="sticky top-0 z-10 bg-secondary dark:bg-background-dark py-4 -mt-2">
            <div class="flex flex-wrap justify-between items-center gap-4">
                <div class="flex flex-col">
                    <h1 class="text-text-primary dark:text-white text-3xl font-bold leading-tight">
                        Portfolio Settings
                    </h1>
                    <p class="text-text-secondary dark:text-gray-400 text-base font-normal leading-normal mt-1">
                        Manage and customize your portfolio's
                        appearance, SEO, and more.
                    </p>
                </div>

            </div>
        </div>

        <div class="mt-8 space-y-10">
            <form action="{{ route('user.portfolio.update', $portfolio) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf
                @method('PUT')
                <!-- General Section -->
                <section>
                    <h2
                        class="text-text-primary dark:text-white text-xl font-bold leading-tight tracking-tight pb-4 border-b border-gray-200 dark:border-gray-700">
                        General
                    </h2>
                    <div class="mt-6 space-y-6">
                        <label class="flex flex-col w-full">
                            <p class="text-text-primary dark:text-gray-200 text-base font-medium leading-normal pb-2">
                                Portfolio Title
                            </p>
                            <input name="title"
                                class="form-input w-full rounded-lg text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 h-12 px-4 text-base font-normal @error('title') border-danger @enderror"
                                placeholder="My Awesome Portfolio" value="{{ old('title', $portfolio->title) }}" />
                            @error('title')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </label>
                        <label class="flex flex-col w-full">
                            <p class="text-text-primary dark:text-gray-200 text-base font-medium leading-normal pb-2">
                                Portfolio URL
                            </p>
                            <div class="flex items-center">
                                <input name="slug"
                                    class="form-input flex-1 w-full min-w-0 rounded-none rounded-l-lg text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 h-12 px-4 text-base font-normal @error('slug') border-danger @enderror"
                                    placeholder="your-unique-slug" value="{{ old('slug', $portfolio->slug) }}" />
                                <span
                                    class="inline-flex items-center h-12 px-3 rounded-r-lg border border-r-0 border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-text-secondary dark:text-gray-400 text-sm">{{ parse_url(config('app.url'), PHP_URL_HOST) }}</span>
                            </div>
                            @error('slug')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </label>
                        <!-- Visibility Toggle -->
                        <div>
                            <div
                                class="flex items-center justify-between p-4 rounded-lg bg-background-light dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                                <div>
                                    <p
                                        class="text-text-primary dark:text-gray-200 text-base font-medium leading-normal">
                                        Visibility
                                    </p>
                                    <p class="text-text-secondary dark:text-gray-400 text-sm">
                                        Toggle to make your portfolio
                                        public or private.
                                    </p>
                                </div>
                                <div x-data="{ on: '{{ old('visibility', $portfolio->visibility) }}' === 'public' }">
                                    <button type="button"
                                        @click="on = !on; $refs.visibilityInput.value = on ? 'public' : 'private'"
                                        :class="on ? 'bg-primary' : 'bg-gray-200 dark:bg-gray-700'"
                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent
                                                    transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                                        role="switch">

                                        <input type="hidden" name="visibility" x-ref="visibilityInput"
                                            :value="on ? 'public' : 'private'">

                                        <span :class="on ? 'translate-x-5' : 'translate-x-0'"
                                            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0
                                            transition duration-200 ease-in-out"></span>
                                    </button>
                                </div>

                            </div>
                            @error('visibility')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Accept Messages Toggle -->
                        <div>
                            <div
                                class="flex items-center justify-between p-4 rounded-lg bg-background-light dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                                <div>
                                    <p
                                        class="text-text-primary dark:text-gray-200 text-base font-medium leading-normal">
                                        Accept Messages
                                    </p>
                                    <p class="text-text-secondary dark:text-gray-400 text-sm">
                                        Show a contact form that allows visitors to send you a message.
                                    </p>
                                </div>
                                <div x-data="{ on: {{ old('accept_messages', $portfolio->accept_messages) ? 'true' : 'false' }} }">
                                    <button type="button"
                                        @click="on = !on; $refs.acceptMessagesInput.value = on ? 1 : 0"
                                        :class="on ? 'bg-primary' : 'bg-gray-200 dark:bg-gray-700'"
                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent
                                            transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                                        role="switch">

                                        <input type="hidden" name="accept_messages" x-ref="acceptMessagesInput"
                                            :value="on ? 1 : 0">

                                        <span :class="on ? 'translate-x-5' : 'translate-x-0'"
                                            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0
                                            transition duration-200 ease-in-out"></span>
                                    </button>
                                </div>
                            </div>
                            @error('accept_messages')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>
                @if (0 != 0)
                    <!-- Appearance Section -->
                    <section>
                        <h2
                            class="text-text-primary dark:text-white text-xl font-bold leading-tight tracking-tight pb-4  border-b border-gray-200 dark:border-gray-700">
                            Appearance
                        </h2>
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col w-full">
                                <p
                                    class="text-text-primary dark:text-gray-200 text-base font-medium leading-normal pb-2">
                                    Theme Color
                                </p>
                                <div
                                    class="flex items-center gap-3 p-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800">
                                    <input type="color" name="theme" class="size-8 rounded-md cursor-pointer"
                                        value="{{ old('theme', $portfolio->theme) }}">
                                    <span
                                        class="text-text-primary dark:text-white font-mono text-sm">{{ old('theme', $portfolio->theme) }}</span>
                                </div>
                                @error('theme')
                                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex flex-col w-full">
                                <p
                                    class="text-text-primary dark:text-gray-200 text-base font-medium leading-normal pb-2">
                                    Typography
                                </p>
                                <select name="typography"
                                    class="form-select w-full rounded-lg text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 h-12 px-4 text-base font-normal @error('typography') border-danger @enderror">
                                    <option value="modern-sans"
                                        {{ old('typography', $portfolio->typography) == 'modern-sans' ? 'selected' : '' }}>
                                        Modern Sans</option>
                                    <option value="serif-sans"
                                        {{ old('typography', $portfolio->typography) == 'serif-sans' ? 'selected' : '' }}>
                                        Serif &amp; Sans-serif
                                    </option>
                                    <option value="classic-serif"
                                        {{ old('typography', $portfolio->typography) == 'classic-serif' ? 'selected' : '' }}>
                                        Classic Serif</option>
                                </select>
                                @error('typography')
                                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </section>
                @endif
                <!-- SEO Section -->
                <section>
                    <h2
                        class="text-text-primary dark:text-white text-xl font-bold leading-tight tracking-tight pb-4 border-b border-gray-200 dark:border-gray-700">
                        SEO
                    </h2>
                    <div class="mt-6 space-y-6">
                        <label class="flex flex-col w-full">
                            <p class="text-text-primary dark:text-gray-200 text-base font-medium leading-normal pb-2">
                                Meta Title
                            </p>
                            <input name="meta_title"
                                class="form-input w-full rounded-lg text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 h-12 px-4 text-base font-normal @error('meta_title') border-danger @enderror"
                                placeholder="Title for search engines"
                                value="{{ old('meta_title', $portfolio->meta_title) }}" />
                            @error('meta_title')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </label>
                        <label class="flex flex-col w-full">
                            <p class="text-text-primary dark:text-gray-200 text-base font-medium leading-normal pb-2">
                                Meta Description
                            </p>
                            <textarea name="meta_description"
                                class="form-textarea w-full rounded-lg text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 p-4 text-base font-normal @error('meta_description') border-danger @enderror"
                                placeholder="A short description for search engines." rows="3">{{ old('meta_description', $portfolio->meta_description) }}</textarea>
                            @error('meta_description')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </label>
                        <div>
                            <p class="text-text-primary dark:text-gray-200 text-base font-medium leading-normal pb-2">
                                Favicon
                            </p>
                            <div class="flex items-center gap-4">
                                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-14 border border-gray-200 dark:border-gray-700 p-1"
                                    data-alt="current favicon"
                                    style="background-image: url('{{ $portfolio->favicon ? Storage::url($portfolio->favicon) : asset('images/default-favicon.png') }}');">
                                </div>
                                <div class="flex items-center justify-center w-full">
                                    <label
                                        class="flex flex-col items-center justify-center w-full h-28 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer bg-background-light dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <span
                                                class="material-symbols-outlined text-gray-500 dark:text-gray-400 text-3xl">upload_file</span>
                                            <p class="mb-2 text-sm text-text-secondary dark:text-gray-400">
                                                <span class="font-semibold">Click to
                                                    upload</span>
                                                or drag and drop
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                PNG, JPG, or ICO
                                                (max. 1MB)
                                            </p>
                                        </div>
                                        <input name="favicon" class="hidden" type="file"
                                            accept=".png,.jpg,.ico" />
                                        @error('favicon')
                                            <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <button type="submit"
                    class="flex items-center justify-center rounded-lg h-10 mt-6  px-5 bg-primary text-white text-sm font-bold leading-normal tracking-wide shadow-sm hover:bg-primary/90">
                    <span class="truncate">Save Changes</span>
                </button>
            </form>
            <!-- Advanced Section -->
            <section>
                <h2
                    class="text-text-primary dark:text-white text-xl font-bold leading-tight tracking-tight pb-4 border-b border-gray-200 dark:border-gray-700">
                    Advanced
                </h2>
                @if (0 != 0)
                    <div
                        class="mt-6 bg-background-light dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                        <h3 class="text-text-primary dark:text-gray-200 text-base font-medium leading-normal">
                            Custom Domain
                        </h3>
                        <p class="text-text-secondary dark:text-gray-400 text-sm mt-1">
                            Connect your own domain to your
                            portfolio.
                        </p>
                        <div class="flex items-center gap-2 mt-4">
                            <input
                                class="form-input flex-1 w-full rounded-lg text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-900 h-11 px-4 text-base font-normal"
                                placeholder="e.g., yourdomain.com" />
                            <button
                                class="flex items-center justify-center rounded-lg h-11 px-4 bg-gray-200 dark:bg-gray-700 text-text-primary dark:text-white text-sm font-bold hover:bg-gray-300 dark:hover:bg-gray-600">
                                Connect
                            </button>
                        </div>
                    </div>
                @endif
                <div class="mt-6 border-2 border-danger/40 rounded-xl p-6">
                    <h3 class="text-red-500 font-bold text-lg">
                        Danger Zone
                    </h3>
                    <p class="text-text-secondary dark:text-gray-400 mt-2">
                        Once you delete your portfolio, there is
                        no going back. Please be certain.
                    </p>
                    <form action="{{ route('user.portfolio.destroy', $portfolio->uid) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="mt-4 flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-red-500 text-white text-sm font-bold leading-normal tracking-wide hover:bg-danger/90">
                            <span class="truncate">Delete Portfolio</span>
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-layouts.app>
