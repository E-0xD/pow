<![CDATA[<div class="bg-white p-6 rounded-lg shadow-sm">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Education</h3>
        <button type="button" 
                wire:click="addEducation"
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Education
        </button>
    </div>

    <div class="space-y-6">
        @foreach($education as $index => $edu)
            <div class="border rounded-md p-4 relative">
                <button type="button"
                        wire:click="removeEducation({{ $index }})"
                        class="absolute top-2 right-2 text-gray-400 hover:text-red-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">School/University</label>
                        <input type="text"
                               wire:model="education.{{ $index }}.school"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               placeholder="Institution name">
                        @error("education.{$index}.school")
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Degree/Certificate</label>
                        <input type="text"
                               wire:model="education.{{ $index }}.degree"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               placeholder="Degree or certificate name">
                        @error("education.{$index}.degree")
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Year of Admission</label>
                        <input type="number"
                               wire:model="education.{{ $index }}.year_of_admission"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               min="1900"
                               max="{{ date('Y') }}">
                        @error("education.{$index}.year_of_admission")
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Year of Graduation</label>
                        <input type="number"
                               wire:model="education.{{ $index }}.year_of_graduation"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               min="1900"
                               max="{{ date('Y') + 10 }}">
                        @error("education.{$index}.year_of_graduation")
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>]]>