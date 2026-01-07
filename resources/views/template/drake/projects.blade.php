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
                @foreach ($portfolio->projects as $project)
                    <div class="col-md-12 scroll-animation" data-animation="fade_from_bottom">
                        <div class="portfolio-item portfolio-full">
                            <div class="portfolio-item-inner">
                                <a href="{{ $project->project_link }}" data-lightbox="example-1">
                                    <img src="{{ Storage::url($project->thumbnail_path) }}" alt="project">
                                </a>

                                <ul class="portfolio-categories">
                                    @foreach ($project->skills as $skill)
                                        <li>
                                            <a href="">{{ $skill->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <h2><a href="{{ $project->project_link }}">{{ $project->title }}</a></h2>
                            <p>{{$project->brief_description}}</p>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
</section>
