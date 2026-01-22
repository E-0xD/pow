@props([
    'columns' => [],
])

<div class="grid grid-cols-1">
    <div class="bg-white dark:bg-[#20152d] rounded-xl overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            {{ $slot }}
        </table>
    </div>
</div>
