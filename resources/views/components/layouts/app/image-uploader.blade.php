@props([
    'name' => 'thumbnail',
    'model' => null, // Livewire model
    'old' => null,
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
        class="flex flex-col items-center justify-center w-full {{ $height }} border-2 border-dashed rounded-xl cursor-pointer bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">

        @if ($old)
            <img src="{{ Storage::url($old) }}" id="{{ $inputId }}-preview"
                class="w-full h-full object-cover rounded-xl" />
        @elseif($model && $model instanceof \Livewire\TemporaryUploadedFile)
            <img src="{{ $model->temporaryUrl() }}" id="{{ $inputId }}-preview"
                class="w-full h-full object-cover rounded-xl" />
        @else
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <span class="material-symbols-outlined text-gray-500 dark:text-gray-400" style="font-size:48px;">
                    {{ $placeholderIcon }}
                </span>
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                    <span class="font-semibold">{{ $placeholderText }}</span>
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $placeholderSubText }}</p>
            </div>
        @endif
    </label>

    <input id="{{ $inputId }}" name="{{ $name }}" type="file" accept="image/*"
        @if ($model) wire:model="{{ $model }}" @endif class="hidden" />
</div>
