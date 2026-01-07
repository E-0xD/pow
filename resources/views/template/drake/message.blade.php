<section class="contact-area page-section scroll-content" id="contact">
    <div class="custom-container">
        <div class="contact-content content-width">
            <div class="section-header">
                <h4 class="subtitle scroll-animation" data-animation="fade_from_bottom">
                    <i class="las la-dollar-sign"></i> contact
                </h4>
                <h1 class="scroll-animation" data-animation="fade_from_bottom">Let's Work <span>Together!</span></h1>
            </div>
           

            <form class="contact-form scroll-animation" data-animation="fade_from_bottom" method="POST"
                action="{{ route('portfolio.message.store', ['portfolio_slug' => $portfolio->slug]) }}">
                {{-- <div class="alert alert-success messenger-box-contact__msg" style="display: none" role="alert">
                    Your message was sent successfully.
                </div> --}}
                @csrf
                <div class="row">

                    <div class="col-md-6">
                        <div class="input-group">
                            <label for="full-name">full Name <sup>*</sup></label>
                            <input type="text" name="name" id="full-name" placeholder="Your Full Name" value="{{ old('name') }}">
                            @error('name')
                                <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group">
                            <label for="email">Email <sup>*</sup></label>
                            <input type="email" name="email" id="email" placeholder="Your email address" value="{{ old('email') }}">
                            @error('email')
                                <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" placeholder="Wrire your message here ...">
                                {{ old('message') }}
                            </textarea>
                            @error('message')
                                    <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group submit-btn-wrap">
                            <button class="theme-btn" type="submit">
                                Send Message
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</section>
