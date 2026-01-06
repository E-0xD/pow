<div id="about" class="mxd-section">
    <div class="mxd-hero-07">
        <div class="mxd-hero-07__wrap loading-wrap">
            <!-- top part -->
            <div class="mxd-hero-07__top">
            </div>
            <!-- bottom part -->
            <div class="mxd-hero-07__bottom">
                <div class="mxd-hero-07__circle">
                    @if ($portfolio->about->logo)
                        <div class="hero-07-circle__image hero-07-slide-out-scroll loading__item">
                            <img src="{{ Storage::url($portfolio->about->logo) }}" alt="Hero Image">
                        </div>
                    @endif

                    <div class="hero-07-circle__container hero-07-fade-out-scroll">
                        <div class="hero-07-circle__item item-01 loading__item">
                            <div class="mxd-hero__mark">
                                <span class="mark-icon"></span>
                                <span class="mark-text">Available for work</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero-07-circle__container mobile-row hero-07-fade-out-scroll">
                        <div class="hero-07-circle__item item-02 loading__item">
                            <div class="mxd-counter small">
                                <p id="years-of-experience" class="mxd-counter__number mxd-stats-number small">{{$years_of_experience}}
                                </p>
                                <p class="mxd-counter__descr t-140 t-bright t-small">Years of experience</p>
                            </div>
                        </div>
                        <div class="hero-07-circle__item item-03 loading__item">
                            <div class="mxd-counter small">
                                <p id="stats-counter-2" class="mxd-counter__number mxd-stats-number small">{{$portfolio->educationRecords->count()}} </p>
                                <p class="mxd-counter__descr t-140 t-bright t-small">Certificates</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mxd-hero-07__info loading__fade">
                    <div class="hero-07-info__container">
                        <div class="hero-07-info__descr">
                            <p class="t-large t-medium t-140 t-bright">Hey! I'm
                                {{ $portfolio->about->name }}.</p>
                            <p class="t-large t-medium t-140 t-bright">{{ $portfolio->about->brief }}</p>
                        </div>
                        <div class="hero-07-info__tags">
                            @foreach ($portfolio->skills->where(fn($skill) => $skill->type->value == 'technical')->values() as $index => $skill)
                                <span class="tag tag-default tag-outline-medium">{{ $skill->title }}</span>
                            @endforeach

                        </div>
                    </div>
                    <div class="hero-07-info__container">
                        <div class="hero-07-info__tags right-align-desktop">
                            @foreach ($portfolio->skills->where(fn($skill) => $skill->type->value == 'soft')->values() as $index => $skill)
                                <span class="tag tag-default tag-outline-medium">{{ $skill->title }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- scroll for more -->
            <div class="mxd-hero-07__more loading__fade">
                <a class="btn btn-line-default btn-anim slide-down" href="#about">
                    <span class="btn-caption">Scroll for more</span>
                    <i class="ph-bold ph-arrow-elbow-right-down"></i>
                </a>
            </div>
            <!--  -->
            <div class="mxd-hero-07__tl-trigger"></div>
        </div>
    </div>
</div>

<div id="about" class="mxd-section overflow-hidden padding-hero-07 padding-pre-title">
    <div class="mxd-section padding-default">
        <div class="mxd-container grid-container">

            <!-- Block - About Description with Manifest Start -->
            <div class="mxd-block">
                <div class="container-fluid px-0">
                    <div class="row gx-0 d-xl-flex justify-content-xl-center">
                        <div class="col-12 col-xl-8 mxd-grid-item no-margin">
                            <div class="mxd-block__content">
                                <div class="mxd-block__manifest anim-uni-in-up">
                                    <p class="mxd-manifest mxd-manifest-l reveal-type">
                                        {{ $portfolio->about->description }}</p>
                                    {{-- <div class="mxd-manifest__controls anim-uni-in-up">
                                              <div class="mxd-btngroup centered">
                                                  <a class="btn btn-anim btn-default btn-accent slide-right-up"
                                                      href="works-simple.html">
                                                      <span class="btn-caption">My Works</span>
                                                      <i class="ph-bold ph-arrow-up-right"></i>
                                                  </a>
                                                  <a class="btn btn-anim btn-default btn-outline slide-down"
                                                      href="#0">
                                                      <span class="btn-caption">Download CV</span>
                                                      <i class="ph-bold ph-arrow-down"></i>
                                                  </a>
                                              </div>
                                          </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Block - About Description with Manifest End -->

        </div>
    </div>
</div>

<script>
    const statsCounter1 = new countUp.CountUp("years-of-experience", {{$years_of_experience}}, optionsPlus);
    const statsCounter2 = new countUp.CountUp("stats-counter-2", {{$portfolio->educationRecords->count() }}, optionsPlus);
    statsCounter1.start();
    statsCounter2.start();
</script>
