<section class="contact-area" id="contact">
    <div class="container">
        <div class="gx-row d-flex justify-content-between gap-24">
            <div class="contact-infos">
                <h3 data-aos="fade-up">Contact Info</h3>
                <ul class="contact-details">
                    @foreach ($portfolio->contactMethods as $contactMethod)
                        <a href="{{ getContactLink($contactMethod->contactMethod->title, $contactMethod->value) }}">
                            <li class="d-flex align-items-center" data-aos="zoom-in">
                                <div class="icon-box shadow-box">
                                    {!! $contactMethod->contactMethod->logo !!}
                                </div>
                                <div class="right">
                                    <span>{{ $contactMethod->contactMethod->title }}</span>
                                    <h4>{{ $contactMethod->value }}</h4>

                                </div>
                            </li>
                        </a>
                    @endforeach

                </ul>

            </div>

            <div data-aos="zoom-in" class="contact-form">
                <div class="shadow-box">
                    <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG" class="bg-img">
                    <img src="{{ asset('template_assets/gridx/images/icon3.png') }}" alt="Icon">
                    <h1>Let’s work <span>together.</span></h1>
                    <form method="POST"
                        action="{{ route('portfolio.message.store', ['portfolio_slug' => $portfolio->slug]) }}">
                        {{-- <div class="alert alert-success messenger-box-contact__msg" style="display: none" role="alert">
                                    Your message was sent successfully.
                                </div> --}}
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" id="full-name" placeholder="Name *"
                                value="{{ old('name') }}">
                            @error('name')
                                <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group">
                            <input type="email" name="email" id="email" placeholder="Email *"
                                value="{{ old('email') }}">
                            @error('email')
                                <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input-group">
                            <textarea name="message" id="message" placeholder="Your Message *">
                                          {{ old('message') }}
                                    </textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group">
                            <button class="theme-btn submit-btn" name="submit" type="submit">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
