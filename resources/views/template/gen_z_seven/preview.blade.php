<!DOCTYPE html>
<!--[if IE 8]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE ]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->
    <title>{{config('app.name')}}</title>

    <meta name="author" content="themesflat.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('template_assets/gen_z_seven/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template_assets/gen_z_seven/css/odometer.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template_assets/gen_z_seven/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template_assets/gen_z_seven/css/animateText.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template_assets/gen_z_seven/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template_assets/gen_z_seven/css/styles.css')}}">

    <!-- Font -->
    <link rel="stylesheet" href="{{asset('template_assets/gen_z_seven/font/fonts.css')}}">

    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('template_assets/gen_z_seven/icons/icomoon/style.css')}}">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{('template_assets/gen_z_seven/images/logo/favicon.svg')}}">
    <link rel="apple-touch-icon-precomposed" href="{{('template_assets/gen_z_seven/images/logo/favicon.svg')}}">
</head>

<body>
    <!-- wrapper -->
    <div id="wrapper" class="bg_dark counter-scroll">

        <video class="body-overlay" muted="" autoplay="" loop="" playsinline="">
            <source src="{{asset('template_assets/gen_z_seven/video/Particles-Slowly-Moving-In-Cyberspace.mp4')}}" type="video/mp4">
        </video>

        <div class="tf-container w-2">

            <div class="row">
                <div class="offset-xxl-4 col-xxl-7 offset-xl-4 col-xl-7 ">

                    <div class="main-content style-3 section-onepage">

                        <div class="header position-sticky">
                            <div class="header-sidebar style-horizontal bs-light-mode">
                                <div class="box">
                                    <div class="avatar">
                                        <img src="{{asset(config('app.favicon'))}}" width="68" height="68" alt="avatar">
                                    </div>
                                    <div class="info">
                                        <h6 class="font-4 mb_4">{{config('app.name')}}</h6>
                                        <div class="text-label text-uppercase fw-6 text_primary-color font-3  letter-spacing-1">
                                            AI Developer</div>
                                    </div>
                                </div>
                                <ul class="nav-menu style-2 list-icon ">
                                    <li>
                                        <a class="nav_link active" href="#about">
                                            <i class="icon icon-User"></i>
                                            <span class="tooltip text-caption-1">About</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav_link" href="#resume">
                                            <i class="icon icon-ReadCvLogo"></i>
                                            <span class="tooltip text-caption-1">Resume</span>
                                        </a>
                                    </li>

                                     <li>
                                        <a class="nav_link" href="#skills">
                                            <i class="icon icon-ReadCvLogo"></i>
                                            <span class="tooltip text-caption-1">Skills</span>
                                        </a>
                                    </li>
                                   
                                    <li>
                                        <a class="nav_link" href="#portfolio">
                                            <i class="icon icon-Briefcase"></i>
                                            <span class="tooltip text-caption-1">Portfolio</span>
                                        </a>
                                    </li>
                                   
                                    <li>
                                        <a class="nav_link" href="#contact">
                                            <i class="icon icon-PaperPlaneTilt"></i>
                                            <span class="tooltip text-caption-1">Contact</span>
                                        </a>
                                    </li>
                                </ul>
                                <a class="menu-button show-menu-mobile  d-sm-none link-no-action" data-target="#menu-2" href="#"><i class="icon-CirclesFour"></i></a>
                               <div id="menu-2" class="popup-menu-mobile">
                                    <ul class="nav-menu style-3 ">
                                    
                                        <li class="text-menu text_white">
                                            <a href="#about" class="nav_link toggle splitting link link-no-action text-button font-3 fw-6">
                                                <span class="text" data-splitting="">About</span>
                                                <span class="text" data-splitting="">About</span>
                                            </a>
                                        </li>
                                        <li class="text-menu text_white">
                                            <a href="#resume" class="nav_link toggle splitting link link-no-action text-button font-3 fw-6">
                                                <span class="text" data-splitting="">Resume</span>
                                                <span class="text" data-splitting="">Resume</span>
                                            </a>
                                        </li>
                                     
                                        <li class="text-menu text_white">
                                            <a href="#portfolio" class="nav_link toggle splitting link link-no-action text-button font-3 fw-6">
                                                <span class="text" data-splitting="">Portfolio</span>
                                                <span class="text" data-splitting="">Portfolio</span>
                                            </a>
                                        </li>
                                   
                                        <li class="text-menu text_white">
                                            <a href="#contact" class="nav_link toggle splitting link link-no-action text-button font-3 fw-6">
                                                <span class="text" data-splitting="">Contact</span>
                                                <span class="text" data-splitting="">Contact</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- user-bar -->
                        <div class="user-bar userbar-fixed text-center bs-light-mode">

                            <div class="box-author mb_12">
                                <div class="img-style mb_16">
                                    <img decoding="async" loading="lazy" src="{{asset(config('app.favicon'))}}" width="314" height="314" alt="feature post">
                                </div>
                                <div class="info">
                                    <div class="name font-2 text_white mb_8">{{config('app.name')}}</div>
                                    <div class="text-label text-uppercase fw-6 text_primary-color font-3 mb_16 letter-spacing-1">
                                        AI
                                        Developer</div>
                                    <a href="mailto:themesflat@gmail.com" class="hover-underline-link text_white text-body-2 mb_4">{{config('mail.from.address')}}</a>
                                    {{-- <p class="text-caption-2 text_secondary-color font-3">Based in San Francisco, CA
                                    </p> --}}
                                </div>
                            </div>

                            <ul class="list-icon d-flex justify-content-center mb_28">
                                <li><a href="#" class="icon-LinkedIn"></a></li>
                                <li> <a href="#" class="icon-GitHub"></a></li>
                                <li><a href="{{config('socials.x')}}" class="icon-X"></a></li>
                                <li><a href="#" class="icon-dribbble"></a></li>
                            </ul>

                         

                            <a href="#contact" class="tf-btn style-1 animate-hover-btn btn-w-full">
                                <i class="icon-EnvelopeSimple"></i><span>Contact Me</span>
                            </a>

                            <div class="item-shape">
                                <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.png')}}" alt="item">
                            </div>

                        </div>
                        <!-- End user-bar -->

                        <!-- section-about -->
                        <div id="about" class="section-about v3 spacing-1 section">
                            <div>
                                <div class="heading-section mb_45">
                                    <div class="tag-heading text-uppercase text-label font-3 letter-spacing-1 mb_32">
                                        About
                                    </div>
                                    <div class="title-border-shape">
                                        <h4 class="animationtext clip "><span class="tf-text s1 cd-words-wrapper text_primary-color">
                                                <span class="item-text is-visible">AI Developer</span>
                                                <span class="item-text is-hidden">Data Scientist</span>
                                                <span class="item-text is-hidden">UI/UX Developer</span>
                                            </span> </h4>
                                        <div class="shape">
                                            <span class="shape-1"></span>
                                            <span class="shape-2"></span>
                                            <span class="shape-3"></span>
                                            <span class="shape-4"></span>
                                        </div>
                                        <div class="line">
                                            <span class="line-horizontal horizontal-1"></span>
                                            <span class="line-horizontal horizontal-2"></span>
                                            <span class="line-vertical vertical-1"></span>
                                            <span class="line-vertical vertical-2"></span>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="title mb_16 split-text effect-blur-fade">
                                    {{config('app.name')}}
                                </h1>
                                <p class="text_muted-color font-3 mb_43 split-text split-lines-transform">Hello! I'm
                                    {{config('app.name').', ' . config('app.desc')}}
                                   </p>
                                <div class="wrap-counter tf-grid-layout md-col-3">
                                    <div class="counter-item bs-light-mode">
                                        <div class="counter-number h2 text_white mb_7">
                                            <div class="odometer" data-number="10">1</div>
                                            <span class="sub">+</span>
                                        </div>
                                        <p class="text-body-1 text_muted-color font-3">Years in AI Development</p>
                                        <div class="item-shape">
                                            <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                        </div>
                                    </div>
                                    <div class="counter-item bs-light-mode">
                                        <div class="counter-number h2 text_white mb_7">
                                            <div class="odometer" data-number="500">100</div>
                                            <span class="sub">+</span>
                                        </div>
                                        <p class="text-body-1 text_muted-color font-3">Satisfied Clients</p>
                                        <div class="item-shape">
                                            <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                        </div>
                                    </div>
                                    <div class="counter-item bs-light-mode">
                                        <div class="counter-number h2 text_white mb_7">
                                            <div class="odometer" data-number="1">0</div>
                                            <span class="sub">k</span>
                                            <span class="sub">+</span>
                                        </div>
                                        <p class="text-body-1 text_muted-color font-3">Projects Completed</p>
                                        <div class="item-shape">
                                            <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End section-about -->

                        <!-- section-resume-->
                        <div id="resume" class="section-resume spacing-1 section">
                            <div class="heading-section mb_44">
                                <div class="tag-heading text-uppercase text-label font-3 letter-spacing-1 mb_30">
                                   Degrees and Certifications
                                </div>
                                <h3 class="text_white fw-5 split-text effect-blur-fade">Education</h3>
                            </div>
                            <div class="effect-line-hover">
                                <div class="wrap-education-item area-effect  scrolling-effect effectTop">
                                    <span class="point"></span>
                                    <div class="education-item">
                                        <div class="content">
                                            <h5 class="font-4 mb_4"><a href="#contact" class="link">AI Developer</a>
                                            </h5>
                                            <span class="text-body-1 font-3">Google Inc.</span>
                                        </div>
                                        <div class="date text-caption-1 text_white font-3">
                                            2020 - Present
                                        </div>
                                        <div class="item-shape spotlight">
                                            <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-education-item area-effect scrolling-effect effectTop">
                                    <span class="point"></span>
                                    <div class="education-item">
                                        <div class="content">
                                            <h5 class="font-4 mb_4"><a href="#contact" class="link">Machine Learning
                                                    Engineer</a></h5>
                                            <span class="text-body-1 font-3">Microsoft Inc.</span>
                                        </div>
                                        <div class="date text-caption-1 text_white font-3">
                                            2018 - 2020
                                        </div>
                                        <div class="item-shape spotlight">
                                            <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-education-item area-effect scrolling-effect effectTop">
                                    <span class="point"></span>
                                    <div class="education-item">
                                        <div class="content">
                                            <h5 class="font-4 mb_4"><a href="#contact" class="link">Data
                                                    Scientist</a>
                                            </h5>
                                            <span class="text-body-1 font-3">IBM Inc.</span>
                                        </div>
                                        <div class="date text-caption-1 text_white font-3">
                                            2014 - 2018
                                        </div>
                                        <div class="item-shape spotlight">
                                            <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-education-item area-effect scrolling-effect effectTop">
                                    <span class="point"></span>
                                    <div class="education-item">
                                        <div class="content">
                                            <h5 class="font-4 mb_4"><a href="#contact" class="link">M.Sc. in
                                                    Computer
                                                    Science</a></h5>
                                            <span class="text-body-1 font-3">Stanford University</span>
                                        </div>
                                        <div class="date text-caption-1 text_white font-3">
                                            2013 - 2014
                                        </div>
                                        <div class="item-shape spotlight">
                                            <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-education-item area-effect scrolling-effect effectTop">
                                    <span class="point"></span>
                                    <div class="education-item">
                                        <div class="content">
                                            <h5 class="font-4 mb_4"><a href="#contact" class="link">B.Sc. in
                                                    Information
                                                    Technolog</a></h5>
                                            <span class="text-body-1 font-3">Massachusetts Institute of
                                                Technology</span>
                                        </div>
                                        <div class="date text-caption-1 text_white font-3">
                                            2008 - 2013
                                        </div>
                                        <div class="item-shape spotlight">
                                            <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End section-resume -->

                              <!-- section-resume-->
                        <div id="resume" class="section-resume spacing-1 section">
                            <div class="heading-section mb_44">
                                <div class="tag-heading text-uppercase text-label font-3 letter-spacing-1 mb_30">
                                     Jobs and Contracts History
                                </div>
                                <h3 class="text_white fw-5 split-text effect-blur-fade">Experience</h3>
                            </div>
                            <div class="effect-line-hover">
                                <div class="wrap-education-item area-effect  scrolling-effect effectTop">
                                    <span class="point"></span>
                                    <div class="education-item">
                                        <div class="content">
                                            <h5 class="font-4 mb_4"><a href="#contact" class="link">AI Developer</a>
                                            </h5>
                                            <span class="text-body-1 font-3">Google Inc.</span>
                                        </div>
                                        <div class="date text-caption-1 text_white font-3">
                                            2020 - Present
                                        </div>
                                        <div class="item-shape spotlight">
                                            <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-education-item area-effect scrolling-effect effectTop">
                                    <span class="point"></span>
                                    <div class="education-item">
                                        <div class="content">
                                            <h5 class="font-4 mb_4"><a href="#contact" class="link">Machine Learning
                                                    Engineer</a></h5>
                                            <span class="text-body-1 font-3">Microsoft Inc.</span>
                                        </div>
                                        <div class="date text-caption-1 text_white font-3">
                                            2018 - 2020
                                        </div>
                                        <div class="item-shape spotlight">
                                            <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-education-item area-effect scrolling-effect effectTop">
                                    <span class="point"></span>
                                    <div class="education-item">
                                        <div class="content">
                                            <h5 class="font-4 mb_4"><a href="#contact" class="link">Data
                                                    Scientist</a>
                                            </h5>
                                            <span class="text-body-1 font-3">IBM Inc.</span>
                                        </div>
                                        <div class="date text-caption-1 text_white font-3">
                                            2014 - 2018
                                        </div>
                                        <div class="item-shape spotlight">
                                            <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-education-item area-effect scrolling-effect effectTop">
                                    <span class="point"></span>
                                    <div class="education-item">
                                        <div class="content">
                                            <h5 class="font-4 mb_4"><a href="#contact" class="link">M.Sc. in
                                                    Computer
                                                    Science</a></h5>
                                            <span class="text-body-1 font-3">Stanford University</span>
                                        </div>
                                        <div class="date text-caption-1 text_white font-3">
                                            2013 - 2014
                                        </div>
                                        <div class="item-shape spotlight">
                                            <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-education-item area-effect scrolling-effect effectTop">
                                    <span class="point"></span>
                                    <div class="education-item">
                                        <div class="content">
                                            <h5 class="font-4 mb_4"><a href="#contact" class="link">B.Sc. in
                                                    Information
                                                    Technolog</a></h5>
                                            <span class="text-body-1 font-3">Massachusetts Institute of
                                                Technology</span>
                                        </div>
                                        <div class="date text-caption-1 text_white font-3">
                                            2008 - 2013
                                        </div>
                                        <div class="item-shape spotlight">
                                            <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End section-resume -->

                        <!-- section-service -->
                        <div id="skills" class="section-service section spacing-1">
                            <div class="heading-section mb_43">
                                <div class="tag-heading text-uppercase text-label font-3 letter-spacing-1 mb_33">
                                    Skills
                                </div>
                                <h3 class="text_white fw-5  split-text effect-blur-fade">AI Solutions That Matter
                                </h3>
                            </div>
                            <div class="service-item area-effect scrolling-effect effectBottom">
                                <div class="content-inner d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center content">
                                        <span class="number text-label text_muted-color font-3">01/</span>
                                        <h5 class="text_white font-4"><a href="#contact" class="link">Custom AI
                                                Solutions</a></h5>
                                    </div>
                                    <a href="#contact" class="btn-arrow"><i class="icon-ArrowRight"></i></a>
                                    <div class="item-shape spotlight">
                                        <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                    </div>
                                </div>
                                <div class="img-hover">
                                    <img src="{{asset('template_assets/gen_z_seven/images/item/service-item-1.webp')}}" width="140" height="140" alt="item">
                                </div>

                            </div>
                            <div class="service-item area-effect scrolling-effect effectBottom">
                                <div class="content-inner d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center content">
                                        <span class="number text-label text_muted-color font-3">02/</span>
                                        <h5 class="text_white font-4"><a href="#contact" class="link">Data Analysis
                                                &
                                                Visualization</a>
                                        </h5>
                                    </div>
                                    <a href="#contact" class="btn-arrow"><i class="icon-ArrowRight"></i></a>
                                    <div class="item-shape spotlight">
                                        <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                    </div>
                                </div>
                                <div class="img-hover">
                                    <img src="{{asset('template_assets/gen_z_seven/images/item/service-item-2.webp')}}" width="140" height="140" alt="item">
                                </div>
                            </div>
                            <div class="service-item area-effect scrolling-effect effectBottom">
                                <div class="content-inner d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center content">
                                        <span class="number text-label text_muted-color font-3">03/</span>
                                        <h5 class="text_white font-4"><a href="#contact" class="link">Machine
                                                Learning
                                                Automation</a>
                                        </h5>
                                    </div>
                                    <a href="#contact" class="btn-arrow"><i class="icon-ArrowRight"></i></a>
                                    <div class="item-shape spotlight">
                                        <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                    </div>
                                </div>
                                <div class="img-hover">
                                    <img src="{{asset('template_assets/gen_z_seven/images/item/service-item-3.webp')}}" width="140" height="140" alt="item">
                                </div>
                            </div>
                            <div class="service-item area-effect scrolling-effect effectBottom">
                                <div class="content-inner d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center content">
                                        <span class="number text-label text_muted-color font-3">04/</span>
                                        <h5 class="text_white font-4"><a href="#contact" class="link">AI Consulting
                                                &
                                                Training</a></h5>
                                    </div>
                                    <a href="#contact" class="btn-arrow"><i class="icon-ArrowRight"></i></a>
                                    <div class="item-shape spotlight">
                                        <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" loading="lazy" decoding="async" alt="item">
                                    </div>
                                </div>
                                <div class="img-hover">
                                    <img src="{{asset('template_assets/gen_z_seven/images/item/service-item-4.webp')}}" width="140" height="140" alt="item">
                                </div>
                            </div>
                        </div>
                        <!-- End section-service -->

                        <!-- section-portfolio-->
                        <div id="portfolio" class="section-portfolio spacing-1 stack-element section">
                            <div class="heading-section mb_42">
                                <div class="tag-heading text-uppercase text-label font-3 letter-spacing-1 mb_34">
                                    Portfolio
                                </div>
                                <h3 class="text_white fw-5  split-text effect-blur-fade">Featured Projects</h3>
                            </div>
                            <div class="tabs-content-wrap">
                                <div class="portfolio-item element">
                                    <a href="{{asset('template_assets/gen_z_seven/images/user/portfolio-item-1.webp')}}" data-fancybox="gallery" class="img-style">
                                        <img decoding="async" loading="lazy" src="{{asset('template_assets/gen_z_seven/images/user/portfolio-item-1.webp')}}" width="690" height="388" alt="portfolio">
                                        <div class="tag font-3 text-label text-uppercase fw-6 letter-spacing-1">
                                            Conversational AI
                                        </div>
                                    </a>
                                    <h5 class=" title font-4 text_white"> <a href="#" class="link">AI-Powered
                                            Chatbot</a>
                                    </h5>
                                    <div class="item-shape">
                                        <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.png')}}" alt="item">
                                    </div>
                                </div>
                                <div class="portfolio-item element">
                                    <a href="{{asset('template_assets/gen_z_seven/images/user/portfolio-item-2.webp')}}" data-fancybox="gallery" class="img-style">
                                        <img decoding="async" loading="lazy" src="{{asset('template_assets/gen_z_seven/images/user/portfolio-item-2.webp')}}" width="690" height="388" alt="portfolio">
                                        <div class="tag font-3 text-label text-uppercase fw-6 letter-spacing-1">
                                            Computer Vision
                                        </div>
                                    </a>
                                    <h5 class=" title font-4 text_white"> <a href="#" class="link">Real-Time Object
                                            Detection</a></h5>
                                    <div class="item-shape">
                                        <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.png')}}" alt="item">
                                    </div>
                                </div>
                                <div class="portfolio-item element">
                                    <a href="{{asset('template_assets/gen_z_seven/images/user/portfolio-item-3.webp')}}" data-fancybox="gallery" class="img-style">
                                        <img decoding="async" loading="lazy" src="{{asset('template_assets/gen_z_seven/images/user/portfolio-item-3.webp')}}" width="690" height="388" alt="portfolio">
                                        <div class="tag font-3 text-label text-uppercase fw-6 letter-spacing-1">
                                            Predictive Analytics
                                        </div>
                                    </a>
                                    <h5 class=" title font-4 text_white"> <a href="#" class="link">Sales Forecast
                                            Dashboard</a>
                                    </h5>
                                    <div class="item-shape">
                                        <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.png')}}" alt="item">
                                    </div>
                                </div>
                                <div class="portfolio-item element">
                                    <a href="{{asset('template_assets/gen_z_seven/images/user/portfolio-item-4.webp')}}" class="img-style">
                                        <img decoding="async" loading="lazy" src="{{asset('template_assets/gen_z_seven/images/user/portfolio-item-4.webp')}}" width="690" height="388" alt="portfolio">
                                        <div class="tag font-3 text-label text-uppercase fw-6 letter-spacing-1">
                                            Resume Pro
                                        </div>
                                    </a>
                                    <h5 class=" title font-4 text_white"> <a href="#" class="link">Resume {{config('app.name')}}
                                            pro</a>
                                    </h5>
                                    <div class="item-shape">
                                        <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.png')}}" alt="item">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End section-portfolio -->

                        <!-- section-testimonial-->
                       
                    

                        <!-- section-pricing-->
                      
                 

                        <!-- section-partner-->
                      
                       

                        <!-- section-contact-->
                        <div id="contact" class="section-contact spacing-1 pb-0 section spacing-1">
                            <div class="heading-section mb_44">
                                <div class="tag-heading text-uppercase text-label font-3 letter-spacing-1 mb_33">
                                    Contact
                                </div>
                                <h3 class="text_white fw-5 animationtext clip ">Lets <span class="tf-text s1 cd-words-wrapper text_primary-color">
                                        <span class="item-text is-visible">Design</span>
                                        <span class="item-text is-hidden">Create</span>
                                        <span class="item-text is-hidden">Craft</span>
                                    </span> <br>
                                    Incredible
                                    Work Together</h3>
                            </div>
                            <form class="form-contact bs-light-mode">
                                <div class="heading-title d-flex justify-content-between align-items-center mb_32">
                                    <div>
                                        <h4 class="text_white fw-4 mb_4"><a href="#" class="hover-underline-link link">{{config('mail.from.address')}}</a></h4>
                                        
                                    </div>
                                    <ul class="list-icon d-flex">
                                        <li><a href="#" class="icon-LinkedIn"></a></li>
                                        <li> <a href="#" class="icon-GitHub"></a></li>
                                        <li><a href="#" class="icon-X"></a></li>
                                        <li><a href="#" class="icon-dribbble"></a></li>
                                    </ul>
                                </div>

                                <div class="d-grid gap_24  mb_24">
                                    <fieldset class="">
                                        <input id="name" type="text" placeholder="Your name" name="name" tabindex="2" aria-required="true" required="">
                                    </fieldset>
                                    <fieldset class="">
                                        <input class="" type="email" placeholder="Your email" name="email" tabindex="2" value="" id="email" aria-required="true" required="">
                                    </fieldset>
                                    <fieldset>
                                        <textarea id="message" class="" rows="4" placeholder="Your Message..." tabindex="2" aria-required="true" required=""></textarea>
                                    </fieldset>
                                </div>

                              

                                <button class="tf-btn style-1 animate-hover-btn" type="submit">
                                    <span>Send Message!</span>
                                </button>
                                <div class="item-shape">
                                    <img src="{{asset('template_assets/gen_z_seven/images/item/small-comet.webp')}}" alt="item">
                                </div>
                            </form>
                            <p class="font-3 text_secondary-color">© {{date('Y')}} {{config('app.name')}}. All Rights Reserved.</p>
                        </div>
                        <!-- End section-contact -->

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
    <script src="{{asset('template_assets/gen_z_seven/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('template_assets/gen_z_seven/js/jquery.min.js')}}"></script>
    <script src="{{asset('template_assets/gen_z_seven/js/odometer.min.js')}}"></script>
    <script src="{{asset('template_assets/gen_z_seven/js/counter.js')}}"></script>
    <script src="{{asset('template_assets/gen_z_seven/js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('template_assets/gen_z_seven/js/carousel.js')}}"></script>
    <script src="{{asset('template_assets/gen_z_seven/js/ScrollTrigger.min.js')}}"></script>
    <script src="{{asset('template_assets/gen_z_seven/js/SplitText.min.js')}}"></script>
    <script src="{{asset('template_assets/gen_z_seven/js/gsap.min.js')}}"></script>
    <script src="{{asset('template_assets/gen_z_seven/js/handleGsap.js')}}"></script>
    <script src="{{asset('template_assets/gen_z_seven/js/textanimation.js')}}"></script>
    <script src="{{asset('template_assets/gen_z_seven/js/ScrollSmooth.js')}}"></script>
    <script src="{{asset('template_assets/gen_z_seven/js/splitting.min.js')}}"></script>
    <script src="{{asset('template_assets/gen_z_seven/js/jquery.fancybox.js')}}"></script>
    <script src="{{asset('template_assets/gen_z_seven/js/main.js')}}"></script>

    <!-- /Javascript -->

</body>

</html>