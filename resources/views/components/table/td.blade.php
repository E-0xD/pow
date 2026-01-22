@props([])

<td {{ $attributes->merge(['class' => 'px-6 py-4 text-text-light dark:text-text-dark']) }}>
    {{ $slot }}
</td>
