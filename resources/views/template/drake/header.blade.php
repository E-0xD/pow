        <span class="icon-menu">
            <span class="bar"></span>
            <span class="bar"></span>
        </span>

        <div class="responsive-sidebar-menu">
            <div class="overlay"></div>
            <div class="sidebar-menu-inner">
                <div class="menu-wrap">
                    <p>Menu</p>
                    <ul class="menu scroll-nav-responsive d-flex">
                        @foreach ($portfolio->sectionOrders->sortBy('position') as $sectionOrder)
                            @switch($sectionOrder->section_id)
                                @case('about')
                                    <li>
                                        <a class="scroll-to" href="#home">
                                            <i class="las la-home"></i> <span>Home</span>
                                        </a>
                                    </li>
                                @break

                                @case('experience')
                                    <li>
                                        <a class="scroll-to" href="#experience">
                                            <i class="las la-briefcase"></i> <span>Experience</span>
                                        </a>
                                    </li>
                                @break

                                @case('education')
                                    <li>
                                        <a class="scroll-to" href="#education">
                                            <i class="lar la-comment"></i> <span>Education</span>
                                        </a>
                                    </li>
                                @break

                                @case('skills')
                                    <li>
                                        <a class="scroll-to" href="#skills">
                                            <i class="las la-shapes"></i> <span>Skills</span>
                                        </a>
                                    </li>
                                @break

                                @case('projects')
                                    <li>
                                        <a class="scroll-to" href="#projects">
                                            <i class="las la-grip-vertical"></i> <span>Projects</span>
                                        </a>
                                    </li>
                                @break
                            @endswitch
                        @endforeach

                        @if ($portfolio->accept_messages)
                            <li>
                                <a class="scroll-to" href="#contact">
                                    <i class="las la-envelope"></i> <span>Contact</span>
                                </a>
                            </li>
                        @endif

                    </ul>
                </div>

            </div>
        </div>

        <ul class="menu scroll-nav d-flex">

            @foreach ($portfolio->sectionOrders->sortBy('position') as $sectionOrder)
                @switch($sectionOrder->section_id)
                    @case('about')
                        <li>
                            <a class="scroll-to" href="#home">
                                <span>Home</span> <i class="las la-home"></i>
                            </a>
                        </li>
                    @break

                    @case('experience')
                        <li>
                            <a class="scroll-to" href="#experience">
                                <span>Experience</span> <i class="las la-briefcase"></i>
                            </a>
                        </li>
                    @break

                    @case('education')
                        <li>
                            <a class="scroll-to" href="#education">
                                <span>Education</span> <i class="lar la-comment"></i>
                            </a>
                        </li>
                    @break

                    @case('skills')
                        <li>
                            <a class="scroll-to" href="#skills">
                                <span>Skills</span> <i class="las la-shapes"></i>
                            </a>
                        </li>
                    @break

                    @case('projects')
                        <li>
                            <a class="scroll-to" href="#projects">
                                <span>Projects</span> <i class="las la-grip-vertical"></i>
                            </a>
                        </li>
                    @break
                @endswitch
            @endforeach

            @if ($portfolio->accept_messages)
                <li>
                    <a class="scroll-to" href="#contact">
                        <span>Contact</span> <i class="las la-envelope"></i>
                    </a>
                </li>
            @endif
        </ul>
