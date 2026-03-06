@if (isset($portfolio->about))
    <div class="left-sidebar">
        {{-- <div class="sidebar-header d-flex align-items-center justify-content-between">
        <img src="assets/images/logo.png" alt="Logo">
        <span class="designation">Framer Designer & Developer</span>
    </div> --}}
        @isset ($portfolio->about->logo)
            <img class="me" src="{{ Storage::url($portfolio->about->logo) }}" alt="Me">
        @endisset
        <h2 class="email">{{ $portfolio->about->name }}</h2>
        {{-- <h2 class="address">Base in Los Angeles, CA</h2> --}}
        @isset ($portfolio->about->brief)
            <p class="copyright">{{ $portfolio->about->brief }}</p>
        @endisset
        <ul class="social-profile d-flex align-items-center flex-wrap justify-content-center">
            @if (isset($portfolio->contactMethods) && $portfolio->contactMethods->count() > 0)
                @foreach ($portfolio->contactMethods as $contactMethod)
                    <li><a class="d-flex align-items-center justify-content-center"
                            href="{{ getContactLink($contactMethod->contactMethod->title, $contactMethod->value) }}">{!! $contactMethod->contactMethod->logo !!}</a>
                    </li>
                @endforeach
            @endif
        </ul>
        @if ($portfolio->accept_messages)
            <a href="#contact" class="theme-btn">
                <i class="las la-envelope"></i> Contact Me
            </a>
        @endif
    </div>
@endif
