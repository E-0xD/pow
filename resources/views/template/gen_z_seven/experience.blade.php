<div id="experience" class="section-resume spacing-1 section">
    <div class="heading-section mb_44">
        <div class="tag-heading text-uppercase text-label font-3 letter-spacing-1 mb_30">
            Jobs and Contracts History
        </div>
        <h3 class="text_white fw-5 split-text effect-blur-fade">Experience</h3>
    </div>
    <div class="effect-line-hover">
        @foreach ($portfolio->experiences as $experience)
            <div class="wrap-education-item area-effect  scrolling-effect effectTop">
                <span class="point"></span>
                <div class="education-item">
                    <div class="content">
                        <h5 class="font-4 mb_4"><a href="#contact"
                                class="link">{{ ucFirst($experience->position) }}</a>
                        </h5>
                        <span class="text-body-1 font-3">{{ ucFirst($experience->company) }}</span>
                        <p class="text-body-1 font-3">{{ ucFirst(
                            e({!! $experience->description !!})
                        ) }}</p>
                    </div>
                    <div class="date text-caption-1 text_white font-3">
                        {{ $experience->start_date }} -
                        {{ $experience->end_date ? $experience->end_date : 'Present' }}
                    </div>
                    <div class="item-shape spotlight">
                        <img src="{{ asset('template_assets/gen_z_seven/images/item/small-comet.webp') }}"
                            loading="lazy" decoding="async" alt="item">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
