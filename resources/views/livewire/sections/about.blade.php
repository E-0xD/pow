<![CDATA[<div class="bg-white p-6 rounded-lg shadow-sm">
    <h3 class="text-lg font-semibold mb-4">About Section</h3>
    <div class="space-y-4">
        <div>
            <label for="about.name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" 
                   id="about.name" 
                   wire:model="about.name" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   placeholder="Your full name">
            @error('about.name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="about.logo" class="block text-sm font-medium text-gray-700">Logo/Avatar</label>
            <div class="mt-1 flex items-center space-x-4">
                @if($about['logo'] ?? null)
                    <div class="w-20 h-20 rounded-full overflow-hidden">
                        <img src="{{ $about['logo']->temporaryUrl() }}" alt="Preview" class="w-full h-full object-cover">
                    </div>
                @endif
                <input type="file" 
                       id="about.logo" 
                       wire:model="about.logo"
                       class="block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-full file:border-0
                              file:text-sm file:font-semibold
                              file:bg-indigo-50 file:text-indigo-700
                              hover:file:bg-indigo-100">
                @error('about.logo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="about.brief" class="block text-sm font-medium text-gray-700">Brief Description</label>
            <input type="text" 
                   id="about.brief" 
                   wire:model="about.brief"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   placeholder="A short description about yourself">
            @error('about.brief')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="about.description" class="block text-sm font-medium text-gray-700">Full Description</label>
            <textarea id="about.description" 
                      wire:model="about.description"
                      rows="4"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                      placeholder="Tell your story"></textarea>
            @error('about.description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>]]>