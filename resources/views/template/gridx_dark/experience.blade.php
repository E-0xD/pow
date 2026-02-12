<div class="col-md-6 " data-aos="zoom-in">
    <div class="about-edc-exp about-experience shadow-box h-full" id="experience">
        <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG" class="bg-img">
        <h3>EXPERIENCE</h3>

        <ul>
            @if (isset($portfolio->experiences) && $portfolio->experiences->count() > 0)
                @foreach ($portfolio->experiences as $experience)
                    <li>
                        <p class="date">{{ formatMonthYear($experience->start_date ?? null) }} -
                            {{ $experience->end_date ? formatMonthYear($experience->end_date) : 'Present' }}</p>
                        <h2>{{ ucFirst($experience->position ?? 'N/A') }}</h2>
                        <p class="type">{{ ucFirst($experience->company ?? 'N/A') }}</p>
                        @if ($experience->description ?? null)
                            <p>{{ formatText($experience->description) }}</p>
                        @endif
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
