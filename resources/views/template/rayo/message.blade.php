    <footer id="mxd-footer contact" class="mxd-footer">

        <!-- Footer Block - Info Columns Start -->
        <div class="mxd-footer__footer-blocks">
            <!-- single column -->
            <div class="footer-blocks__column animate-card-3">
                <!-- inner card -->
                @foreach ($portfolio->contactMethods as $contactMethod)
                    <div class="footer-blocks__card">
                        <p class="mxd-point-subtitle anim-uni-in-up">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20px"
                                height="20px" viewBox="0 0 20 20" fill="currentColor">
                                <path fill="currentColor" d="M19.6,9.6c0,0-3,0-4,0c-0.4,0-1.8-0.2-1.8-0.2c-0.6-0.1-1.1-0.2-1.6-0.6c-0.5-0.3-0.9-0.8-1.2-1.2
                  c-0.3-0.4-0.4-0.9-0.5-1.4c0,0-0.1-1.1-0.2-1.5c-0.1-1.1,0-4.4,0-4.4C10.4,0.2,10.2,0,10,0S9.6,0.2,9.6,0.4c0,0,0.1,3.3,0,4.4
                  c0,0.4-0.2,1.5-0.2,1.5C9.4,6.7,9.2,7.2,9,7.6C8.7,8.1,8.2,8.5,7.8,8.9c-0.5,0.3-1,0.5-1.6,0.6c0,0-1.2,0.1-1.7,0.2
                  c-1,0.1-4.2,0-4.2,0C0.2,9.6,0,9.8,0,10c0,0.2,0.2,0.4,0.4,0.4c0,0,3.1-0.1,4.2,0c0.4,0,1.7,0.2,1.7,0.2c0.6,0.1,1.1,0.2,1.6,0.6
                  c0.4,0.3,0.8,0.7,1.1,1.1c0.3,0.5,0.5,1,0.6,1.6c0,0,0.1,1.3,0.2,1.7c0,1,0,4.1,0,4.1c0,0.2,0.2,0.4,0.4,0.4s0.4-0.2,0.4-0.4
                  c0,0,0-3.1,0-4.1c0-0.4,0.2-1.7,0.2-1.7c0.1-0.6,0.2-1.1,0.6-1.6c0.3-0.4,0.7-0.8,1.1-1.1c0.5-0.3,1-0.5,1.6-0.6
                  c0,0,1.3-0.1,1.8-0.2c1,0,4,0,4,0c0.2,0,0.4-0.2,0.4-0.4C20,9.8,19.8,9.6,19.6,9.6L19.6,9.6z"></path>
                            </svg>
                            <a
                                href="{{ getContactLink(title: $contactMethod->contactMethod->title, value: $contactMethod->value) }}">{{ $contactMethod->contactMethod->title }}</a>
                        </p>
                    </div>
                @endforeach

            </div>
            @if ($portfolio->accept_messages)
                <!-- single column -->
                <div class="footer-blocks__column animate-card-3">
                    <!-- inner card -->
                    <div class="footer-blocks__card fullheight-card">
                        <form class="form  form-light" method="POST"
                            action="{{ route('portfolio.message.store', ['portfolio_slug' => $portfolio->slug]) }}">
                            @csrf
                            <fieldset class="">
                                <input id="name" type="text" placeholder="Your name" name="name"
                                    tabindex="2" aria-required="true" required="" value="{{ old('name') }}">
                                @error('name')
                                    <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                @enderror
                            </fieldset>

                            <fieldset class="">
                                <input class="" type="email" placeholder="Your email" name="email"
                                    tabindex="2" value="{{ old('email') }}" id="email" aria-required="true"
                                    required="">
                                @error('email')
                                    <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                @enderror
                            </fieldset>

                            <fieldset>
                                <textarea id="message" name="message" class="" rows="4" placeholder="Your Message..." tabindex="2"
                                    aria-required="true" required="">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                @enderror
                            </fieldset>

                            <button type="submit" class="btn btn-anim btn-default btn-accent slide-right-up mt-5">
                                <span class="btn-caption">Submit</span>
                                <i class="ph-bold ph-arrow-up-right"></i>
                            </button>

                        </form>

                    </div>
                </div>
            @endif
        </div>
        <!-- Footer Block - Info Columns End -->

    </footer>
