<template>
  <div>
    <div
      data-collapse="medium"
      data-animation="default"
      data-duration="400"
      data-no-scroll="1"
      class="navbar w-nav"
    >
      <div class="container-2 w-container">
        <a href="/" class="logo-block w-nav-brand w--current">
          <img src="/images/5e0fd4664b55b08aeb293a0d_logo.png" alt class="logo" />
          <div>CrewMSG</div>
        </a>

        <div role="navigation" class="nav-menu w-nav-menu">
          <a href="/" class="nav-link light w-nav-link w--current">{{$t('home_page.home')}}</a>
          <a href="/sailors" class="nav-link light w-nav-link">{{$t('home_page.for_sailors')}}</a>
          <a href="/companies" class="nav-link light w-nav-link">{{$t('home_page.for_companies')}}</a>
          <!--
          <a href="/login" class="nav-link with-color-copy w-nav-link">LOG IN</a>
          <a href="/register" class="nav-link with-color w-nav-link">SIGN UP</a>

          <a href="/" class="nav-link with-color w-nav-link">User role and name</a>
          <a
            class="nav-link with-color-copy w-nav-link"
            href="/logout"
            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
          >
            <span>Log Out</span>
            <i class="si si-logout ml-1"></i>
          </a>
          <-->
          <div data-delay="0" class="w-dropdown">
            <div class="dropdown-toggle light-flag w-dropdown-toggle">
              <span style="color:#fff;">{{ locales[locale] }}</span>
              
              <img
                :src="'/images/'+locales[locale]+'.svg'"
                alt
                class="image-5"                
              />

              <div class="small-dropdown-icon w-icon-dropdown-toggle"></div>
            </div>
            <nav class="dropdown-list-flag w-dropdown-list">
              <a
                v-for="(value, key) in locales"
                :key="key"
                class="link-block w-inline-block nav-link light w-nav-link"
                @click.prevent="setLocale(key)"
              >
                {{ value }}
                <img
                  :src="'/images/'+value+'.svg'"
                  alt
                  class="image-5"
                />
              </a>
            </nav>
          </div>
        </div>

        <div class="transparant-menu-button w-nav-button">
          <div class="w-icon-nav-menu"></div>
        </div>
      </div>
    </div>
    <div
      data-autoplay="true"
      data-loop="true"
      data-wf-ignore="true"
      data-poster-url="https://uploads-ssl.webflow.com/5dff97a6323c6a6f2bdc9bde/5dff9887dcc8ad72956ca626_video-poster-00001.jpg"
      data-video-urls="https://uploads-ssl.webflow.com/5dff97a6323c6a6f2bdc9bde/5dff9887dcc8ad72956ca626_video-transcode.mp4,https://uploads-ssl.webflow.com/5dff97a6323c6a6f2bdc9bde/5dff9887dcc8ad72956ca626_video-transcode.webm"
      class="hero-background-video w-background-video w-background-video-atom"
    >
      <video
        autoplay
        loop
        style="background-image:url('https://uploads-ssl.webflow.com/5dff97a6323c6a6f2bdc9bde/5dff9887dcc8ad72956ca626_video-poster-00001.jpg')"
        muted
        playsinline
        data-wf-ignore="true"
        data-object-fit="cover"
      >
        <source
          src="https://uploads-ssl.webflow.com/5dff97a6323c6a6f2bdc9bde/5dff9887dcc8ad72956ca626_video-transcode.mp4"
          data-wf-ignore="true"
        ></source>
        <source
          src="https://uploads-ssl.webflow.com/5dff97a6323c6a6f2bdc9bde/5dff9887dcc8ad72956ca626_video-transcode.webm"
          data-wf-ignore="true"
        /></source>
      </video>
      <div class="hero-block-overlay business">
        <div class="container hero-container w-container">
          <h1 data-ix="fade-in-on-load" class="hero-main-title">CrewMSG</h1>
          <h2 data-ix="fade-in-on-load-2" class="hero-main-title subtitle">
            {{$t('home_page.home_description')}}
            <br />
          </h2>
        </div>
      </div>
    </div>
    <div class="section no">
      <div class="container w-container">
        <div class="div-block-3">
          <a href="#" class="hero-inform-block w-inline-block">
            <div class="div-block-2">
              <img src="/images/5e066f0477d7417d5a3cbee8_ship.svg" height="50" alt class="image-3" />
              <div class="text-block">POST A VACANCY</div>
            </div>
            <div class="text-block-2">
              <strong>145200+</strong>
              <span class="text-span">seamen available for job</span>
            </div>
          </a>
          <a href="#" class="hero-inform-block _2 w-inline-block">
            <div class="div-block-2">
              <img
                src="/images/5dff97a6323c6acd94dc9c27_Icon-suitcase-white2.png"
                height="50"
                alt
                class="image-3"
              />
              <div class="text-block">CREATE A PROFILE</div>
            </div>
            <div class="text-block-2">
              <strong>145200+</strong>
              <span class="text-span">open vacancies for today</span>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="section tint-2">
      <div class="container w-container">
        <div class="section-title-wrapper small-title">
          <div class="small-section-title">We've been trusted by</div>
        </div>
      </div>
      <div
        data-delay="4000"
        data-animation="slide"
        data-autoplay="1"
        data-easing="ease-in-out-sine"
        data-duration="1000"
        data-infinite="1"
        class="trusted-slider w-slider"
      >
        <div class="w-slider-mask">
          <div class="testimonial-slide w-slide">
            <div class="container testimonial-container w-container">
              <div class="trusted-block">
                <div class="logos-row w-row">
                  <div class="logo-column w-col w-col-3">
                    <img
                      src="/images/5e00ae6610bfa74e369ff138_transport-offshore.png"
                      alt
                      class="client-logo _2"
                    />
                  </div>
                  <div class="logo-column w-col w-col-3">
                    <img
                      src="/images/5e00ae66dcc8ad4c9c722c1b_alfa-navigation.png"
                      alt
                      class="client-logo _2"
                    />
                  </div>
                  <div class="logo-column w-col w-col-3">
                    <img
                      src="/images/5e00ae66e5da77783d85092a_vships.png"
                      alt
                      class="client-logo _2"
                    />
                  </div>
                  <div class="logo-column w-col w-col-3">
                    <img
                      src="/images/5e1055f9c7ec61930ca37e02_Component2097.png"
                      alt
                      class="client-logo _2"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="testimonial-slide w-slide">
            <div class="container testimonial-container w-container">
              <div class="trusted-block">
                <div class="logos-row w-row">
                  <div class="logo-column w-col w-col-3">
                    <img
                      src="/images/5e00ae66dcc8ada0a1722c1a_baltic-shipping.png"
                      alt
                      class="client-logo _2"
                    />
                  </div>
                  <div class="logo-column w-col w-col-3">
                    <img
                      src="/images/5e00ae65dcc8ad4f9b722c18_bibby-ship-management.png"
                      alt
                      class="client-logo _2"
                    />
                  </div>
                  <div class="logo-column w-col w-col-3">
                    <img
                      src="/images/5e00ae64e5da7713d2850929_marlow-navigation.png"
                      alt
                      class="client-logo _2"
                    />
                  </div>
                  <div class="logo-column w-col w-col-3">
                    <img
                      src="/images/5e00ae66dcc8ad4c9c722c1b_alfa-navigation.png"
                      alt
                      class="client-logo _2"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="testimonial-slide w-slide">
            <div class="container testimonial-container w-container">
              <div class="trusted-block">
                <div class="logos-row w-row">
                  <div class="logo-column w-col w-col-3">
                    <img
                      src="/images/5e00ae66e5da77783d85092a_vships.png"
                      alt
                      class="client-logo _2"
                    />
                  </div>
                  <div class="logo-column w-col w-col-3">
                    <img
                      src="/images/5e00ae6610bfa74e369ff138_transport-offshore.png"
                      alt
                      class="client-logo _2"
                    />
                  </div>
                  <div class="logo-column w-col w-col-3">
                    <img
                      src="/images/5e00ae66dcc8ada0a1722c1a_baltic-shipping.png"
                      alt
                      class="client-logo _2"
                    />
                  </div>
                  <div class="logo-column w-col w-col-3">
                    <img
                      src="/images/5e00ae6610bfa74e369ff138_transport-offshore.png"
                      alt
                      class="client-logo _2"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-slider-arrow w-slider-arrow-left">
          <div class="w-icon-slider-left"></div>
        </div>
        <div class="testimonial-slider-arrow w-slider-arrow-right">
          <div class="w-icon-slider-right"></div>
        </div>
        <div
          class="w-hidden-main w-hidden-medium w-hidden-small w-hidden-tiny w-slider-nav w-round"
        ></div>
      </div>
    </div>
    <div class="section">
      <div class="container w-container">
        <div class="overall-row w-row">
          <div class="about-us-col-left w-col w-col-6">
            <h2 class="section-title">Want to learn more?</h2>
            <div
              class="section-description"
            >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Lorem ipsum dolor sit amet.</div>
            <a href="#" class="button w-button">view all employees</a>
          </div>
          <div class="video-column-right-2 w-col w-col-6">
            <a href="#" class="overall-video-lightbox w-inline-block w-lightbox">
              <div class="video-lightbox-image-block">
                <div class="video-lightbox-button">
                  <img
                    src="/images/5dff97a6323c6a0819dc9c56_Icon-play-white.png"
                    alt
                    class="video-lightbox-icon"
                  />
                </div>
              </div>
              <script type="application/json" class="w-json">
  {
    "items": [
      {
        "type": "video",
        "originalUrl": "https:\/\/www.youtube.com\/watch?v=UOZ2hBWdNr0",
        "url": "images\/watch?v=UOZ2hBWdNr0",
        "html": "<iframe class=\"embedly-embed\" src=\"\/\/cdn.embedly.com\/widgets\/media.html?src=https%3A%2F%2Fwww.youtube.com%2Fembed%2FUOZ2hBWdNr0%3Ffeature%3Doembed&url=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3DUOZ2hBWdNr0&image=https%3A%2F%2Fi.ytimg.com%2Fvi%2FUOZ2hBWdNr0%2Fhqdefault.jpg&key=96f1f04c5f4143bcb0f2e68c87d65feb&type=text%2Fhtml&schema=youtube\" width=\"940\" height=\"528\" scrolling=\"no\" frameborder=\"0\" allow=\"autoplay; fullscreen\" allowfullscreen=\"true\">",
        "thumbnailUrl": "https:\/\/i.ytimg.com\/vi\/UOZ2hBWdNr0\/hqdefault.jpg",
        "width": 940,
        "height": 528
      }
    ]
  }
              </script>
            </a>
          </div>
        </div>
        <div class="top-line-block">
          <div class="text-row w-row">
            <div class="text-column w-col w-col-4">
              <div class="text-column-title number">1</div>
              <div class="text-column-title">Безопасная работа</div>
              <p
                class="small-paragraph"
              >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra.</p>
            </div>
            <div class="text-column w-col w-col-4">
              <div class="text-column-title number">2</div>
              <div class="text-column-title">Проверенные исполнители</div>
              <p
                class="small-paragraph"
              >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra.</p>
            </div>
            <div class="text-column w-col w-col-4">
              <div class="text-column-title number">3</div>
              <div class="text-column-title">Боты помощники</div>
              <p
                class="small-paragraph"
              >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="image-section">
      <div class="image-section-overlay dark-gradient">
        <div class="container w-container">
          <div class="section-title-wrapper full">
            <h2 class="section-title">Справочник судовых компаний и судов</h2>
            <div
              class="section-description small"
            >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat.</div>
          </div>
          <div class="feature-info-row w-row">
            <div class="feature-info-column w-col w-col-4">
              <div class="feature-info-block w-clearfix">
                <img
                  src="/images/5dff97a6323c6ae2efdc9c6b_Icon-globe-white.png"
                  alt
                  class="feature-info-icon"
                />
                <div class="feature-info-title">Lorem ipsum</div>
                <p
                  class="feature-info-paragraph"
                >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat.</p>
              </div>
            </div>
            <div class="feature-info-column w-col w-col-4">
              <div class="feature-info-block w-clearfix">
                <img
                  src="/images/5dff97a6323c6a79dfdc9c19_Icon-list-white.png"
                  alt
                  class="feature-info-icon"
                />
                <div class="feature-info-title">Lorem ipsum</div>
                <p
                  class="feature-info-paragraph"
                >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat.</p>
              </div>
            </div>
            <div class="feature-info-column w-col w-col-4">
              <div class="feature-info-block w-clearfix">
                <img
                  src="/images/5dff97a6323c6a59dddc9c44_Icon-rss.png"
                  alt
                  class="feature-info-icon"
                />
                <div class="feature-info-title">Lorem ipsum</div>
                <p
                  class="feature-info-paragraph"
                >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat.</p>
              </div>
            </div>
          </div>
          <div class="feature-info-row w-row">
            <div class="feature-info-column w-col w-col-4">
              <div class="feature-info-block w-clearfix">
                <img
                  src="/images/5dff97a6323c6a3c7fdc9ce6_Icon-reuse.png"
                  alt
                  class="feature-info-icon"
                />
                <div class="feature-info-title">Lorem ipsum</div>
                <p
                  class="feature-info-paragraph"
                >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat.</p>
              </div>
            </div>
            <div class="feature-info-column w-col w-col-4">
              <div class="feature-info-block w-clearfix">
                <img
                  src="/images/5dff97a6323c6aadbbdc9c6e_Icon-eye.png"
                  alt
                  class="feature-info-icon"
                />
                <div class="feature-info-title">Lorem ipsum</div>
                <p
                  class="feature-info-paragraph"
                >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat.</p>
              </div>
            </div>
            <div class="feature-info-column last w-col w-col-4">
              <div class="feature-info-block w-clearfix">
                <img
                  src="/images/5dff97a6323c6a87d9dc9c17_Icon-heart.png"
                  alt
                  class="feature-info-icon"
                />
                <div class="feature-info-title">Lorem ipsum</div>
                <p
                  class="feature-info-paragraph"
                >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container w-container">
        <div class="section-title-wrapper">
          <h2 class="section-title">Vacancies for Seamen</h2>
          <div
            class="section-description"
          >Online applying for Open Vacancies is the fastest way to represent CV to Employers</div>
        </div>
        <div data-duration-in="300" data-duration-out="100" class="process-tabs w-tabs">
          <div class="portfolio-tabs-menu w-tab-menu">
            <a data-w-tab="Tab 1" class="portfolio-tab-button w-inline-block w-tab-link w--current">
              <div>Hot jobs</div>
            </a>
            <a data-w-tab="Tab 2" class="portfolio-tab-button w-inline-block w-tab-link">
              <div>Naval officers</div>
            </a>
            <a data-w-tab="Tab 3" class="portfolio-tab-button w-inline-block w-tab-link">
              <div>Service staff</div>
            </a>
            <a data-w-tab="Tab 4" class="portfolio-tab-button w-inline-block w-tab-link">
              <div>Technical</div>
            </a>
            <a data-w-tab="Tab 5" class="portfolio-tab-button w-inline-block w-tab-link">
              <div>specialists</div>
            </a>
          </div>
          <div class="w-tab-content">
            <div data-w-tab="Tab 1" class="process-tab-pane w-tab-pane w--tab-active">
              <div class="columns w-row">
                <div class="w-col w-col-4">
                  <div class="team-outline-block">
                    <img
                      src="/images/5e00ae66e5da77783d85092a_vships.png"
                      alt
                      class="team-portrait-image"
                    />
                    <div class="team-block-title smaller">Master on AHTS</div>
                    <div class="team-block-title subtitle small-subtitle">Vacancy ID: 129148</div>
                    <ul class="w-list-unstyled">
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a14fbdc9c61_Icon-pencil-blue.png"
                          alt
                          class="image-4"
                        />
                        <div>Salary: 350 $ / month</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a0d2adc9cc9_Icon-pencil-purple.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Join date: 03.01.2020</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a1987dc9c14_Icon-pencil.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Duration: 2+-1 month</div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="w-col w-col-4">
                  <div class="team-outline-block">
                    <img
                      src="/images/5e00ae66dcc8ada0a1722c1a_baltic-shipping.png"
                      alt
                      class="team-portrait-image"
                    />
                    <div class="team-block-title smaller">Master on AHTS</div>
                    <div class="team-block-title subtitle small-subtitle">Vacancy ID: 129148</div>
                    <ul class="w-list-unstyled">
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a14fbdc9c61_Icon-pencil-blue.png"
                          alt
                          class="image-4"
                        />
                        <div>Salary: 350 $ / month</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a0d2adc9cc9_Icon-pencil-purple.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Join date: 03.01.2020</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a1987dc9c14_Icon-pencil.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Duration: 2+-1 month</div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="w-col w-col-4">
                  <div class="team-outline-block">
                    <img
                      src="/images/5e00ae6610bfa74e369ff138_transport-offshore.png"
                      alt
                      class="team-portrait-image"
                    />
                    <div class="team-block-title smaller">Master on AHTS</div>
                    <div class="team-block-title subtitle small-subtitle">Vacancy ID: 129148</div>
                    <ul class="w-list-unstyled">
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a14fbdc9c61_Icon-pencil-blue.png"
                          alt
                          class="image-4"
                        />
                        <div>Salary: 350 $ / month</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a0d2adc9cc9_Icon-pencil-purple.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Join date: 03.01.2020</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a1987dc9c14_Icon-pencil.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Duration: 2+-1 month</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div data-w-tab="Tab 2" class="process-tab-pane w-tab-pane">
              <div class="columns w-row">
                <div class="w-col w-col-4">
                  <div class="team-outline-block">
                    <img
                      src="/images/5e00ae66e65e066d64dc119f_Marine20Selection20Ltd_company_logo_921.jpg"
                      alt
                      class="team-portrait-image"
                    />
                    <div class="team-block-title smaller">Master on AHTS</div>
                    <div class="team-block-title subtitle small-subtitle">Vacancy ID: 129148</div>
                    <ul class="w-list-unstyled">
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a14fbdc9c61_Icon-pencil-blue.png"
                          alt
                          class="image-4"
                        />
                        <div>Salary: 350 $ / month</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a0d2adc9cc9_Icon-pencil-purple.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Join date: 03.01.2020</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a1987dc9c14_Icon-pencil.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Duration: 2+-1 month</div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="w-col w-col-4">
                  <div class="team-outline-block">
                    <img
                      src="/images/5e00ae66e5da77783d85092a_vships.png"
                      alt
                      class="team-portrait-image"
                    />
                    <div class="team-block-title smaller">Master on AHTS</div>
                    <div class="team-block-title subtitle small-subtitle">Vacancy ID: 129148</div>
                    <ul class="w-list-unstyled">
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a14fbdc9c61_Icon-pencil-blue.png"
                          alt
                          class="image-4"
                        />
                        <div>Salary: 350 $ / month</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a0d2adc9cc9_Icon-pencil-purple.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Join date: 03.01.2020</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a1987dc9c14_Icon-pencil.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Duration: 2+-1 month</div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="w-col w-col-4">
                  <div class="team-outline-block">
                    <img
                      src="/images/5e00ae64e5da7713d2850929_marlow-navigation.png"
                      alt
                      class="team-portrait-image"
                    />
                    <div class="team-block-title smaller">Master on AHTS</div>
                    <div class="team-block-title subtitle small-subtitle">Vacancy ID: 129148</div>
                    <ul class="w-list-unstyled">
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a14fbdc9c61_Icon-pencil-blue.png"
                          alt
                          class="image-4"
                        />
                        <div>Salary: 350 $ / month</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a0d2adc9cc9_Icon-pencil-purple.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Join date: 03.01.2020</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a1987dc9c14_Icon-pencil.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Duration: 2+-1 month</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div data-w-tab="Tab 3" class="process-tab-pane w-tab-pane">
              <div class="columns w-row">
                <div class="w-col w-col-4">
                  <div class="team-outline-block">
                    <img
                      src="/images/5e00ae66e65e066d64dc119f_Marine20Selection20Ltd_company_logo_921.jpg"
                      alt
                      class="team-portrait-image"
                    />
                    <div class="team-block-title smaller">Master on AHTS</div>
                    <div class="team-block-title subtitle small-subtitle">Vacancy ID: 129148</div>
                    <ul class="w-list-unstyled">
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a14fbdc9c61_Icon-pencil-blue.png"
                          alt
                          class="image-4"
                        />
                        <div>Salary: 350 $ / month</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a0d2adc9cc9_Icon-pencil-purple.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Join date: 03.01.2020</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a1987dc9c14_Icon-pencil.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Duration: 2+-1 month</div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="w-col w-col-4">
                  <div class="team-outline-block">
                    <img
                      src="/images/5e00ae66e65e066d64dc119f_Marine20Selection20Ltd_company_logo_921.jpg"
                      alt
                      class="team-portrait-image"
                    />
                    <div class="team-block-title smaller">Master on AHTS</div>
                    <div class="team-block-title subtitle small-subtitle">Vacancy ID: 129148</div>
                    <ul class="w-list-unstyled">
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a14fbdc9c61_Icon-pencil-blue.png"
                          alt
                          class="image-4"
                        />
                        <div>Salary: 350 $ / month</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a0d2adc9cc9_Icon-pencil-purple.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Join date: 03.01.2020</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a1987dc9c14_Icon-pencil.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Duration: 2+-1 month</div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="w-col w-col-4">
                  <div class="team-outline-block">
                    <img
                      src="/images/5e00ae66e65e066d64dc119f_Marine20Selection20Ltd_company_logo_921.jpg"
                      alt
                      class="team-portrait-image"
                    />
                    <div class="team-block-title smaller">Master on AHTS</div>
                    <div class="team-block-title subtitle small-subtitle">Vacancy ID: 129148</div>
                    <ul class="w-list-unstyled">
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a14fbdc9c61_Icon-pencil-blue.png"
                          alt
                          class="image-4"
                        />
                        <div>Salary: 350 $ / month</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a0d2adc9cc9_Icon-pencil-purple.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Join date: 03.01.2020</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a1987dc9c14_Icon-pencil.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Duration: 2+-1 month</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div data-w-tab="Tab 4" class="process-tab-pane w-tab-pane">
              <div class="columns w-row">
                <div class="w-col w-col-4">
                  <div class="team-outline-block">
                    <img
                      src="/images/5e00ae64e5da7713d2850929_marlow-navigation.png"
                      alt
                      class="team-portrait-image"
                    />
                    <div class="team-block-title smaller">Master on AHTS</div>
                    <div class="team-block-title subtitle small-subtitle">Vacancy ID: 129148</div>
                    <ul class="w-list-unstyled">
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a14fbdc9c61_Icon-pencil-blue.png"
                          alt
                          class="image-4"
                        />
                        <div>Salary: 350 $ / month</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a0d2adc9cc9_Icon-pencil-purple.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Join date: 03.01.2020</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a1987dc9c14_Icon-pencil.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Duration: 2+-1 month</div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="w-col w-col-4">
                  <div class="team-outline-block">
                    <img
                      src="/images/5e00ae66e65e066d64dc119f_Marine20Selection20Ltd_company_logo_921.jpg"
                      alt
                      class="team-portrait-image"
                    />
                    <div class="team-block-title smaller">Master on AHTS</div>
                    <div class="team-block-title subtitle small-subtitle">Vacancy ID: 129148</div>
                    <ul class="w-list-unstyled">
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a14fbdc9c61_Icon-pencil-blue.png"
                          alt
                          class="image-4"
                        />
                        <div>Salary: 350 $ / month</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a0d2adc9cc9_Icon-pencil-purple.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Join date: 03.01.2020</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a1987dc9c14_Icon-pencil.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Duration: 2+-1 month</div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="w-col w-col-4">
                  <div class="team-outline-block">
                    <img
                      src="/images/5e00ae66e5da77783d85092a_vships.png"
                      alt
                      class="team-portrait-image"
                    />
                    <div class="team-block-title smaller">Master on AHTS</div>
                    <div class="team-block-title subtitle small-subtitle">Vacancy ID: 129148</div>
                    <ul class="w-list-unstyled">
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a14fbdc9c61_Icon-pencil-blue.png"
                          alt
                          class="image-4"
                        />
                        <div>Salary: 350 $ / month</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a0d2adc9cc9_Icon-pencil-purple.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Join date: 03.01.2020</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a1987dc9c14_Icon-pencil.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Duration: 2+-1 month</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div data-w-tab="Tab 5" class="process-tab-pane w-tab-pane">
              <div class="columns w-row">
                <div class="w-col w-col-4">
                  <div class="team-outline-block">
                    <img
                      src="/images/5e00ae64e5da7713d2850929_marlow-navigation.png"
                      alt
                      class="team-portrait-image"
                    />
                    <div class="team-block-title smaller">Master on AHTS</div>
                    <div class="team-block-title subtitle small-subtitle">Vacancy ID: 129148</div>
                    <ul class="w-list-unstyled">
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a14fbdc9c61_Icon-pencil-blue.png"
                          alt
                          class="image-4"
                        />
                        <div>Salary: 350 $ / month</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a0d2adc9cc9_Icon-pencil-purple.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Join date: 03.01.2020</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a1987dc9c14_Icon-pencil.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Duration: 2+-1 month</div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="w-col w-col-4">
                  <div class="team-outline-block">
                    <img
                      src="/images/5e00ae66dcc8ada0a1722c1a_baltic-shipping.png"
                      alt
                      class="team-portrait-image"
                    />
                    <div class="team-block-title smaller">Master on AHTS</div>
                    <div class="team-block-title subtitle small-subtitle">Vacancy ID: 129148</div>
                    <ul class="w-list-unstyled">
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a14fbdc9c61_Icon-pencil-blue.png"
                          alt
                          class="image-4"
                        />
                        <div>Salary: 350 $ / month</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a0d2adc9cc9_Icon-pencil-purple.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Join date: 03.01.2020</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a1987dc9c14_Icon-pencil.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Duration: 2+-1 month</div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="w-col w-col-4">
                  <div class="team-outline-block">
                    <img
                      src="/images/5e00ae66dcc8ada0a1722c1a_baltic-shipping.png"
                      alt
                      class="team-portrait-image"
                    />
                    <div class="team-block-title smaller">Master on AHTS</div>
                    <div class="team-block-title subtitle small-subtitle">Vacancy ID: 129148</div>
                    <ul class="w-list-unstyled">
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a14fbdc9c61_Icon-pencil-blue.png"
                          alt
                          class="image-4"
                        />
                        <div>Salary: 350 $ / month</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a0d2adc9cc9_Icon-pencil-purple.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Join date: 03.01.2020</div>
                      </li>
                      <li class="list-item">
                        <img
                          src="/images/5dff97a6323c6a1987dc9c14_Icon-pencil.png"
                          height="14"
                          alt
                          class="image-4"
                        />
                        <div>Duration: 2+-1 month</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="div-block-3-copy">
          <a href="#" class="button w-button">see all vacancies</a>
        </div>
      </div>
    </div>
    <div class="section feature-section">
      <div class="container w-container">
        <div class="feature-text-block right">
          <h2 class="section-title">Справочник судовых компаний и судов</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.</p>
          <a href="#" class="button w-button">watch reference</a>
          <a href="/sign-up-forms/sign-up.html" class="button _2 w-button">Upload information</a>
        </div>
        <img
          src="/images/5dffa489dcc8adca2d6cf955_architecture-bay-boats-799091-2400x1594.jpg"
          alt
          class="browser-mockup-left small"
        />
      </div>
    </div>
    <div class="section feature-section">
      <div class="container w-container">
        <div class="feature-text-block">
          <div class="feature-intro-title">Справочник судовых компаний и судов</div>
          <h2 class="main-feature-title">Справочник судовых компаний и судов</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.</p>
          <a href="#" class="button w-button">find workers</a>
        </div>
        <img
          src="/images/5dffa977dcc8adba346d1a26_ps09312-website-header_663x260_v2.jpg"
          alt
          class="browser-mockup-right small"
        />
      </div>
    </div>
    <div class="section">
      <div class="container w-container">
        <img src="/images/5dffa48810bfa7100c9a14a2_Borja.jpg" alt class="browser-mockup-left" />
        <div class="feature-text-block right">
          <h2 class="section-title">Services for employer</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero.</p>
          <div class="small-features-wrapper">
            <div data-ix="fade-in-on-scroll" class="long-feature-block title-only">
              <div class="long-feature-icon-wrapper">
                <img
                  src="/images/5dff97a6323c6a14fbdc9c61_Icon-pencil-blue.png"
                  alt
                  class="long-feature-icon"
                />
              </div>
              <div class="long-feature-title uppercase">Suspendisse varius enim in eros</div>
              <div class="small-paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
            </div>
            <div data-ix="fade-in-on-scroll" class="long-feature-block title-only">
              <div class="long-feature-icon-wrapper">
                <img
                  src="/images/5dff97a6323c6a46f4dc9cae_Icon-thumb-blue.png"
                  alt
                  class="long-feature-icon"
                />
              </div>
              <div class="long-feature-title uppercase">Lorem ipsum dolor sit amet</div>
              <div class="small-paragraph">Duis cursus, mi quis viverra ornare, eros dolor.</div>
            </div>
            <div data-ix="fade-in-on-scroll" class="long-feature-block title-only">
              <div class="long-feature-icon-wrapper">
                <img
                  src="/images/5dff97a6323c6afb43dc9c66_Icon-plane-blue.png"
                  alt
                  class="long-feature-icon"
                />
              </div>
              <div class="long-feature-title uppercase">Сonsectetur adipiscing elit</div>
              <div class="small-paragraph">Eros elementum tristique. Duis cursus, mi quis.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="intro" class="section">
      <div class="container w-container">
        <img
          src="/images/5dffa489dcc8adca2d6cf955_architecture-bay-boats-799091-2400x1594.jpg"
          alt
          class="browser-mockup-right"
        />
        <div class="feature-text-block">
          <h2 class="section-title">Services for seafarers</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero.</p>
          <div class="small-features-wrapper">
            <div data-ix="fade-in-on-scroll" class="long-feature-block title-only">
              <div class="long-feature-icon-wrapper">
                <img
                  src="/images/5dff97a6323c6a46f4dc9cae_Icon-thumb-blue.png"
                  alt
                  class="long-feature-icon"
                />
              </div>
              <div class="long-feature-title uppercase">Сonsectetur adipiscing elit</div>
              <div class="small-paragraph">Duis cursus, mi quis viverra ornare, eros dolor.</div>
            </div>
            <div data-ix="fade-in-on-scroll" class="long-feature-block title-only">
              <div class="long-feature-icon-wrapper">
                <img
                  src="/images/5dff97a6323c6a74c2dc9c3a_Icon-megaphone-blue.png"
                  alt
                  class="long-feature-icon"
                />
              </div>
              <div class="long-feature-title uppercase">Suspendisse varius enim in eros</div>
              <div class="small-paragraph">Eros elementum tristique. Duis cursus, mi quis.</div>
            </div>
            <div data-ix="fade-in-on-scroll" class="long-feature-block title-only">
              <div class="long-feature-icon-wrapper">
                <img
                  src="/images/5dff97a6323c6afb43dc9c66_Icon-plane-blue.png"
                  alt
                  class="long-feature-icon"
                />
              </div>
              <div class="long-feature-title uppercase">Lorem ipsum dolor sit amet</div>
              <div class="small-paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div
        data-animation="slide"
        data-duration="400"
        data-infinite="1"
        data-delay="4000"
        data-autoplay="1"
        class="testimonial-slider w-slider"
      >
        <div class="w-slider-mask">
          <div class="testimonial-slide w-slide">
            <div class="container testimonial-container w-container">
              <div class="testimonial-block">
                <img
                  src="/images/5dff97a6323c6a4308dc9cc8_Testimonial-14.jpg"
                  alt
                  class="testimonial-image"
                />
                <p
                  class="testimonial-quote"
                >"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat."</p>
                <div class="testimonial-info-block">
                  <div class="testimonial-name">Angelina Deckinword</div>
                  <div class="testimonial-name subtitle">young sailor</div>
                </div>
              </div>
            </div>
          </div>
          <div class="testimonial-slide w-slide">
            <div class="container testimonial-container w-container">
              <div class="testimonial-block">
                <img
                  src="/images/5dff97a6323c6a4800dc9cca_Testimonial-15.jpg"
                  alt
                  class="testimonial-image"
                />
                <p
                  class="testimonial-quote"
                >"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat."</p>
                <div class="testimonial-info-block">
                  <div class="testimonial-name">Jonathon Black</div>
                  <div class="testimonial-name subtitle">sailor skipper</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-slider-arrow w-slider-arrow-left">
          <div class="w-icon-slider-left"></div>
        </div>
        <div class="testimonial-slider-arrow w-slider-arrow-right">
          <div class="w-icon-slider-right"></div>
        </div>
        <div
          class="w-hidden-main w-hidden-medium w-hidden-small w-hidden-tiny w-slider-nav w-round"
        ></div>
      </div>
    </div>
    <div class="image-section">
      <div class="image-section-overlay">
        <div class="container w-container">
          <div class="image-section-overlay-block">
            <div class="section-title">Join us NOW and find your dream job already today!</div>
            <div
              class="image-section-overlay-title subtitle"
            >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim.</div>
          </div>
        </div>
      </div>
    </div>
    <div class="section tint">
      <div class="container w-container">
        <div class="stats-row w-row">
          <div class="stats-column w-col w-col-4">
            <div class="stats-block w-clearfix">
              <div class="stats-number">54</div>
              <div class="stats-title">Lorem ipsum dolor sit amet, consectetur.</div>
            </div>
          </div>
          <div class="stats-column w-col w-col-4">
            <div class="stats-block w-clearfix">
              <div class="stats-number">120</div>
              <div class="stats-title">Varius enim in eros elementum tristique.</div>
            </div>
          </div>
          <div class="stats-column w-col w-col-4">
            <div class="stats-block w-clearfix">
              <div class="stats-number">1370</div>
              <div class="stats-title">Elementum tristique. Lorem ipsum dolor.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="simple-footer">
      <div class="container w-container">
        <div class="footer-row w-row">
          <div class="footer-logo-column-left w-col w-col-3">
            <div class="footer-logo">CrewMSG</div>
            <div class="footer-logo subtitle">ВАША КАРЬЕРА В МОРЕ</div>
          </div>
          <div class="footer-menu-column w-col w-col-6">
            <a href="#" class="footer-inline-link">About us</a>
            <a href="#" class="footer-inline-link">opportunities</a>
            <a href="#" class="footer-inline-link">Pricing</a>
            <a href="#" class="footer-inline-link">Blog</a>
            <a href="#" class="footer-inline-link">Contact</a>
          </div>
          <div class="footer-social-col-right w-col w-col-3">
            <a
              href="http://www.facebook.com"
              target="_blank"
              class="footer-social-icon w-inline-block"
            >
              <img
                src="/images/5dff97a6323c6a2940dc9c55_Icon-facebook.png"
                alt
                class="footer-small-social-icon"
              />
            </a>
            <a
              href="http://www.twitter.com"
              target="_blank"
              class="footer-social-icon w-inline-block"
            >
              <img
                src="/images/5dff97a6323c6ac44adc9cc6_Icon-twitter.png"
                alt
                class="footer-small-social-icon"
              />
            </a>
            <a
              href="http://www.google.com"
              target="_blank"
              class="footer-social-icon w-inline-block"
            >
              <img
                src="/images/5dff97a6323c6a4f0ddc9caf_Icon-google.png"
                alt
                class="footer-small-social-icon"
              />
            </a>
          </div>
        </div>
      </div>
      <div class="simple-bottom-footer">
        <div class="container w-container">
          <p class="bottom-footer-paragraph">
            <strong data-new-link="true">Copyright © CrewMSG</strong> - 2020
          </p>
          <p class="bottom-footer-paragraph right">
            Подробнее
            <a
              href="https://policies.google.com/privacy?hl=ru"
              target="_blank"
              class="bottom-footer-link"
            >Политика конфиденциальности</a> и
            <a
              href="https://policies.google.com/privacy?hl=ru"
              target="_blank"
              class="bottom-footer-link"
            >Условия обслуживания</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { loadMessages } from "~/plugins/i18n";

