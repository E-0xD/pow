 <div id="projects" class="mxd-section padding-blog">
     <div class="mxd-container grid-container">

         <!-- Block - Section Title Start -->
         <div class="mxd-block">
             <div class="mxd-section-title pre-grid">
                 <div class="container-fluid p-0">
                     <div class="row g-0 d-flex justify-content-between">
                         <div class="col-12 col-xl-5 mxd-grid-item no-margin">
                             <div class="mxd-section-title__hrtitle">
                                 <h2 class="reveal-type anim-uni-in-up">My journal</h2>
                             </div>
                         </div>
                         <div class="col-12 col-xl-4 mxd-grid-item no-margin">
                             <div class="mxd-section-title__hrdescr">
                                 <p class="anim-uni-in-up">Thoughtful builds, creative problem solving, and the journey
                                     of growth across ideas, execution, and impact.</p>
                             </div>
                         </div>

                     </div>
                 </div>
             </div>
         </div>
         <!-- Block - Section Title End -->

         <!-- Block - Blog Preview Cards Start -->
         <div class="mxd-block">
             <div class="mxd-blog-preview">
                 <div class="container-fluid p-0">
                     <div class="row g-0">
                         @if (isset($portfolio->projects) && $portfolio->projects->count() > 0)
                             @foreach ($portfolio->projects as $project)
                                 <!-- item -->
                                 <div class="col-12 col-xl-4 mxd-blog-preview__item mxd-grid-item animate-card-3">
                                     @if ($project->project_link ?? null)
                                         <a class="mxd-blog-preview__media" href="{{ $project->project_link }}">
                                         @else
                                             <div class="mxd-blog-preview__media">
                                     @endif
                                     <div class="mxd-blog-preview__image  parallax-img-small">
                                         @if ($project->thumbnail_path ?? null)
                                             <img class="parallax-img-small"
                                                 src="{{ Storage::url($project->thumbnail_path) }}"
                                                 alt="Blog Preview Image">
                                         @endif
                                     </div>
                                     <div class="mxd-preview-hover">
                                         <i class="mxd-preview-hover__icon">
                                             <img src="{{ asset('template_assets/rayo/img/icons/icon-eye.svg') }}"
                                                 alt="Eye Icon">
                                         </i>
                                     </div>
                                     <div class="mxd-blog-preview__tags">
                                         @if (isset($project->skills) && $project->skills->count() > 0)
                                             @foreach ($project->skills as $skill)
                                                 <span
                                                     class="tag tag-default tag-permanent">{{ $skill->title ?? 'N/A' }}</span>
                                             @endforeach
                                         @endif

                                     </div>
                                     @if ($project->project_link ?? null)
                                         </a>
                                     @else
                                 </div>
                             @endif
                             <div class="mxd-blog-preview__data">
                                 @if ($project->project_link ?? null)
                                     <a class="anim-uni-in-up"
                                         href="{{ $project->project_link }}"><span>{{ $project->title ?? 'N/A' }}</a>
                                 @else
                                     <span class="anim-uni-in-up">{{ $project->title ?? 'N/A' }}</span>
                                 @endif
                             </div>
                     </div>
                     @endforeach
                     @endif
                 </div>
             </div>
         </div>
     </div>
     <!-- Block - Blog Preview Cards End -->

 </div>
 </div>
