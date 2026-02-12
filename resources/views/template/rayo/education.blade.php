<div id="education" class="mxd-section overflow-hidden padding-hero-07 padding-pre-title">
    <div class="mxd-container grid-container">
        <div class="mxd-block">
            <div class="mxd-section-title pre-grid">
                <div class="container-fluid p-0">
                    <div class="row g-0 d-flex justify-content-between">
                        <div class="col-12 col-xl-5 mxd-grid-item no-margin">
                            <div class="mxd-section-title__hrtitle">
                                <h2 class="reveal-type anim-uni-in-up">My Education</h2>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4 mxd-grid-item no-margin">
                            <div class="mxd-section-title__hrdescr">
                                <p class="anim-uni-in-up">Foundational learning, academic milestones, and the path of
                                    growth across disciplines, skills, and knowledge.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Block - Projects List #02 Start -->
        <div class="mxd-block">
            <div class="mxd-projects-list ">

                @if (isset($portfolio->educationRecords) && $portfolio->educationRecords->count() > 0)
                    @foreach ($portfolio->educationRecords as $education)
                        <!-- item -->
                        <a class="mxd-projects-list__item">
                            <div class="mxd-projects-list__border anim-uni-in-up"></div>

                            <div class="mxd-projects-list__inner-v2">
                                <div class="container-fluid px-0">
                                    <div class="row gx-0">
                                        <div class="col-12 col-xl-6 mxd-grid-item no-margin">

                                            <div class="mxd-projects-list__title-v2 anim-uni-in-up flex-column">
                                                <p>{{ $education->degree ?? 'N/A' }}</p>
                                                <p class="text-light fs-3">{{ $education->school ?? 'N/A' }}</p>

                                            </div>

                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4 mxd-grid-item no-margin">
                                            <div class="mxd-projects-list__tagslist-v2 anim-uni-in-up">

                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-2 mxd-grid-item no-margin">
                                            <div class="mxd-projects-list__product anim-uni-in-up">
                                                <p> {{ formatMonthYear($education->year_of_admission ?? null) }} -
                                                    {{ $education->year_of_graduation ? formatMonthYear($education->year_of_graduation) : 'Present' }}
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mxd-projects-list__border anim-uni-in-up"></div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
        <!-- Block - Projects List #02 End -->

    </div>
</div>
