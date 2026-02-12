 <div id="skills" class="section-service section spacing-1">
     <div class="heading-section mb_43">
         <div class="tag-heading text-uppercase text-label font-3 letter-spacing-1 mb_33">
             Skills
         </div>
         <h3 class="text_white fw-5  split-text effect-blur-fade">Technical and Soft Skills
         </h3>
     </div>
     @if (isset($portfolio->skills) && $portfolio->skills->count() > 0)
         @foreach ($portfolio->skills->where(fn($skill) => isset($skill->type) && ($skill->type->value ?? null) == 'technical')->values() as $index => $skill)
             <div class="service-item area-effect scrolling-effect effectBottom">
                 <div class="content-inner d-flex align-items-center justify-content-between">
                     <div class="d-flex align-items-center content">
                         <span class="number text-label text_muted-color font-3">
                             {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}/
                         </span>
                         <h5 class="text_white font-4">
                             <a href="#contact" class="link">{{ ucfirst($skill->title ?? 'N/A') }}</a>
                         </h5>
                     </div>
                 </div>

                 @if ($skill->logo ?? null)
                     <div class="img-hover">
                         {!! $skill->logo !!}
                     </div>
                 @endif
             </div>
         @endforeach
     @endif
     @if (isset($portfolio->skills) && $portfolio->skills->count() > 0)
         @foreach ($portfolio->skills->where(fn($skill) => isset($skill->type) && ($skill->type->value ?? null) == 'soft')->values() as $index => $skill)
             <div class="service-item area-effect scrolling-effect effectBottom">
                 <div class="content-inner d-flex align-items-center justify-content-between">
                     <div class="d-flex align-items-center content">
                         <span class="number text-label text_muted-color font-3">
                             {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}/
                         </span>
                         <h5 class="text_white font-4">
                             <a href="#contact" class="link">{{ ucfirst($skill->title ?? 'N/A') }}</a>
                         </h5>
                     </div>
                 </div>

                 @if ($skill->logo ?? null)
                     <div class="img-hover">
                         {!! $skill->logo !!}
                     </div>
                 @endif
             </div>
         @endforeach
     @endif

 </div>
