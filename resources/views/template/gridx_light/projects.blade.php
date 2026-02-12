 <section class="projects-area" id="projects">
     <div class="container">
         <h1 class="section-heading" data-aos="fade-up"><img src="{{ asset('template_assets/gridx/images/star-2.png') }}"
                 alt="Star"> All Projects <img src="{{ asset('template_assets/gridx/images/star-2.png') }}"
                 alt="Star"></h1>
         <div class="row">

             @if (isset($portfolio->projects) && $portfolio->projects->count() > 0)
                 @php
                     if ($portfolio->projects->count() >= 3) {
                         $divider = 3;
                         $firstColumnItems = ceil($portfolio->projects->count() / $divider);
                         $secondColumnStart = $firstColumnItems;
                         $thirdColumnStart = $firstColumnItems * 2;
                     } else {
                         $divider = 2;
                         $firstColumnItems = 0; // No first column
                         $secondColumnStart = 0; // Start from beginning
                         $thirdColumnStart = ceil($portfolio->projects->count() / $divider);
                     }

                     $itemsPerSection = ceil($portfolio->projects->count() / $divider);
                 @endphp

                 @if ($portfolio->projects->count() >= 3)
                     <!-- Col-md-4 Section -->
                     <div class="col-md-4">
                         @foreach ($portfolio->projects->slice(0, $firstColumnItems) as $project)
                             <div data-aos="zoom-in">
                                 <div class="project-item shadow-box">
                                     @if ($project->project_link ?? null)
                                         <a class="overlay-link" href="{{ $project->project_link }}"></a>
                                     @endif
                                     <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG"
                                         class="bg-img">
                                     <div class="project-img">
                                         @if ($project->thumbnail_path ?? null)
                                             <img src="{{ Storage::url($project->thumbnail_path) }}" alt="Project">
                                         @endif
                                     </div>
                                     <div class="d-flex align-items-center justify-content-between">
                                         <div class="project-info">
                                             <p>
                                                 @if (isset($project->skills) && $project->skills->count() > 0)
                                                     @foreach ($project->skills as $skill)
                                                         {{ ($skill->title ?? 'N/A') . ',' }}
                                                     @endforeach
                                                 @endif
                                             </p>
                                             <h1>{{ $project->title ?? 'N/A' }}</h1>
                                         </div>
                                         @if ($project->project_link ?? null)
                                             <a href="{{ $project->project_link }}" class="project-btn">
                                                 <img src="{{ asset('template_assets/gridx/images/icon.svg') }}"
                                                     alt="Button">
                                             </a>
                                         @endif
                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     </div>
                 @endif
                 <!-- Col-md-8 Section -->
                 <div class="col-md-8">
                     <h1 class="section-heading" data-aos="fade-up">
                         <img src="{{ asset('template_assets/gridx/images/star-2.png') }}" alt="Star">
                         All Projects
                         <img src="{{ asset('template_assets/gridx/images/star-2.png') }}" alt="Star">
                     </h1>

                     <!-- First flex container -->
                     <div class="d-flex align-items-start gap-24">
                         @foreach ($portfolio->projects->slice($secondColumnStart, $itemsPerSection) as $project)
                             <div data-aos="zoom-in" class="flex-1">
                                 <div class="project-item shadow-box">
                                     @if ($project->project_link ?? null)
                                         <a class="overlay-link" href="{{ $project->project_link }}"></a>
                                     @endif
                                     <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG"
                                         class="bg-img">
                                     <div class="project-img">
                                         @if ($project->thumbnail_path ?? null)
                                             <img src="{{ Storage::url($project->thumbnail_path) }}" alt="Project">
                                         @endif
                                     </div>
                                     <div class="d-flex align-items-center justify-content-between">
                                         <div class="project-info">
                                             <p>
                                                 @if (isset($project->skills) && $project->skills->count() > 0)
                                                     @foreach ($project->skills as $skill)
                                                         {{ ($skill->title ?? 'N/A') . ',' }}
                                                     @endforeach
                                                 @endif
                                             </p>
                                             <h1>{{ $project->title ?? 'N/A' }}</h1>
                                         </div>
                                         @if ($project->project_link ?? null)
                                             <a href="{{ $project->project_link }}" class="project-btn">
                                                 <img src="{{ asset('template_assets/gridx/images/icon.svg') }}"
                                                     alt="Button">
                                             </a>
                                         @endif
                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     </div>

                     <!-- Second flex container -->
                     <div class="d-flex align-items-start gap-24">
                         @foreach ($portfolio->projects->slice($thirdColumnStart) as $project)
                             <div data-aos="zoom-in" class="flex-1">
                                 <div class="project-item shadow-box">
                                     @if ($project->project_link ?? null)
                                         <a class="overlay-link" href="{{ $project->project_link }}"></a>
                                     @endif
                                     <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG"
                                         class="bg-img">
                                     <div class="project-img">
                                         @if ($project->thumbnail_path ?? null)
                                             <img src="{{ Storage::url($project->thumbnail_path) }}" alt="Project">
                                         @endif
                                     </div>
                                     <div class="d-flex align-items-center justify-content-between">
                                         <div class="project-info">
                                             <p>
                                                 @if (isset($project->skills) && $project->skills->count() > 0)
                                                     @foreach ($project->skills as $skill)
                                                         {{ ($skill->title ?? 'N/A') . ',' }}
                                                     @endforeach
                                                 @endif
                                             </p>
                                             <h1>{{ $project->title ?? 'N/A' }}</h1>
                                         </div>
                                         @if ($project->project_link ?? null)
                                             <a href="{{ $project->project_link }}" class="project-btn">
                                                 <img src="{{ asset('template_assets/gridx/images/icon.svg') }}"
                                                     alt="Button">
                                             </a>
                                         @endif
                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     </div>
                 </div>
             @endif

         </div>
     </div>
 </section>
