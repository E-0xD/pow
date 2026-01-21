<section class="about-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6" data-aos="zoom-in">
                <div class="about-me-box shadow-box">
                    <a class="overlay-link" href="about.html"></a>
                    <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG" class="bg-img">
                    <div class="img-box">
                        <img src="{{ Storage::url($portfolio->about->logo) }}" alt="About Me">
                    </div>
                    <div class="infos">
                      
                        <h1>{{ $portfolio->about->name }}</h1>
                        <p>{{ $portfolio->about->brief }}</p>
                        <a href="#" class="about-btn">
                            <img src="{{ asset('template_assets/gridx/images/icon.svg') }}" alt="Button">
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="about-credentials-wrap">
                    <div data-aos="zoom-in">
                        <div class="banner shadow-box">
                            <div class="marquee">
                                <div>
                                    <span>
                                        @foreach ($portfolio->skills as $skill)
                                            <b>{{ ucfirst($skill->title) }}</b> <img
                                                src="{{ asset('template_assets/gridx/images/star1.svg') }}"
                                                alt="Star">
                                        @endforeach

                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="gx-row d-flex gap-24">
                        @if ($portfolio->about)
                            <div data-aos="zoom-in">
                                <div class="about-crenditials-box info-box shadow-box h-full">
                                    <a class="overlay-link" href="#about"></a>
                                    <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG"
                                        class="bg-img">
                                    <img src="{{ asset('template_assets/gridx/images/sign.png') }}" alt="Sign">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="infos">
                                            <h4>more about me</h4>
                                            <h1>Credentials</h1>
                                        </div>

                                        <a href="#about" class="about-btn">
                                            <img src="{{ asset('template_assets/gridx/images/icon.svg') }}"
                                                alt="Button">
                                        </a>

                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($portfolio->projects)
                            <div data-aos="zoom-in">
                                <div class="about-project-box info-box shadow-box h-full">
                                    <a class="overlay-link" href="#projects"></a>
                                    <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG"
                                        class="bg-img">
                                    <img src="{{ asset('template_assets/gridx/images/my-works.png') }}" alt="My Works">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="infos">
                                            <h4>SHOWCASE</h4>
                                            <h1>Projects</h1>
                                        </div>

                                        <a href="#projects" class="about-btn">
                                            <img src="{{ asset('template_assets/gridx/images/icon.svg') }}"
                                                alt="Button">
                                        </a>

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-24">
            <div class="col-md-12">
                <div class="blog-service-profile-wrap d-flex gap-24">
                    @if ($portfolio->educationRecords || $portfolio->experiences)
                        <div data-aos="zoom-in">
                            <div class="about-blog-box info-box shadow-box h-full">
                                <a href="blog.html" class="overlay-link"></a>
                                <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG"
                                    class="bg-img">
                                <img src="{{ asset('template_assets/gridx/images/gfonts.png') }}" alt="GFonts">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="infos">
                                        <h4>EDUCATION &</h4>
                                        <h1>EXPERIENCE</h1>
                                    </div>

                                    <a href="blog.html" class="about-btn">
                                        <img src="{{ asset('template_assets/gridx/images/icon.svg') }}" alt="Button">
                                    </a>

                                </div>
                            </div>
                        </div>
                    @endif

                    <div data-aos="zoom-in" class="flex-1">
                        <div class="about-client-box info-box shadow-box h-full">
                            <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG"
                                class="bg-img">
                            <div class="clients d-flex align-items-start gap-24 justify-content-center">
                                @if ($portfolio->about->years_of_experience != null)
                                    <div class="client-item">
                                        <h1>{{ $portfolio->about->years_of_experience }}+</h1>
                                        <p>Years <br>Experience</p>
                                    </div>
                                @endif

                                @if ($portfolio->about->total_projects_done != null)
                                    <div class="client-item">
                                        <h1>{{ $portfolio->about->total_projects_done }}+</h1>
                                        <p>Total <br>Projects</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div data-aos="zoom-in">
                        <div class="about-contact-box info-box shadow-box h-full">
                            <a class="overlay-link" href="#contact"></a>
                            <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG"
                                class="bg-img">
                            <img src="{{ asset('template_assets/gridx/images/icon2.png') }}" alt="Icon"
                                class="star-icon">
                            <h1>Let's <br>work <span>together.</span></h1>
                            <a href="#contact" class="about-btn">
                                <img src="{{ asset('template_assets/gridx/images/icon.svg') }}" alt="Button">
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>
