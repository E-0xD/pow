 <div class="user-bar userbar-fixed text-center bs-light-mode">

     <div class="box-author mb_12">
         @if ($portfolio->about->logo)
             <div class="img-style mb_16">
                 <img decoding="async" loading="lazy" src="{{ Storage::url($portfolio->about->logo) }}" width="314"
                     height="314" alt="logo">
             </div>
         @endif
         <div class="info">
             <div class="name font-2 text_white mb_8">{{ $portfolio->about->name }}</div>
             <div class="text-label text-uppercase fw-6 text_primary-color font-3 mb_16 letter-spacing-1">
                 {{ $portfolio->about->brief }}</div>
         </div>
     </div>

     <ul class="list-icon d-flex justify-content-center mb_28">
         @foreach ($portfolio->contactMethods as $contactMethod)
             <li><a href="{{ $contactMethod->value }}">{!! $contactMethod->contactMethod->logo !!}</a></li>
         @endforeach
     </ul>

     @if ($portfolio->accept_messages)
         <a href="#contact" class="tf-btn style-1 animate-hover-btn btn-w-full">
             <i class="icon-EnvelopeSimple"></i><span>Contact Me</span>
         </a>
     @endif

     <div class="item-shape">
         <img src="{{ asset('template_assets/gen_z_seven/images/item/small-comet.png') }}" alt="item">
     </div>

 </div>