export default {
  head: {
    title: "home",
    script: [     
      {
        src:
          "/js/jquery-3.4.1.min.js",
       
      },
       {
        src: "/js/webfont.js",
        
      },
      {
        src: "/js/webflow.js",
        defer: true,
      },
      {
        src: "/js/script.js",
        defer: true,
      },
    ],
    link: [
      {
        rel: "shortcut icon",
        href: "/images/5dff97a6323c6a818edc9c1e_Favicon.png",
        type: "image/x-icon",
      },
      {
        rel: "apple-touch-icon",
        href: "/images/5dff97a6323c6a818edc9c1e_Favicon.png",
      },
    ],

    meta: [
      // hid is used as unique identifier. Do not use `vmid` for it as it will not work
      {
        hid: "description",
        name: "description",
        content: "Startup Template - Webflow Responsive Website Template",
      },
      {
        property: "og:title",
        content: "Startup Template - Webflow Responsive Website Template",
      },
      {
        name: "viewport",
        content: "width=device-width, initial-scale=1",
      },
    ],
  },

  computed: mapGetters({
    locale: "lang/locale",
    locales: "lang/locales",
  }),

  methods: {
    setLocale(locale) {
      if (this.$i18n.locale !== locale) {
        loadMessages(locale);

        this.$store.dispatch("lang/setLocale", { locale });
      }
    },
  },
};
</script>

<style scoped>
.navbar {
  position: fixed;
  left: 0px;
  top: 0px;
  right: 0px;
  padding: 15px 20px;
  border-bottom: 1px solid hsla(0, 0%, 100%, 0.1);
  background-color: rgba(4, 25, 44, 0.76);
}
.nav-link {
  
  padding: 0.5rem 1rem;
  margin-top: 16px !important;
}
</style>
