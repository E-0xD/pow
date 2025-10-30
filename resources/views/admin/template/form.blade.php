<x-layouts.app>
    <div class="max-w-4xl mx-auto">
        <!-- PageHeading -->
        <div class="flex flex-wrap justify-between gap-3 mb-8">
            <p class="text-gray-900 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">
                {{ isset($template) ? 'Edit Template' : 'Create New Template' }}
            </p>
        </div>
        <!-- Form Container -->
        <form action="{{ isset($template) ? route('admin.template.update', $template) : route('admin.template.store') }}"
            method="POST" enctype="multipart/form-data"
            class="bg-white dark:bg-gray-900/50 rounded-xl shadow-sm p-8 space-y-8">
            @csrf
            @if (isset($template))
                @method('PUT')
            @endif

            <!-- TextField: Template Title -->
            <div class="flex flex-wrap items-end gap-4">
                <label class="flex flex-col min-w-40 flex-1">
                    <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">Template Title
                    </p>
                    <input name="title"
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 border border-[#D1D5DB] dark:border-gray-700 bg-transparent dark:bg-background-dark focus:ring-2 focus:ring-primary/50 focus:border-primary h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-[15px] text-base font-normal leading-normal transition-all"
                        placeholder="Enter the title for the template"
                        value="{{ old('title', $template->title ?? '') }}" />
                    @error('title')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </label>
            </div>

            <!-- TitleText + SegmentedButtons: Status -->
            <div>
                <h2
                    class="text-gray-800 dark:text-gray-200 text-lg font-bold leading-tight tracking-[-0.015em] text-left pb-2">
                    Status
                </h2>
                <div class="flex">
                    <div
                        class="flex h-10 flex-1 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-800 p-1">
                        <label
                            class="flex cursor-pointer h-full grow items-center justify-center overflow-hidden rounded-md px-4 has-[:checked]:bg-white dark:has-[:checked]:bg-gray-700 has-[:checked]:shadow-sm has-[:checked]:text-gray-900 dark:has-[:checked]:text-white text-gray-500 dark:text-gray-400 text-sm font-medium leading-normal transition-colors">
                            <span class="truncate">Draft</span>
                            <input class="invisible w-0" name="status" type="radio" value="draft"
                                {{ old('status', $template->status ?? 'draft') == 'draft' ? 'checked' : '' }} />
                        </label>
                        <label
                            class="flex cursor-pointer h-full grow items-center justify-center overflow-hidden rounded-md px-4 has-[:checked]:bg-white dark:has-[:checked]:bg-gray-700 has-[:checked]:shadow-sm has-[:checked]:text-gray-900 dark:has-[:checked]:text-white text-gray-500 dark:text-gray-400 text-sm font-medium leading-normal transition-colors">
                            <span class="truncate">Published</span>
                            <input class="invisible w-0" name="status" type="radio" value="published"
                                {{ old('status', $template->status ?? '') == 'published' ? 'checked' : '' }} />
                        </label>
                    </div>
                </div>
                @error('status')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image Uploader -->
            <div>
                <h2
                    class="text-gray-800 dark:text-gray-200 text-lg font-bold leading-tight tracking-[-0.015em] text-left pb-2">
                    Thumbnail
                </h2>

                <div class="flex items-center justify-center w-full">
                    <label
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-[#D1D5DB] dark:border-gray-700 border-dashed rounded-xl cursor-pointer bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                        for="thumbnail">
                        @if (isset($template) && $template->thumbnail_path)
                            <img src="{{ Storage::url($template->thumbnail_path) }}"
                                class="w-full h-full object-cover rounded-xl" id="thumbnail-preview" />
                        @else
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <span class="material-symbols-outlined text-gray-500 dark:text-gray-400"
                                    style="font-size: 48px;">cloud_upload</span>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                    <span class="font-semibold">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or GIF (MAX. 2MB)</p>
                            </div>
                        @endif
                    </label>
                    <input id="thumbnail" class="hidden" name="thumbnail" type="file" accept="image/*" />
                </div>
                @error('thumbnail')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- TextField: file_path -->
            <div class="flex flex-wrap items-end gap-4">
                <label class="flex flex-col min-w-40 flex-1">
                    <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal pb-2">File Path</p>
                    <input name="file_path"
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 border border-[#D1D5DB] dark:border-gray-700 bg-transparent dark:bg-background-dark focus:ring-2 focus:ring-primary/50 focus:border-primary h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-[15px] text-base font-normal leading-normal transition-all"
                        placeholder="/template/location" value="{{ old('file_path', $template->file_path ?? '') }}" />
                    @error('file_path')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </label>
            </div>

            <!-- Tagging Input -->
            <div x-data="tags">
                <h2
                    class="text-gray-800 dark:text-gray-200 text-lg font-bold leading-tight tracking-[-0.015em] text-left pb-2">
                    Tags
                </h2>
                <div
                    class="relative flex items-center w-full max-w-lg p-2 border border-[#D1D5DB] dark:border-gray-700 rounded-lg bg-transparent dark:bg-background-dark focus-within:ring-2 focus-within:ring-primary/50 focus-within:border-primary transition-all">
                    <div class="flex flex-wrap gap-2 items-center">
                        <template x-for="tag in tags" :key="tag">
                            <span
                                class="flex items-center gap-1.5 bg-primary/20 text-primary dark:text-white dark:bg-primary/30 text-sm font-medium px-2 py-1 rounded-full">
                                <span x-text="tag"></span>
                                <button type="button" @click="removeTag(tag)" class="focus:outline-none">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">close</span>
                                </button>
                            </span>
                        </template>
                        <input x-model="newTag" @keydown.enter.prevent="addTag"
                            class="flex-1 min-w-[100px] bg-transparent border-0 focus:ring-0 text-gray-900 dark:text-white placeholder:text-gray-400 dark:placeholder:text-gray-500 text-base"
                            placeholder="Add a tag..." />
                    </div>
                    <input type="hidden" name="tags" :value="tags"   />
                </div>
                @error('tags')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200 dark:border-gray-800">
                <a href="{{ route('admin.template.index') }}"
                    class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 px-6 bg-subtle-light text-white dark:text-gray-200 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                    <span class="truncate">Cancel</span>
                </a>
                <button type="submit"
                    class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 px-6 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] shadow-md hover:shadow-lg transition-shadow">
                    <span class="truncate">{{ isset($template) ? 'Update Template' : 'Create Template' }}</span>
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('tags', () => ({
                    tags: {!! json_encode(old('tags', $template->tags ?? [])) !!},
                    newTag: '',
                    addTag() {
                        if (this.newTag.trim() !== '' && !this.tags.includes(this.newTag.trim())) {
                            this.tags.push(this.newTag.trim());
                        }
                        this.newTag = '';
                    },
                    removeTag(tagToRemove) {
                        this.tags = this.tags.filter(tag => tag !== tagToRemove);
                    }
                }));
            });

            // Preview image before upload
            document.getElementById('thumbnail')?.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.createElement('img');
                        preview.src = e.target.result;
                        preview.id = 'thumbnail-preview';
                        preview.className = 'w-full h-full object-cover rounded-xl';

                        const container = document.querySelector('label[for="thumbnail"]');
                        container.innerHTML = '';
                        container.appendChild(preview);
                    }
                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endpush
</x-layouts.app>
