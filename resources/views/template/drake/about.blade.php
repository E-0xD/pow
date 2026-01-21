 <section class="hero-section page-section scroll-to-page" id="home">

     <div class="custom-container">
         <div class="hero-content content-width">
             <div class="section-header">
                 <h4 class="subtitle scroll-animation" data-animation="fade_from_bottom">
                     <i class="las la-home"></i> Introduce
                 </h4>
                 <h1 class="scroll-animation" data-animation="fade_from_bottom">Hi from
                     <span>{{ ucFirst($portfolio->about->name) }}</span>,
                     {{ formatText($portfolio->about->brief) }}
                 </h1>
             </div>
             {{-- <p class="scroll-animation" data-animation="fade_from_bottom">I design and code beautifully simple things
                 and i love what i do. Just simple like that!</p> --}}
             <a href="#portfolio" class="go-to-project-btn scroll-to scroll-animation" data-animation="rotate_up">
                 <img src="assets/images/round-text.png" alt="">
                 <i class="las la-arrow-down"></i>
             </a>

             <div class="facts d-flex">
                 @if ($portfolio->about->years_of_experience != null)
                     <div class="left scroll-animation" data-animation="fade_from_left">
                         <h1>{{ $portfolio->about->years_of_experience }}+</h1>
                         <p>Years of <br>Experience</p>
                     </div>
                 @endif
                 @if ($portfolio->about->total_projects_done != null)
                     <div class="right scroll-animation" data-animation="fade_from_right">
                         <h1>{{ $portfolio->about->total_projects_done }}+</h1>
                         <p>Total Projects Done</p>
                     </div>
                 @endif
             </div>
         </div>
     </div>
 </section>

 <section class="about-area page-section scroll-to-page" id="about">
     <div class="custom-container">
         <div class="about-content content-width">
             <div class="section-header">
                 <h4 class="subtitle scroll-animation" data-animation="fade_from_bottom">
                     <i class="lar la-user"></i> About
                 </h4>
                 {{-- <h1 class="scroll-animation" data-animation="fade_from_bottom">Every great design begin with<br>
                     an even <span>better story</span></h1> --}}
             </div>
             <p class="scroll-animation" data-animation="fade_from_bottom">
                 {{ formatText($portfolio->about->description) }}
             </p>
         </div>
     </div>
 </section>
