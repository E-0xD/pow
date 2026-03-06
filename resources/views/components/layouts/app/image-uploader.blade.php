@props([
    'name' => 'thumbnail',
    'model' => null,
    'old' => null,
    'placeholderIcon' => 'cloud_upload',
    'placeholderText' => 'Click to upload or drag and drop',
    'placeholderSubText' => 'PNG, JPG or GIF (MAX. 2MB)',
    'height' => 'h-64',
    'wire' => true,
])

@php
    $inputId = str_replace('.', '_', $name);

    $initialPreview = match(true) {
        $model instanceof \Livewire\TemporaryUploadedFile => $model->temporaryUrl(),
        !empty($old) => Storage::url($old),
        default => '',
    };
@endphp

<div
    wire:key="{{ $inputId }}-{{ $initialPreview ? crc32($initialPreview) : 'empty' }}"
    x-data="{ previewUrl: '{{ $initialPreview }}' }"
    class="flex items-center justify-center w-full"
>
    <label for="{{ $inputId }}"
        class="relative flex flex-col items-center justify-center w-full {{ $height }}
               border-2 border-dashed rounded-xl cursor-pointer
               transition-colors overflow-hidden
               bg-gray-50 dark:bg-gray-900
               hover:bg-gray-100 dark:hover:bg-gray-800"
        :class="previewUrl ? 'border-transparent' : 'border-gray-300 dark:border-gray-600'"
    >
        {{-- Preview --}}
        <img
            x-show="previewUrl"
            x-cloak
            :src="previewUrl"
            class="absolute inset-0 w-full h-full object-contain p-1 rounded-xl"
            alt="Preview image"
        />

        {{-- Placeholder --}}
        <div
            x-show="!previewUrl"
            class="flex flex-col items-center justify-center text-center px-4"
        >
            <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 text-5xl mb-2">
                {{ $placeholderIcon }}
            </span>
            <p class="text-sm text-gray-600 dark:text-gray-300 font-medium">{{ $placeholderText }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $placeholderSubText }}</p>
        </div>
    </label>

    <input
        id="{{ $inputId }}"
        name="{{ $name }}"
        type="file"
        accept="image/*"
        @if ($wire) wire:model="{{ $name }}" @endif
        x-on:change="
            const file = $event.target.files[0];
            if (file?.type.startsWith('image/')) {
                previewUrl = URL.createObjectURL(file);
            }
        "
        class="hidden"
    />
</div>