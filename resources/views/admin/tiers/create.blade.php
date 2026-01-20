<x-layouts.app>
<div class="mx-auto max-w-4xl px-4 py-8">
    <h1 class="text-text-light dark:text-text-dark text-3xl font-black tracking-tighter mb-6">Create Tier</h1>

    <div class="bg-card-light dark:bg-card-dark shadow-md rounded-lg p-6 border border-border-light dark:border-border-dark">
        <form method="POST" action="{{ route('admin.tier.store') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-text-light dark:text-text-dark">Tier Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                @error('name') <p class="text-background-danger text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-sm font-medium text-text-light dark:text-text-dark">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                <p class="text-subtle-light dark:text-subtle-dark text-xs mt-1">Used to reference this tier in code</p>
                @error('slug') <p class="text-background-danger text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-text-light dark:text-text-dark">Description</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm focus:ring-primary focus:border-primary">{{ old('description') }}</textarea>
                @error('description') <p class="text-background-danger text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold text-text-light dark:text-text-dark mb-4">Features</h3>
                <div class="space-y-3 bg-background-light dark:bg-background-dark p-4 rounded-md border border-border-light dark:border-border-dark">
                    @forelse ($features as $feature)
                        <div class="flex items-start gap-3">
                            <input type="checkbox" name="features[{{ $feature->id }}][enabled]" id="feature_{{ $feature->id }}" value="1" class="mt-1 rounded border-border-light dark:border-border-dark text-primary shadow-sm focus:ring-primary">
                            <div class="flex-1">
                                <label for="feature_{{ $feature->id }}" class="block text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ $feature->name }}
                                </label>
                                <p class="text-xs text-subtle-light dark:text-subtle-dark mt-1">{{ $feature->description }}</p>
                                <div class="mt-2">
                                    @if ($feature->type === 'boolean')
                                        <div class="flex items-center">
                                            <input type="hidden" name="features[{{ $feature->id }}][value]" value="0">
                                            <input type="checkbox" 
                                                name="features[{{ $feature->id }}][value]" 
                                                id="switch_{{ $feature->id }}" 
                                                value="1"
                                                class="w-10 h-6 bg-primary/20 rounded-full appearance-none cursor-pointer transition-colors checked:bg-primary" 
                                                />
                                            
                                        </div>
                                    @else
                                        <input type="text" 
                                            name="features[{{ $feature->id }}][value]" 
                                            placeholder="{{ $feature->type === 'integer' ? 'Enter number' : 'Enter value' }}"
                                            class="mt-1 block w-full max-w-xs border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark rounded-md shadow-sm text-xs p-2 focus:ring-primary focus:border-primary">
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-subtle-light dark:text-subtle-dark text-sm">No features available. <a href="{{ route('admin.feature.create') }}" class="text-primary hover:opacity-80">Create one</a></p>
                    @endforelse
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.tier.index') }}" class="bg-subtle-light hover:opacity-80 text-text-dark font-bold py-2 px-4 rounded">Cancel</a>
                <button type="submit" class="bg-primary hover:opacity-90 text-text-dark font-bold py-2 px-4 rounded">Create Tier</button>
            </div>
        </form>
    </div>
</div>
</x-layouts.app>
