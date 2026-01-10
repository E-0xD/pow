  <section class="about-area" id="about">
      <div class="container">
          <div class="d-flex about-me-wrap align-items-start gap-24">
              <div data-aos="zoom-in">
                  <div class="about-image-box shadow-box">
                      <img src="{{ asset('template_assets/gridx/images/bg1.png') }}" alt="BG" class="bg-img">
                      <div class="image-inner">
                          <img src="{{ Storage::url($portfolio->about->logo) }}" alt="About Me">
                      </div>
                  </div>
              </div>

              <div class="about-details" data-aos="zoom-in">
                  <h1 class="section-heading" data-aos="fade-up"><img
                          src="{{ asset('template_assets/gridx/images/star-2.png') }}" alt="Star"> Self-summary
                      <img src="{{ asset('template_assets/gridx/images/star-2.png') }}" alt="Star">
                  </h1>
                  <div class="about-details-inner shadow-box">
                      <img src="{{ asset('template_assets/gridx/images/icon2.png') }}" alt="Star">
                      <h1>{{ $portfolio->about->name }}</h1>
                      <p>{{ formatText($portfolio->about->description) }}
                      </p>
                  </div>

              </div>
          </div>
      </div>
  </section>
