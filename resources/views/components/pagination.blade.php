@props(['paginator'])

@if ($paginator->hasPages())
<nav class="flex items-center justify-center mt-6" aria-label="Pagination">
    <div class="inline-flex -space-x-px rounded-lg overflow-hidden border border-border-light bg-card-light">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span
                class="px-3 py-2 text-sm text-subtle-light bg-background-light cursor-not-allowed">
                ‹
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="px-3 py-2 text-sm text-text-light bg-card-light hover:bg-background-light transition">
                ‹
            </a>
        @endif

        {{-- Pages --}}
        @foreach ($paginator->links()->elements[0] ?? [] as $page => $url)
            @if ($page == $paginator->currentPage())
                <span
                    class="px-4 py-2 text-sm font-semibold text-text-dark bg-primary">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $url }}"
                   class="px-4 py-2 text-sm text-text-light bg-card-light hover:bg-background-light transition">
                    {{ $page }}
                </a>
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="px-3 py-2 text-sm text-text-light bg-card-light hover:bg-background-light transition">
                ›
            </a>
        @else
            <span
                class="px-3 py-2 text-sm text-subtle-light bg-background-light cursor-not-allowed">
                ›
            </span>
        @endif

    </div>
</nav>
@endif
