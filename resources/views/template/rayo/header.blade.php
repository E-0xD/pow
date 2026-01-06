<!-- Menu & Menu Hamburger Start -->
<nav class="mxd-nav__wrap" data-lenis-prevent="">

    <!-- Hamburger Start -->
    <div class="mxd-nav__contain loading__fade">
        <a href="#0" class="mxd-nav__hamburger">
            <!-- flip element -->
            <div class="hamburger__base"></div>
            <div class="hamburger__line"></div>
            <div class="hamburger__line"></div>
        </a>
    </div>
    <!-- Hamburger End -->

    <!-- Main Navigation Start -->
    <div class="mxd-menu__wrapper">
        <!-- background active layer -->
        <div class="mxd-menu__base"></div>
        <!-- menu container -->
        <div class="mxd-menu__contain">
            <div class="mxd-menu__inner">
                <!-- left side -->
                <div class="mxd-menu__left">

                    <div class="main-menu">
                        <nav class="main-menu__content">
                            <ul id="main-menu" class="main-menu__accordion">
                                @foreach ($portfolio->sectionOrders->sortBy('position') as $sectionOrder)
                                    @switch($sectionOrder->section_id)
                                        @case('about')
                                            <li class="main-menu__item">
                                                <a class="main-menu__link btn btn-anim" href="#about">
                                                    <span class="btn-caption">About</span>
                                                </a>
                                            </li>
                                        @break

                                        @case('experience')
                                            <li class="main-menu__item">
                                                <a class="main-menu__link btn btn-anim" href="#experience">
                                                    <span class="btn-caption">Experience</span>
                                                </a>
                                            </li>
                                        @break

                                        @case('education')
                                            <li class="main-menu__item">
                                                <a class="main-menu__link btn btn-anim" href="#education">
                                                    <span class="btn-caption">Education</span>
                                                </a>
                                            </li>
                                        @break

                                        @case('projects')
                                            <li class="main-menu__item">
                                                <a class="main-menu__link btn btn-anim" href="#projects">
                                                    <span class="btn-caption">Projects</span>
                                                </a>
                                            </li>
                                        @break
                                    @endswitch
                                @endforeach

                                 <li class="main-menu__item">
                                    <a class="main-menu__link btn btn-anim" href="#contact">
                                        <span class="btn-caption">Contact</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Main Navigation End -->

</nav>
<!-- Menu & Menu Hamburger End -->

<!-- Header Start -->
<header id="header" class="mxd-header">
    <!-- header logo -->
    {{-- <div class="mxd-header__logo loading__fade">
        <a href="index-main.html" class="mxd-logo">
          <!-- logo icon -->
          
          <!-- logo text -->
          <span class="mxd-logo__text">rayo<br>template</span>
        </a>
      </div> --}}
    <!-- header controls -->
    <div class="mxd-header__controls loading__fade">
        <button id="color-switcher" class="mxd-color-switcher" type="button" role="switch"
            aria-label="light/dark mode" aria-checked="true"></button>
        <a class="btn btn-anim btn-default btn-mobile-icon btn-outline slide-right-up" href="#contact">
            <span class="btn-caption">Say Hello</span>
            <i class="ph-bold ph-arrow-up-right"></i>
        </a>
    </div>
</header>
<!-- Header End -->
