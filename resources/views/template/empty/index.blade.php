{{-- @foreach ($portfolio->sectionOrders->sortBy('position') as $sectionOrder)
    @switch($sectionOrder->section_id)
        @case('about')
            @include('template.************.about')
        @break

        @case('experience')
            @include('template.************.experience')
        @break

        @case('education')
            @include('template.************.education')
        @break

        @case('skills')
            @include('template.************.skills')
        @break

        @case('projects')
            @include('template.************.projects')
        @break
    @endswitch
@endforeach

@if ($portfolio->accept_messages)
    @include('template.**************.message')
@endif

<!-- /Javascript -->
<script src="{{ asset('js/analytics-tracker.js') }}"></script> --}}
