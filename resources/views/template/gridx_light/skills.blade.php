<section class="about-area" id="skills">
    <div class="container">

        <div class="row mt-24">
            <div class="col-md-6" data-aos="zoom-in">
                <div class="about-edc-exp about-experience shadow-box h-full">
                    <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG" class="bg-img">
                    <h3>TECHNICAL SKILLS</h3>

                    <ul>
                        @if (isset($portfolio->skills) && $portfolio->skills->count() > 0)
                            @foreach ($portfolio->skills->where(fn($skill) => isset($skill->type) && ($skill->type->value ?? null) == 'technical')->values() as $index => $skill)
                                <li>

                                    <h2>{{ ucfirst($skill->title ?? 'N/A') }}</h2>

                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-6" data-aos="zoom-in">
                <div class="about-edc-exp about-education shadow-box h-full">
                    <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG" class="bg-img">
                    <h3>SOFT SKILLS</h3>

                    <ul>
                        @if (isset($portfolio->skills) && $portfolio->skills->count() > 0)
                            @foreach ($portfolio->skills->where(fn($skill) => isset($skill->type) && ($skill->type->value ?? null) == 'soft')->values() as $index => $skill)
                                <li>

                                    <h2>{{ ucfirst($skill->title ?? 'N/A') }}</h2>

                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>
