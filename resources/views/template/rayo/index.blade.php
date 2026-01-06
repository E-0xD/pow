<!DOCTYPE html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="UTF-8">
        <!-- Viewport Meta-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- Template Styles Start -->
        <link rel="stylesheet" type="text/css" href="{{ asset('template_assets/rayo/css/loaders/loader.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template_assets/rayo/css/plugins.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template_assets/rayo/css/main.min.css') }}">
        <!-- Template Styles End -->

        <!-- Custom Browser Color Start -->
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="#FAF7F6">
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#161616">
        <meta name="msapplication-navbutton-color" content="#161616">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <!-- Custom Browser Color End -->
        @include('partials.template-meta')
    </head>

    <body>

        @include('template.rayo.header')

        <!-- Page Content Start -->
        <main id="mxd-page-content" class="mxd-page-content">

            @foreach ($portfolio->sectionOrders->sortBy('position') as $sectionOrder)
                @switch($sectionOrder->section_id)
                    @case('about')
                        @include('template.rayo.about')
                    @break

                    @case('experience')
                        @include('template.rayo.experience')
                    @break

                    @case('education')
                        @include('template.rayo.education')
                    @break

                    @case('skills')
                        @include('template.rayo.skills')
                    @break

                    @case('projects')
                        @include('template.rayo.projects')
                    @break
                @endswitch
            @endforeach

        </main>
        <!-- Page Content End -->

        <!-- Footer Start -->
        @include('template.rayo.message')
        <!-- Footer End -->

        <!-- To Top Button Start -->
        <a href="#0" id="to-top" class="btn btn-to-top slide-up anim-no-delay">
            <i class="ph ph-arrow-up"></i>
        </a>
        <!-- To Top Button End -->

        <!-- Load Scripts Start -->
        <script src="{{ asset('template_assets/rayo/js/libs.min.js') }}"></script>
        <script src="{{ asset('template_assets/rayo/js/app.min.js') }}"></script>
        <!-- counters -->
        <script src="{{ asset('js/analytics-tracker.js') }}"></script>
        <!-- Load Scripts End -->

    </body>

</html>
