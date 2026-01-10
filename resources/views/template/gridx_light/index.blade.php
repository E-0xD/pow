<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @include('partials.template-meta')

        <link rel="stylesheet" href="{{ asset('template_assets/gridx/css/iconoir.css') }}">
        <link rel="stylesheet" href="{{ asset('template_assets/gridx/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template_assets/gridx/css/aos.css') }}">

        <link rel="stylesheet" href="{{ asset('template_assets/gridx/css/style-light.css') }}">
    </head>

    <body>

        <main class="main-homepage">

            <!-- Header -->
            @include('template.gridx_light.header')

            @include('template.gridx_light.user_bar')

            @php
                $sections = $portfolio->sectionOrders->sortBy('position');
                $experienceEducation = $sections
                    ->whereIn('section_id', ['experience', 'education'])
                    ->sortBy('position');
                $otherSections = $sections->whereNotIn('section_id', ['experience', 'education']);

                
                $expEduFirstPosition = $experienceEducation->first()?->position;
            @endphp

            @foreach ($otherSections as $sectionOrder)
                @switch($sectionOrder->section_id)
                    @case('about')
                        @include('template.gridx_light.about')
                    @break

                    @case('skills')
                        @include('template.gridx_light.skills')
                    @break

                    @case('projects')
                        @include('template.gridx_light.projects')
                    @break
                @endswitch

             
                @if (
                    $experienceEducation->isNotEmpty() &&
                        $expEduFirstPosition !== null &&
                        $sectionOrder->position < $expEduFirstPosition)
                    @php
                        $nextSection = $otherSections->where('position', '>', $sectionOrder->position)->first();
                        $shouldInject = !$nextSection || $nextSection->position > $expEduFirstPosition;
                    @endphp

                    @if ($shouldInject)
                        <section class="about-area">
                            <div class="container">
                                <div class="row mt-24">
                                    @foreach ($experienceEducation as $expEdu)
                                        @switch($expEdu->section_id)
                                            @case('experience')
                                                @include('template.gridx_light.experience')
                                            @break

                                            @case('education')
                                                @include('template.gridx_light.education')
                                            @break
                                        @endswitch
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endif
                @endif
            @endforeach

            @if ($portfolio->accept_messages)
                @include('template.gridx_light.message')
            @endif

        </main>

        <script src="{{ asset('template_assets/gridx/js/jquery-3.6.4.js') }}"></script>
        <script src="{{ asset('template_assets/gridx/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('template_assets/gridx/js/aos.js') }}"></script>
        <script src="{{ asset('template_assets/gridx/js/main.js') }}"></script>
    </body>

</html>
