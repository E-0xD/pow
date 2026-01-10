 <section class="projects-area" id="projects">
     <div class="container">
         <h1 class="section-heading" data-aos="fade-up"><img src="{{ asset('template_assets/gridx/images/star-2.png') }}"
                 alt="Star"> All Projects <img src="{{ asset('template_assets/gridx/images/star-2.png') }}"
                 alt="Star"></h1>
         <div class="row">

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
                                 <a class="overlay-link" href="{{ $project->project_link }}"></a>
                                 <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG"
                                     class="bg-img">
                                 <div class="project-img">
                                     <img src="{{ Storage::url($project->thumbnail_path) }}" alt="Project">
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between">
                                     <div class="project-info">
                                         <p>
                                             @foreach ($project->skills as $skill)
                                                 {{ $skill->title . ',' }}
                                             @endforeach
                                         </p>
                                         <h1>{{ $project->title }}</h1>
                                     </div>
                                     <a href="{{ $project->project_link }}" class="project-btn">
                                         <img src="{{ asset('template_assets/gridx/images/icon.svg') }}" alt="Button">
                                     </a>
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
                                 <a class="overlay-link" href="{{ $project->project_link }}"></a>
                                 <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG"
                                     class="bg-img">
                                 <div class="project-img">
                                     <img src="{{ Storage::url($project->thumbnail_path) }}" alt="Project">
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between">
                                     <div class="project-info">
                                         <p>
                                             @foreach ($project->skills as $skill)
                                                 {{ $skill->title . ',' }}
                                             @endforeach
                                         </p>
                                         <h1>{{ $project->title }}</h1>
                                     </div>
                                     <a href="{{ $project->project_link }}" class="project-btn">
                                         <img src="{{ asset('template_assets/gridx/images/icon.svg') }}"
                                             alt="Button">
                                     </a>
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
                                 <a class="overlay-link" href="{{ $project->project_link }}"></a>
                                 <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG"
                                     class="bg-img">
                                 <div class="project-img">
                                     <img src="{{ Storage::url($project->thumbnail_path) }}" alt="Project">
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between">
                                     <div class="project-info">
                                         <p>
                                             @foreach ($project->skills as $skill)
                                                 {{ $skill->title . ',' }}
                                             @endforeach
                                         </p>
                                         <h1>{{ $project->title }}</h1>
                                     </div>
                                     <a href="{{ $project->project_link }}" class="project-btn">
                                         <img src="{{ asset('template_assets/gridx/images/icon.svg') }}"
                                             alt="Button">
                                     </a>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>

         </div>
     </div>
 </section>
