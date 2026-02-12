<div id="experience" class="mxd-section overflow-hidden padding-hero-07 padding-pre-title">
    <div class="mxd-container grid-container">
        <div class="mxd-block">
            <div class="mxd-section-title pre-grid">
                <div class="container-fluid p-0">
                    <div class="row g-0 d-flex justify-content-between">
                        <div class="col-12 col-xl-5 mxd-grid-item no-margin">
                            <div class="mxd-section-title__hrtitle">
                                <h2 class="reveal-type anim-uni-in-up">My Experiences</h2>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4 mxd-grid-item no-margin">
                            <div class="mxd-section-title__hrdescr">
                                <p class="anim-uni-in-up">Hands-on projects, real-world challenges, and the journey of
                                    growth across roles, teams, and technologies.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Block - Projects List #02 Start -->
        <div class="mxd-block">
            <div class="mxd-projects-list ">

                @if (isset($portfolio->experiences) && $portfolio->experiences->count() > 0)
                    @foreach ($portfolio->experiences as $experience)
                        <!-- item -->
                        <a class="mxd-projects-list__item">
                            <div class="mxd-projects-list__border anim-uni-in-up"></div>

                            <div class="mxd-projects-list__inner-v2">
                                <div class="container-fluid px-0">
                                    <div class="row gx-0">
                                        <div class="col-12 col-xl-6 mxd-grid-item no-margin">

                                            <div class="mxd-projects-list__title-v2 anim-uni-in-up flex-column">
                                                <p>{{ $experience->company ?? 'N/A' }}</p>
                                                @if ($experience->description ?? null)
                                                    <p class="text-light fs-3">{{ $experience->description }}</p>
                                                @endif

                                            </div>

                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4 mxd-grid-item no-margin">
                                            <div class="mxd-projects-list__tagslist-v2 anim-uni-in-up">
                                                <ul>
                                                    <li>
                                                        <p>{{ $experience->position ?? 'N/A' }}</p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M19.6,9.6h-3.9c-.4,0-1.8-.2-1.8-.2-.6,0-1.1-.2-1.6-.6-.5-.3-.9-.8-1.2-1.2-.3-.4-.4-.9-.5-1.4,0,0,0-1.1-.2-1.5V.4c0-.2-.2-.4-.4-.4s-.4.2-.4.4v4.4c0,.4-.2,1.5-.2,1.5,0,.5-.2,1-.5,1.4-.3.5-.7.9-1.2,1.2s-1,.5-1.6.6c0,0-1.2,0-1.7.2H.4c-.2,0-.4.2-.4.4s.2.4.4.4h4.1c.4,0,1.7.2,1.7.2.6,0,1.1.2,1.6.6.4.3.8.7,1.1,1.1.3.5.5,1,.6,1.6,0,0,0,1.3.2,1.7v4.1c0,.2.2.4.4.4s.4-.2.4-.4v-4.1c0-.4.2-1.7.2-1.7,0-.6.2-1.1.6-1.6.3-.4.7-.8,1.1-1.1.5-.3,1-.5,1.6-.6,0,0,1.3,0,1.8-.2h3.9c.2,0,.4-.2.4-.4s-.2-.4-.4-.4h0Z" />
                                                        </svg>

                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-2 mxd-grid-item no-margin">
                                            <div class="mxd-projects-list__product anim-uni-in-up">
                                                <p> {{ formatMonthYear($experience->start_date ?? null) }} -
                                                    {{ $experience->end_date ? formatMonthYear($experience->end_date) : 'Present' }}
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
