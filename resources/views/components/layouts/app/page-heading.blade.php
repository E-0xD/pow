@props(['title', 'subtitle', 'link' => ['icon' => null, 'url' => null, 'text' => null]])

<div class="flex flex-wrap justify-between items-center gap-4 mb-8">
    <div class="flex min-w-72 flex-col gap-2">
        <p class="text-[#1F2937] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">
            {{ $title }}
        </p>
        <p class="text-[#6B7280] dark:text-gray-400 text-base font-normal leading-normal">
            {{ $subtitle }}
        </p>
    </div>

    @isset($link['url'])
        <a href="{{ $link['url'] }}"
           class="flex items-center justify-center gap-2 overflow-hidden rounded-lg h-12 px-6 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors shadow-sm">
            {!! $link['icon'] !!}
            <span class="truncate">{{ $link['text'] }}</span>
        </a>
    @endisset
</div>
