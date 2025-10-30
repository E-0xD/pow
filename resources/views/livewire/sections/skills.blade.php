<![CDATA[<div class="bg-white p-6 rounded-lg shadow-sm">
    <h3 class="text-lg font-semibold mb-4">Skills</h3>

    @foreach(\App\Enums\SkillType::cases() as $type)
        <div class="mb-6">
            <h4 class="text-md font-medium text-gray-700 mb-3">{{ $type->name }}</h4>
            <div class="grid grid-cols-3 gap-4">
                @foreach($skills->where('type', $type) as $skill)
                    <label class="inline-flex items-center">
                        <input type="checkbox"
                               wire:model="selectedSkills"
                               value="{{ $skill->id }}"
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2">{{ $skill->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach

    @error('selectedSkills')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>]]>