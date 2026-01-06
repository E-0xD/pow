<!DOCTYPE html>
<!--[if IE 8]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
    <!--<![endif]-->

    <head>
        <!-- Basic Page Needs -->
        <meta charset="utf-8">
       

        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- Theme Style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('template_assets/gen_z_seven/css/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template_assets/gen_z_seven/css/odometer.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('template_assets/gen_z_seven/css/swiper-bundle.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template_assets/gen_z_seven/css/animateText.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('template_assets/gen_z_seven/css/jquery.fancybox.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template_assets/gen_z_seven/css/styles.css') }}">

        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
        <!-- Font -->
        <link rel="stylesheet" href="{{ asset('template_assets/gen_z_seven/font/fonts.css') }}">

        <!-- Icon -->
        <link rel="stylesheet" type="text/css"
            href="{{ asset('template_assets/gen_z_seven/icons/icomoon/style.css') }}">

             @include('partials.template-meta')
    </head>

    <body>
        <!-- wrapper -->
        <div id="wrapper" class="bg_dark counter-scroll">

            <video class="body-overlay" muted="" autoplay="" loop="" playsinline="">
                <source
                    src="{{ asset('template_assets/gen_z_seven/video/Particles-Slowly-Moving-In-Cyberspace.mp4') }}"
                    type="video/mp4">
            </video>

            <div class="tf-container w-2">

                <div class="row">
                    <div class="offset-xxl-4 col-xxl-7 offset-xl-4 col-xl-7 ">

                        <div class="main-content style-3 section-onepage">

                            @include('template.gen_z_seven.header')

                            <!-- user-bar -->
                            @include('template.gen_z_seven.user_bar')
                            <!-- End user-bar -->

                            @foreach ($portfolio->sectionOrders->sortBy('position') as $sectionOrder)
                                @switch($sectionOrder->section_id)
                                    @case('about')
                                        @include('template.gen_z_seven.about')
                                    @break

                                    @case('experience')
                                        @include('template.gen_z_seven.experience')
                                    @break

                                    @case('education')
                                        @include('template.gen_z_seven.education')
                                    @break

                                    @case('skills')
                                        @include('template.gen_z_seven.skills')
                                    @break

                                    @case('projects')
                                        @include('template.gen_z_seven.projects')
                                    @break
                                @endswitch
                            @endforeach

                            @if ($portfolio->accept_messages)
                                @include('template.gen_z_seven.message')
                            @endif

                        </div>

                    </div>
                </div>

                <div class="right-bar style-1 d-flex flex-column align-items-center">
                    <ul class="list-icon menu-option d-flex flex-column gap_8">

                        <li>
                            <div class="toggle-switch-mode"><i class="icon-Sun"></i></div>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
        <!-- /wrapper -->

        <div class="overlay-popup"></div>

        <!-- Javascript -->
        <script src="{{ asset('template_assets/gen_z_seven/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('template_assets/gen_z_seven/js/jquery.min.js') }}"></script>
        <script src="{{ asset('template_assets/gen_z_seven/js/odometer.min.js') }}"></script>
        <script src="{{ asset('template_assets/gen_z_seven/js/counter.js') }}"></script>
        <script src="{{ asset('template_assets/gen_z_seven/js/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('template_assets/gen_z_seven/js/carousel.js') }}"></script>
        <script src="{{ asset('template_assets/gen_z_seven/js/ScrollTrigger.min.js') }}"></script>
        <script src="{{ asset('template_assets/gen_z_seven/js/SplitText.min.js') }}"></script>
        <script src="{{ asset('template_assets/gen_z_seven/js/gsap.min.js') }}"></script>
        <script src="{{ asset('template_assets/gen_z_seven/js/handleGsap.js') }}"></script>
        <script src="{{ asset('template_assets/gen_z_seven/js/textanimation.js') }}"></script>
        <script src="{{ asset('template_assets/gen_z_seven/js/ScrollSmooth.js') }}"></script>
        <script src="{{ asset('template_assets/gen_z_seven/js/splitting.min.js') }}"></script>
        <script src="{{ asset('template_assets/gen_z_seven/js/jquery.fancybox.js') }}"></script>
        <script src="{{ asset('template_assets/gen_z_seven/js/main.js') }}"></script>

        <!-- /Javascript -->
        <script src="{{ asset('js/analytics-tracker.js') }}"></script>
    </body>

</html>
