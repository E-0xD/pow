 <div id="skills" class="section-service section spacing-1">
     <div class="heading-section mb_43">
         <div class="tag-heading text-uppercase text-label font-3 letter-spacing-1 mb_33">
             Skills
         </div>
         <h3 class="text_white fw-5  split-text effect-blur-fade">Technical and Soft Skills
         </h3>
     </div>
     @foreach ($portfolio->skills->sortBy(fn($skill) => $skill->type->value === 'technical') as $skill)
         <div class="service-item area-effect scrolling-effect effectBottom">
             <div class="content-inner d-flex align-items-center justify-content-between">
                 <div class="d-flex align-items-center content">
                     <span class="number text-label text_muted-color font-3">01/</span>
                     <h5 class="text_white font-4"><a href="#contact" class="link">{{ ucfirst($skill->title) }}</a>
                     </h5>
                 </div>

             </div>
             <div class="img-hover">
                 {!! $skill->logo !!}
             </div>

         </div>
     @endforeach
 </div>
