<x-layouts.app>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8" x-data="templateSelector()"
        @show-modal.window="showModal($event.detail)">

        <!-- Progress Bar -->
        <div class="flex flex-col gap-6">
          

            <!-- Heading -->
            <div class="flex flex-wrap justify-between gap-3 items-center">
                <div class="flex flex-col gap-2">
                    <h1 class="text-slate-900 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">
                        Select a Template to Begin
                    </h1>
                    <p class="text-slate-600 dark:text-slate-400 text-base font-normal leading-normal">
                        Choose a template that best fits your style or industry. You can customize it later.
                    </p>
                </div>
            </div>

            <!-- Toolbar -->
            {{-- <div
                class="flex justify-between items-center gap-4 py-3 border-t border-b border-slate-200/80 dark:border-slate-800">
                <div class="flex-1 relative">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500">search</span>
                    <input
                        class="w-full max-w-xs pl-10 pr-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all"
                        placeholder="Search templates..." type="text" />
                </div>
                <div class="flex gap-2 items-center">
                    <button class="chip">Industry<span
                            class="material-symbols-outlined text-lg">expand_more</span></button>
                    <button class="chip">Style<span
                            class="material-symbols-outlined text-lg">expand_more</span></button>
                    <button class="chip">Color<span
                            class="material-symbols-outlined text-lg">expand_more</span></button>
                </div>
            </div> --}}
        </div>

        <!-- Template Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
            <form x-ref="selectTemplateForm" method="POST" action="{{ route('user.portfolio.store') }}" class="hidden">
                @csrf
                <input type="hidden" name="template_id" x-model="selectedTemplate?.id">
            </form>

            @foreach ($templates as $template)
                <div class="group relative overflow-hidden rounded-xl bg-white dark:bg-slate-900 shadow-sm hover:shadow-xl transition-shadow duration-300 template-card cursor-pointer"
                    @click="showModal(@js($template))">
                    <div class="overflow-hidden">
                        <div class="bg-center bg-no-repeat aspect-[4/3] bg-cover rounded-t-xl transition-transform duration-300 template-image"
                            style='background-image: url({{ Storage::url($template->thumbnail_path) }});'>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">{{ $template->title }}</h3>
                        <div class="flex gap-2 mt-2">
                            <span
                                class="text-xs font-semibold text-primary bg-primary/10 px-2 py-1 rounded-full">Template</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal -->
        <div x-ref="modal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
            <div class="bg-white dark:bg-slate-900 w-full max-w-5xl h-[90vh] rounded-xl shadow-2xl flex flex-col">
                <header class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-slate-800">
                    <div>
                        <h2 x-text="'Preview: ' + (selectedTemplate?.title || '')"
                            class="text-xl font-bold text-slate-900 dark:text-white"></h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400"
                            x-text="selectedTemplate?.description || 'A beautiful template for your portfolio'"></p>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="flex items-center p-1 bg-slate-200 dark:bg-slate-800 rounded-lg">
                            <button class="text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 p-2 rounded-lg">
                                <span class="material-symbols-outlined">
                                    visibility
                                </span>
                            </button>

                        </div>
                        <button @click="closeModal()"
                            class="text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 p-2 rounded-lg">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                </header>

                <div class="flex-1 overflow-y-auto bg-slate-200 dark:bg-slate-900 p-8">
                    <div class="bg-center bg-no-repeat w-full h-[1200px] bg-cover shadow-lg rounded-md"
                        :style="`background-image: url('${selectedTemplate ? '{{ Storage::url('') }}' + selectedTemplate.thumbnail_path : ''}')`">
                    </div>
                </div>

                <footer class="p-4 border-t border-slate-200 dark:border-slate-800 flex justify-end">
                    <button type="button" @click="submitForm"
                        class="bg-primary text-white font-semibold py-3 px-8 rounded-lg hover:bg-primary/90 transition-colors">
                        Select This Template
                    </button>
                </footer>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('templateSelector', () => ({
                selectedTemplate: null,

                showModal(template) {
                    this.selectedTemplate = template;
                    this.$refs.modal.classList.remove('opacity-0', 'pointer-events-none');
                },

                closeModal() {
                    this.$refs.modal.classList.add('opacity-0', 'pointer-events-none');
                    this.selectedTemplate = null;
                },

                submitForm() {
                    this.$refs.selectTemplateForm.submit();
                },
            }));
        });
    </script>

    <style>
        .chip {
            @apply flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-white dark:bg-slate-900/50 border border-slate-300 dark:border-slate-700 px-4 text-slate-700 dark:text-slate-300 text-sm font-medium;
        }

        .nav-btn {
            @apply size-9 flex items-center justify-center rounded-lg border border-slate-300 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800;
        }

        .nav-btn-active {
            @apply size-9 flex items-center justify-center rounded-lg bg-primary text-white font-semibold;
        }
    </style>
</x-layouts.app>
