<x-layouts.app>
<div class="mx-auto max-w-4xl px-4 py-8">
    <h1 class="text-text-light dark:text-text-dark text-3xl font-black tracking-tighter mb-6">Create Feature</h1>

    <div class="bg-card-light dark:bg-card-dark shadow-md rounded-lg p-6 border border-border-light dark:border-border-dark">
        <form method="POST" action="{{ route('admin.feature.store') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-text-light dark:text-text-dark">Feature Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                @error('name') <p class="text-background-danger text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-sm font-medium text-text-light dark:text-text-dark">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                <p class="text-subtle-light dark:text-subtle-dark text-xs mt-1">Used to reference this feature in code</p>
                @error('slug') <p class="text-background-danger text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-text-light dark:text-text-dark">Type</label>
                <select name="type" id="type" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                    <option value="">Select Type</option>
                    <option value="boolean" {{ old('type') == 'boolean' ? 'selected' : '' }}>Boolean (Yes/No)</option>
                    <option value="string" {{ old('type') == 'string' ? 'selected' : '' }}>String (Text)</option>
                    <option value="integer" {{ old('type') == 'integer' ? 'selected' : '' }}>Integer (Number)</option>
                </select>
                @error('type') <p class="text-background-danger text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-text-light dark:text-text-dark">Description</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary">{{ old('description') }}</textarea>
                @error('description') <p class="text-background-danger text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.feature.index') }}" class="bg-subtle-light hover:opacity-80 text-text-dark font-bold py-2 px-4 rounded">Cancel</a>
                <button type="submit" class="bg-primary hover:opacity-90 text-text-dark font-bold py-2 px-4 rounded">Create Feature</button>
            </div>
        </form>
    </div>
</div>
</x-layouts.app>
