<div class="col-md-6 " data-aos="zoom-in" id="education">
    <div class="about-edc-exp about-education shadow-box h-full">
        <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG" class="bg-img">
        <h3>EDUCATION</h3>

        <ul>
            @foreach ($portfolio->educationRecords as $education)
                <li>
                    <p class="date">{{ formatMonthYear($education->year_of_admission) }} -
                        {{ $education->year_of_graduation ? formatMonthYear($education->year_of_graduation) : 'Present' }}
                    </p>
                    <h2>{{ $education->degree }}</h2>
                    <p class="type">{{ $education->school }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</div>
