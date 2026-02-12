<section class="portfolio-area page-section scroll-to-page" id="projects">
    <div class="custom-container">
        <div class="portfolio-content content-width">
            <div class="section-header">
                <h4 class="subtitle scroll-animation" data-animation="fade_from_bottom">
                    <i class="las la-grip-vertical"></i> portfolio
                </h4>
                <h1 class="scroll-animation" data-animation="fade_from_bottom">Featured <span>Projects</span></h1>
            </div>

            <div class="row portfolio-items">
                @if (isset($portfolio->projects) && $portfolio->projects->count() > 0)
                    @foreach ($portfolio->projects as $project)
                        <div class="col-md-12z scroll-animation" data-animation="fade_from_bottom">
                            <div class="portfolio-item portfolio-full">
                                <div class="portfolio-item-inner">
                                    @if ($project->project_link ?? null)
                                        <a href="{{ $project->project_link }}" data-lightbox="example-1">
                                            @if ($project->thumbnail_path ?? null)
                                                <img src="{{ Storage::url($project->thumbnail_path) }}" alt="project">
                                            @endif
                                        </a>
                                    @endif

                                    <ul class="portfolio-categories">
                                        @if (isset($project->skills) && $project->skills->count() > 0)
                                            @foreach ($project->skills as $skill)
                                                <li>
                                                    <a href="">{{ $skill->title ?? 'N/A' }}</a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <h2>
                                    @if ($project->project_link ?? null)
                                        <a href="{{ $project->project_link }}">{{ $project->title ?? 'N/A' }}</a>
                                    @else
                                        {{ $project->title ?? 'N/A' }}
                                    @endif
                                </h2>
                                @if ($project->brief_description ?? null)
                                    <p>{{ $project->brief_description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

        </div>
    </div>
</section>
