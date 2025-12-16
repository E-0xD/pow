@props([
    'name' => 'thumbnail',
    'model' => null, // Livewire TemporaryUploadedFile
    'old' => null,   // Stored image path
    'placeholderIcon' => 'cloud_upload',
    'placeholderText' => 'Click to upload or drag and drop',
    'placeholderSubText' => 'PNG, JPG or GIF (MAX. 2MB)',
    'height' => 'h-64',
])

@php
    $inputId = str_replace('.', '_', $name);
@endphp

<div class="flex items-center justify-center w-full">
    <label for="{{ $inputId }}"
        class="relative flex flex-col items-center justify-center w-full {{ $height }}
               border-2 border-dashed rounded-xl cursor-pointer
               bg-gray-50 dark:bg-gray-800/50
               hover:bg-gray-100 dark:hover:bg-gray-800
               transition-colors overflow-hidden">

        {{-- ✅ Existing stored image --}}
        @if ($old)
            <img
                src="{{ Storage::url($old) }}"
                class="absolute inset-0 w-full h-full object-cover rounded-xl"
                alt="Uploaded image"
            />

        {{-- ✅ Livewire instant preview --}}
        @elseif ($model instanceof \Livewire\TemporaryUploadedFile)
            <img
                src="{{ $model->temporaryUrl() }}"
                class="absolute inset-0 w-full h-full object-cover rounded-xl"
                alt="Preview image"
            />

        {{-- ✅ Placeholder --}}
        @else
            <div class="flex flex-col items-center justify-center text-center px-4">
                <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 text-5xl mb-2">
                    {{ $placeholderIcon }}
                </span>
                <p class="text-sm text-gray-600 dark:text-gray-300 font-medium">
                    {{ $placeholderText }}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    {{ $placeholderSubText }}
                </p>
            </div>
        @endif
    </label>

    {{-- 🔗 Hidden file input --}}
    <input
        id="{{ $inputId }}"
        name="{{ $name }}"
        type="file"
        accept="image/*"
        wire:model="{{ $name }}"
        class="hidden"
    />
</div>
