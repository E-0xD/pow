<div id="about" class="section-about v3 spacing-1 section">
    <div>
        <div class="heading-section mb_45">
            <div class="tag-heading text-uppercase text-label font-3 letter-spacing-1 mb_32">
                About
            </div>
            <div class="title-border-shape">
                <h4 class="animationtext clip "><span class="tf-text s1 cd-words-wrapper text_primary-color">
                        <span class="item-text is-visible"> {{ formatText($portfolio->about->brief) }}</span>
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
            {{ ucFirst($portfolio->about->name) }}
        </h1>
        <p class="text_muted-color font-3 mb_43 split-text split-lines-transform">
            {{ formatText($portfolio->about->description) }}</p>
        <div class="wrap-counter tf-grid-layout md-col-3">
            @if ($portfolio->about->years_of_experience != null)
                <div class="counter-item bs-light-mode">
                    <div class="counter-number h2 text_white mb_7">
                        <div class="odometer" data-number="{{ $portfolio->about->years_of_experience }}">
                            {{ $portfolio->about->years_of_experience }}</div>
                            
                        <span class="sub">+</span>
                    </div>

                    <p class="text-body-1 text_muted-color font-3">Years of Experience</p>
                    <div class="item-shape">
                        <img src="{{ asset('template_assets/gen_z_seven/images/item/small-comet.webp') }}"
                            loading="lazy" decoding="async" alt="item">
                    </div>
                </div>
            @endif

            @if ($portfolio->about->total_projects_done != null)
                <div class="counter-item bs-light-mode">
                    <div class="counter-number h2 text_white mb_7">
                        <div class="odometer" data-number="  {{ $portfolio->about->total_projects_done }}">
                            {{ $portfolio->about->total_projects_done }}</div>
                        {{-- <span class="sub">k</span> --}}
                        <span class="sub">+</span>
                    </div>
                    <p class="text-body-1 text_muted-color font-3">Projects Completed</p>
                    <div class="item-shape">
                        <img src="{{ asset('template_assets/gen_z_seven/images/item/small-comet.webp') }}"
                            loading="lazy" decoding="async" alt="item">
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
