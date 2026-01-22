@props([
    'scope' => 'col',
])

<th {{ $attributes->merge(['class' => 'px-6 py-3 text-text-light dark:text-text-dark uppercase']) }} scope="{{ $scope }}">
    {{ $slot }}
</th>
