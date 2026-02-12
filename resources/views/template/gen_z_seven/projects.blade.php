@if (isset($portfolio->projects) && $portfolio->projects->count() > 0)
   <div id="projects" class="section-portfolio spacing-1 stack-element section">
       <div class="heading-section mb_42">
           <div class="tag-heading text-uppercase text-label font-3 letter-spacing-1 mb_34">
               Portfolio
           </div>
           <h3 class="text_white fw-5  split-text effect-blur-fade">Featured Projects</h3>
       </div>
       <div class="tabs-content-wrap">
           @foreach ($portfolio->projects as $project)
               <div class="portfolio-item element">
                   <a href="{{ $project->project_link }}" class="img-style">
                       @if ($project->thumbnail_path)
                           <img decoding="async" loading="lazy" src="{{ Storage::url($project->thumbnail_path) }}"
                               width="690" height="388" alt="portfolio">
                       @endif

                       <div class="tag font-3 text-label text-uppercase fw-6 letter-spacing-1">
                           {{ $project->title }}
                       </div>
                   </a>
                   <h5 class=" title font-4 text_white text-break"> <a href="{{ $project->project_link }}"
                           class="link">{{ formatText($project->brief_description) }}</a>
                   </h5>
                   
                   <div class="item-shape">
                       <img src="{{ asset('template_assets/gen_z_seven/images/item/small-comet.png') }}" alt="item">
                   </div>
               </div>
           @endforeach
       </div>
   </div>
@endif
