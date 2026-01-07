<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth; --primary_color: #1338f3;">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @include('partials.template-meta')

        <!-- Stylesheet -->
        <link rel="stylesheet" href="{{ asset('template_assets/drake/css/line-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template_assets/drake/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template_assets/drake/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template_assets/drake/css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template_assets/drake/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template_assets/drake/css/smooth-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('template_assets/drake/css/lightbox.min.css') }}">

        <link rel="stylesheet" href="{{ asset('template_assets/drake/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('template_assets/drake/css/responsive.css') }}">

    </head>

    <body class="home5-page">
        <video class="body-overlay" muted="" autoplay="" loop="">
            <source src="{{ asset('template_assets/drake/images/video5.mp4') }}" type="video/mp4">
        </video>

        <div class="page-loader">
            <div class="bounceball"></div>
        </div>

        @include('template.drake.header')

        @include('template.drake.user_bar')

        <main class="drake-main">
            <div id="smooth-wrapper">
                <div id="smooth-content">

                    @include('template.drake.user_bar')

                    @foreach ($portfolio->sectionOrders->sortBy('position') as $sectionOrder)
                        @switch($sectionOrder->section_id)
                            @case('about')
                                @include('template.drake.about')
                            @break

                            @case('experience')
                                @include('template.drake.experience')
                            @break

                            @case('education')
                                @include('template.drake.education')
                            @break

                            @case('skills')
                                @include('template.drake.skills')
                            @break

                            @case('projects')
                                @include('template.drake.projects')
                            @break
                        @endswitch
                    @endforeach

                    @if ($portfolio->accept_messages)
                        @include('template.drake.message')
                    @endif
                    
                </div>
            </div>
        </main>

        <script src="{{ asset('template_assets/drake/js/jquery.js') }}"></script>
        <script src="{{ asset('template_assets/drake/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('template_assets/drake/js/owl.carousel.js') }}"></script>
        <script src="{{ asset('template_assets/drake/js/gsap.min.js') }}"></script>
        <script src="{{ asset('template_assets/drake/js/ScrollTrigger.min.js') }}"></script>
        <script src="{{ asset('template_assets/drake/js/ScrollToPlugin.min.js') }}"></script>
        <script src="{{ asset('template_assets/drake/js/lightbox.min.js') }}"></script>

        <script src="{{ asset('template_assets/drake/js/main.js') }}"></script>
        <script src="{{ asset('template_assets/drake/js/ajax-form.js') }}"></script>
        <script src="{{ asset('template_assets/drake/js/color.js') }}"></script>
        <script src="{{ asset('js/analytics-tracker.js') }}"></script>
    </body>

</html>
