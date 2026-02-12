 <section class="resume-area page-section scroll-to-page" id="experience">
     <div class="custom-container">
         <div class="resume-content content-width">
             <div class="section-header">
                 <h4 class="subtitle scroll-animation" data-animation="fade_from_bottom">
                     <i class="las la-briefcase"></i> Experience
                 </h4>
                 <h1 class="scroll-animation" data-animation="fade_from_bottom">Roles & <span>Jobs</span></h1>
             </div>

             <div class="resume-timeline">
                 @if (isset($portfolio->experiences) && $portfolio->experiences->count() > 0)
                     @foreach ($portfolio->experiences as $experience)
                         <div class="item scroll-animation" data-animation="fade_from_right">
                             <span class="date">{{ formatMonthYear($experience->start_date ?? null) }} -
                                 {{ $experience->end_date ? formatMonthYear($experience->end_date) : 'Present' }}</span>
                             <h2>{{ ucFirst($experience->position ?? 'N/A') }}</h2>
                             <p>{{ ucFirst($experience->company ?? 'N/A') }}</p>
                             @if ($experience->description ?? null)
                                 <p>{{ formatText($experience->description) }}</p>
                             @endif
                         </div>
                     @endforeach
                 @endif
             </div>

         </div>
     </div>
 </section>
