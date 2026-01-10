<section class="about-area" id="skills">
    <div class="container">

        <div class="row mt-24">
            <div class="col-md-6" data-aos="zoom-in">
                <div class="about-edc-exp about-experience shadow-box h-full">
                    <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG" class="bg-img">
                    <h3>TECHNICAL SKILLS</h3>

                    <ul>
                        @foreach ($portfolio->skills->where(fn($skill) => $skill->type->value == 'technical')->values() as $index => $skill)
                            <li>

                                <h2>{{ ucfirst($skill->title) }}</h2>

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6" data-aos="zoom-in">
                <div class="about-edc-exp about-education shadow-box h-full">
                    <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG" class="bg-img">
                    <h3>SOFT SKILLS</h3>

                    <ul>
                        @foreach ($portfolio->skills->where(fn($skill) => $skill->type->value == 'soft')->values() as $index => $skill)
                            <li>

                                <h2>{{ ucfirst($skill->title) }}</h2>

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>
