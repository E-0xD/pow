<x-layouts.app>
    <div class="max-w-4xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Edit Portfolio Subscription</h1>
            <a href="{{ route('admin.user.show', $portfolio->user) }}" class="text-sm text-primary">Back to user</a>
        </div>

        <div class="bg-white dark:bg-card-dark rounded-xl p-6">
            <div class="mb-6">
                <h2 class="text-lg font-semibold">{{ $portfolio->title }}</h2>
                <p class="text-sm text-gray-500">Template: {{ $portfolio->template?->title }}</p>
            </div>

            <form action="{{ route('admin.portfolio.update', $portfolio) }}" method="post">
                @csrf
                @method('put')

                <div>
                    <label class="block text-sm font-medium">Template</label>
                    <select name="template_id"
                        class="form-input rounded-md h-10 w-full text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800">
                        @foreach ($templates as $template)
                            <option value="{{ $template->id }}" @if (old('template_id', $portfolio?->template_id) == $template->id) selected @endif>
                                {{ $template->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('template_id')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
