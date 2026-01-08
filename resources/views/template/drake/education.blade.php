<section class="resume-area page-section scroll-to-page" id="education">
    <div class="custom-container">
        <div class="resume-content content-width">
            <div class="section-header">
                <h4 class="subtitle scroll-animation" data-animation="fade_from_bottom">
                    <i class="las la-briefcase"></i> Education
                </h4>
                <h1 class="scroll-animation" data-animation="fade_from_bottom">Degrees & <span>Certifications</span></h1>
            </div>

            <div class="resume-timeline">
                @foreach ($portfolio->educationRecords as $education)
                    <div class="item scroll-animation" data-animation="fade_from_right">
                        <span class="date">{{ formatMonthYear($education->year_of_admission) }} - {{ $education->year_of_graduation ? formatMonthYear($education->year_of_graduation) : 'Present' }}</span>
                        <h2>{{ $education->degree }}</h2>
                        <p>{{ $education->school }}</p>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
