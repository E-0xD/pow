 <div id="contact" class="section-contact spacing-1 pb-0 section spacing-1">
     <div class="heading-section mb_44">
         <div class="tag-heading text-uppercase text-label font-3 letter-spacing-1 mb_33">
             Contact
         </div>
         <h3 class="text_white fw-5 animationtext clip">
             Let's
             <span class="tf-text s1 cd-words-wrapper text_primary-color">
                 <span class="item-text is-visible">Create</span>
                 <span class="item-text is-hidden">Build</span>
                 <span class="item-text is-hidden">Achieve</span>
             </span>
             <br>
             Incredible
             Work Together
         </h3>

     </div>
     <form class="form-contact bs-light-mode">
         <div class="heading-title d-flex justify-content-between align-items-center mb_32">
           
             <ul class="list-icon d-flex">
                 @foreach ($portfolio->contactMethods as $contactMethod)
                     <li><a href="{{ getContactLink(title: $contactMethod->title, value: $contactMethod->value) }}">{!! $contactMethod->contactMethod->logo !!}</a></li>
                 @endforeach
             </ul>
         </div>

         <div class="d-grid gap_24  mb_24">
             <fieldset class="">
                 <input id="name" type="text" placeholder="Your name" name="name" tabindex="2"
                     aria-required="true" required="">
                 @error('name')
                     <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                 @enderror
             </fieldset>
             <fieldset class="">
                 <input class="" type="email" placeholder="Your email" name="email" tabindex="2"
                     value="" id="email" aria-required="true" required="">
                 @error('email')
                     <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                 @enderror
             </fieldset>
             <fieldset>
                 <textarea id="message" class="" rows="4" placeholder="Your Message..." tabindex="2" aria-required="true"
                     required="">{{ old('message') }}</textarea>
                 @error('message')
                     <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                 @enderror
             </fieldset>
         </div>

         <button class="tf-btn style-1 animate-hover-btn" type="submit">
             <span>Send Message</span>
         </button>
         <div class="item-shape">
             <img src="{{ asset('template_assets/gen_z_seven/images/item/small-comet.webp') }}" alt="item">
         </div>
     </form>
  
 </div>
