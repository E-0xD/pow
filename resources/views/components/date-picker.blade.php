@props([
    'id' => 'dateInput',
    'name' => null,
    'label' => null,
    'wireModel' => null,
    'value' => null,

    /* modes: single | month | range | month-range */
    'mode' => 'single',

    'required' => false,
])

@php
    $placeholder = match ($mode) {
        'month' => 'MM/YYYY',
        'month-range' => 'MM/YYYY - MM/YYYY',
        'range' => 'DD/MM/YYYY - DD/MM/YYYY',
        default => 'DD/MM/YYYY',
    };
@endphp

<div class="w-full">
    @if ($label)
        <label for="{{ $id }}" class="block mb-1 text-sm font-medium text-gray-700">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        <input
            id="{{ $id }}"
            type="text"
            inputmode="numeric"
            autocomplete="off"
            {{ $name ? "name=$name" : '' }}
            @if ($wireModel) wire:model.defer="{{ $wireModel }}" @endif
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            oninput="maskDate(this, '{{ $mode }}')"
            class="block w-full rounded-xl border border-gray-300 bg-white py-2.5 px-3 text-sm
                   focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition"
        />
    </div>

    @error($wireModel)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

