  <div class="header position-sticky">
      <div class="header-sidebar style-horizontal bs-light-mode">
          <div class="box">
              <div class="w-[68px] h-[68px] rounded-full overflow-hidden">
                  <img src="{{ $portfolio->about->logo ? Storage::url($portfolio->about->logo) : asset(config('app.favicon')) }}"
                      alt="avatar" class="w-full h-full object-cover"  width="68" height="68" >
              </div>

              <div class="info">
                  <h6 class="font-4 mb_4"> {{ ucFirst($portfolio->about->name) }}</h6>
                  <div class="text-label text-uppercase fw-6 text_primary-color font-3  letter-spacing-1">
                      {{ ucFirst($portfolio->about->brief) }}</div>
              </div>
          </div>
          <ul class="nav-menu style-2 list-icon ">

              @foreach ($portfolio->sectionOrders->sortBy('position') as $sectionOrder)
                  @switch($sectionOrder->section_id)
                      @case('about')
                          <li>
                              <a class="nav_link active" href="#about">
                                  <i class="icon icon-User"></i>
                                  <span class="tooltip text-caption-1">About</span>
                              </a>
                          </li>
                      @break

                      @case('experience')
                          <li>
                              <a class="nav_link" href="#experience">
                                  <i class="icon icon-ReadCvLogo"></i>
                                  <span class="tooltip text-caption-1">Experience</span>
                              </a>
                          </li>
                      @break

                      @case('education')
                          <li>
                              <a class="nav_link" href="#education">
                                  <i class="icon icon-ReadCvLogo"></i>
                                  <span class="tooltip text-caption-1">Education</span>
                              </a>
                          </li>
                      @break

                      @case('skills')
                          <li>
                              <a class="nav_link" href="#skills">
                                  <i class="icon icon-GearFine"></i>
                                  <span class="tooltip text-caption-1">Skills</span>
                              </a>
                          </li>
                      @break

                      @case('projects')
                          <li>
                              <a class="nav_link" href="#projects">
                                  <i class="icon icon-Briefcase"></i>
                                  <span class="tooltip text-caption-1">Projects</span>
                              </a>
                          </li>
                      @break
                  @endswitch
              @endforeach

              @if ($portfolio->accept_messages)
                  <li>
                      <a class="nav_link" href="#contact">
                          <i class="icon icon-PaperPlaneTilt"></i>
                          <span class="tooltip text-caption-1">Contact</span>
                      </a>
                  </li>
              @endif
          </ul>
          <a class="menu-button show-menu-mobile  d-sm-none link-no-action" data-target="#menu-2" href="#"><i
                  class="icon-CirclesFour"></i></a>
          <div id="menu-2" class="popup-menu-mobile">
              <ul class="nav-menu style-3 ">

                  @foreach ($portfolio->sectionOrders->sortBy('position') as $sectionOrder)
                      @switch($sectionOrder->section_id)
                          @case('about')
                              <li class="text-menu text_white">
                                  <a href="#about"
                                      class="nav_link toggle splitting link link-no-action text-button font-3 fw-6">
                                      <span class="text" data-splitting="">About</span>
                                      <span class="text" data-splitting="">About</span>
                                  </a>
                              </li>
                          @break

                          @case('experience')
                              <li class="text-menu text_white">
                                  <a href="#experience"
                                      class="nav_link toggle splitting link link-no-action text-button font-3 fw-6">
                                      <span class="text" data-splitting="">Experience</span>
                                      <span class="text" data-splitting="">Experience</span>
                                  </a>
                              </li>
                          @break

                          @case('education')
                              <li class="text-menu text_white">
                                  <a href="#education"
                                      class="nav_link toggle splitting link link-no-action text-button font-3 fw-6">
                                      <span class="text" data-splitting="">Education</span>
                                      <span class="text" data-splitting="">Education</span>
                                  </a>
                              </li>
                          @break

                          @case('skills')
                              <li class="text-menu text_white">
                                  <a href="#skills"
                                      class="nav_link toggle splitting link link-no-action text-button font-3 fw-6">
                                      <span class="text" data-splitting="">Skills</span>
                                      <span class="text" data-splitting="">Skills</span>
                                  </a>
                              </li>
                          @break

                          @case('projects')
                              <li class="text-menu text_white">
                                  <a href="#portfolio"
                                      class="nav_link toggle splitting link link-no-action text-button font-3 fw-6">
                                      <span class="text" data-splitting="">Projects</span>
                                      <span class="text" data-splitting="">Projects</span>
                                  </a>
                              </li>
                          @break
                      @endswitch
                  @endforeach

                  @if ($portfolio->accept_messages)
                      <li class="text-menu text_white">
                          <a href="#contact"
                              class="nav_link toggle splitting link link-no-action text-button font-3 fw-6">
                              <span class="text" data-splitting="">Contact</span>
                              <span class="text" data-splitting="">Contact</span>
                          </a>
                      </li>
                  @endif
              </ul>
          </div>
      </div>
  </div>
