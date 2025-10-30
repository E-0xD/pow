<![CDATA[<div class="bg-white p-6 rounded-lg shadow-sm">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Projects</h3>
        <button type="button" 
                wire:click="addProject"
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Project
        </button>
    </div>

    <div class="space-y-6">
        @foreach($projects as $index => $project)
            <div class="border rounded-md p-4 relative">
                <button type="button"
                        wire:click="removeProject({{ $index }})"
                        class="absolute top-2 right-2 text-gray-400 hover:text-red-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Project Title</label>
                        <input type="text"
                               wire:model="projects.{{ $index }}.title"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               placeholder="Project name">
                        @error("projects.{$index}.title")
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Brief Description</label>
                        <textarea wire:model="projects.{{ $index }}.brief_description"
                                  rows="2"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                  placeholder="Short description of the project"></textarea>
                        @error("projects.{$index}.brief_description")
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Project Link</label>
                        <input type="url"
                               wire:model="projects.{{ $index }}.project_link"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               placeholder="https://...">
                        @error("projects.{$index}.project_link")
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Thumbnail</label>
                        <div class="mt-1 flex items-center space-x-4">
                            @if(isset($projects[$index]['thumbnail']) && $projects[$index]['thumbnail'])
                                <div class="w-24 h-16 rounded overflow-hidden">
                                    <img src="{{ $projects[$index]['thumbnail']->temporaryUrl() }}" 
                                         alt="Preview" 
                                         class="w-full h-full object-cover">
                                </div>
                            @endif
                            <input type="file"
                                   wire:model="projects.{{ $index }}.thumbnail"
                                   class="block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-indigo-50 file:text-indigo-700
                                          hover:file:bg-indigo-100">
                        </div>
                        @error("projects.{$index}.thumbnail")
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Technologies Used</label>
                        <div class="grid grid-cols-3 gap-4">
                            @foreach($skills as $skill)
                                <label class="inline-flex items-center">
                                    <input type="checkbox"
                                           wire:model="projects.{{ $index }}.skills"
                                           value="{{ $skill->id }}"
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2">{{ $skill->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error("projects.{$index}.skills")
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>]]>