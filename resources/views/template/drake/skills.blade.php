<section class="skills-area page-section scroll-to-page" id="skills">
    <div class="custom-container">
        <div class="skills-content content-width">
            <div class="section-header">
                <h4 class="subtitle scroll-animation" data-animation="fade_from_bottom">
                    <i class="las la-shapes"></i> My skills
                </h4>
                <h1 class="scroll-animation" data-animation="fade_from_bottom">My <span>Advantages</span></h1>
            </div>

            <div class="row skills text-center">
                @foreach ($portfolio->skills->where(fn($skill) => $skill->type->value == 'technical')->values() as $index => $skill)
                    <div class="col-md-3 scroll-animation" data-animation="fade_from_left">
                        <div class="skill">
                            <div class="skill-inner">
                                <p class="name">{{ ucfirst($skill->title) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                @foreach ($portfolio->skills->where(fn($skill) => $skill->type->value == 'soft')->values() as $index => $skill)
                    <div class="col-md-3 scroll-animation" data-animation="fade_from_left">
                        <div class="skill">
                            <div class="skill-inner">
                                <p class="name">{{ ucfirst($skill->title) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
