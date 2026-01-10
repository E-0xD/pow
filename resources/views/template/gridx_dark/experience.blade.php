<div class="col-md-6 " data-aos="zoom-in">
    <div class="about-edc-exp about-experience shadow-box h-full" id="experience">
        <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG" class="bg-img">
        <h3>EXPERIENCE</h3>

        <ul>
            @foreach ($portfolio->experiences as $experience)
                <li>
                    <p class="date">{{ formatMonthYear($experience->start_date) }} -
                        {{ $experience->end_date ? formatMonthYear($experience->end_date) : 'Present' }}</p>
                    <h2>{{ ucFirst($experience->position) }}</h2>
                    <p class="type">{{ ucFirst($experience->company) }}</p>
                    <p>{{ formatText($experience->description) }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</div>
