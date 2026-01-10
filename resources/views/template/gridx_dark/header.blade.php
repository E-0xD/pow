<header class="header-area">
    <div class="container">
        <div class="gx-row d-flex align-items-center justify-content-between">

            <nav class="navbar">
                <ul class="menu">

                    @foreach ($portfolio->sectionOrders->sortBy('position') as $sectionOrder)
                        @switch($sectionOrder->section_id)
                            @case('about')
                                <li><a href="#about">About</a></li>
                            @break

                            @case('experience')
                                <li><a href="#experience">Experience</a></li>
                            @break

                            @case('education')
                                <li><a href="#education">Education</a></li>
                            @break

                            @case('skills')
                                <li><a href="#skills">Skills</a></li>
                            @break

                            @case('projects')
                                <li><a href="#projects">Projects</a></li>
                            @break
                        @endswitch
                    @endforeach

                </ul>

                @if ($portfolio->accept_messages)
                    <a href="#contact" class="theme-btn">Let's talk</a>
                @endif

            </nav>

            @if ($portfolio->accept_messages)
                <a href="#contact" class="theme-btn">Let's talk</a>
            @endif

            <div class="show-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</header>
