<x-layouts.guest>
    <div id="home"></div>
    <!-- HeroSection -->
    <section class="flex flex-col gap-8 text-center items-center" id="home">
        <div class="flex flex-col gap-4">
            <h1
                class="text-text-light dark:text-text-dark text-4xl font-extrabold leading-tight tracking-tighter md:text-6xl">
                Create and Share Stunning Portfolios in Minutes</h1>
            <p
                class="text-subtle-light dark:text-subtle-dark text-base font-normal leading-normal md:text-xl max-w-3xl mx-auto">
                The ultimate SaaS platform for creating, customizing, and sharing your personal
                or business portfolios. Build credibility. Win clients. Seal your next gig.</p>
        </div>
        <div class="flex flex-wrap gap-3 justify-center">
            <a href="{{ route('register') }}"
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:opacity-90">
                <span
                    class="truncate">{{ config('app.status') == 'waitlist' ? 'Join the waitlist' : 'Start Proving Your Work' }}</span>
            </a>

        </div>
        <div
            class="w-full mt-8 aspect-[1/1] md:max-w-[600px] mx-auto
     bg-card-light dark:bg-card-dark rounded-xl 
     border border-border-light dark:border-border-dark shadow-lg">

            <video src="{{ asset('videos/brand.mp4') }}" class="w-full h-full object-cover rounded-xl" muted
                autoplay></video>
        </div>

    </section>

    <div id="features"></div>
    <!-- FeatureSection (Problem & Solution) -->
    <section class="flex flex-col" id="features">
        <div class="flex flex-col gap-10 ">
            <div class="flex flex-col gap-4 text-center">
                <h2
                    class="text-primary dark:text-white tracking-tight text-3xl font-bold leading-tight @[480px]:text-4xl @[480px]:font-black @[480px]:leading-tight @[480px]:tracking-[-0.033em] max-w-3xl mx-auto">
                    The old way was broken. We built a better one.</h2>
                <p
                    class="text-subtle-light dark:text-subtle-dark text-base font-normal leading-normal max-w-3xl mx-auto">
                    Creators face countless frustrations when building portfolios, from complex tools to high
                    costs.
                    POW simplifies the entire process, letting you focus on what truly matters: your work.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div class="flex flex-col gap-3">
                    <div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                        data-alt="Abstract image representing complexity and frustration"
                        style="background-image: url({{ asset('images/hero/about1.png') }});">
                    </div>
                    <div>
                        <h3 class="text-primary dark:text-white text-xl font-bold leading-normal">The Problem:
                            Complexity &amp; Cost</h3>
                        <p class="text-subtle-light dark:text-subtle-dark text-base font-normal leading-normal mt-1">
                            Building a professional portfolio is often time-consuming, requires technical skills,
                            and can be expensive to maintain.</p>
                    </div>
                </div>
                <div class="flex flex-col gap-3">
                    <div class="w-full bg-center bg-no-repeat bg-contain aspect-square bg-cover rounded-xl"
                        data-alt="Abstract image representing simplicity and power"
                        style="background-image: url({{ asset('images/hero/about2.png') }});">
                    </div>
                    <div>
                        <h3 class="text-primary dark:text-white text-xl font-bold leading-normal">The Solution:
                            Simplicity &amp; Power</h3>
                        <p class="text-subtle-light dark:text-subtle-dark text-base font-normal leading-normal mt-1">
                            POW offers an intuitive drag-and-drop builder, beautiful templates, and seamless
                            sharing, all in one affordable platform.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FeatureSection -->
    <section class="flex flex-col gap-10">
        <div class="flex flex-col gap-4 text-center items-center">
            <h2
                class="text-text-light dark:text-text-dark text-3xl font-bold leading-tight tracking-tight md:text-4xl max-w-[720px]">
                Everything you need to stand out</h2>
            <p class="text-subtle-light dark:text-subtle-dark text-base font-normal leading-normal max-w-[720px]">
                Our platform is packed with features designed to make your work shine and your
                process seamless.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-0">
            <div
                class="flex flex-1 gap-4 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark p-6 flex-col hover:border-primary/50 dark:hover:border-primary/50 transition-colors">
                <span class="material-symbols-outlined text-primary text-3xl">photo_library</span>
                <div class="flex flex-col gap-1">
                    <h3 class="text-primary dark:text-text-dark text-lg font-bold leading-tight">
                        Beautiful Templates</h3>
                    <p class="text-subtle-light dark:text-subtle-dark text-sm font-normal leading-normal">
                        Choose from a variety of professionally designed templates to get
                        started in seconds.</p>
                </div>
            </div>
            <div
                class="flex flex-1 gap-4 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark p-6 flex-col hover:border-primary/50 dark:hover:border-primary/50 transition-colors">
                <span class="material-symbols-outlined text-primary text-3xl">analytics</span>
                <div class="flex flex-col gap-1">
                    <h3 class="text-primary dark:text-text-dark text-lg font-bold leading-tight">
                        Powerful Analytics</h3>
                    <p class="text-subtle-light dark:text-subtle-dark text-sm font-normal leading-normal">
                        Understand your audience with built-in analytics and track your
                        portfolio's performance.</p>
                </div>
            </div>
            <div
                class="flex flex-1 gap-4 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark p-6 flex-col hover:border-primary/50 dark:hover:border-primary/50 transition-colors">
                <span class="material-symbols-outlined text-primary text-3xl">language</span>
                <div class="flex flex-col gap-1">
                    <h3 class="text-primary dark:text-text-dark text-lg font-bold leading-tight">
                        Custom Domain</h3>
                    <p class="text-subtle-light dark:text-subtle-dark text-sm font-normal leading-normal">
                        Connect your own domain to give your portfolio a professional, branded
                        address.</p>
                </div>
            </div>
            <div
                class="flex flex-1 gap-4 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark p-6 flex-col hover:border-primary/50 dark:hover:border-primary/50 transition-colors">
                <span class="material-symbols-outlined text-primary text-3xl">download</span>
                <div class="flex flex-col gap-1">
                    <h3 class="text-primary dark:text-text-dark text-lg font-bold leading-tight">
                        Easy Export</h3>
                    <p class="text-subtle-light dark:text-subtle-dark text-sm font-normal leading-normal">
                        Export your portfolio as a PDF or image gallery for offline use or
                        presentations.</p>
                </div>
            </div>
            <div
                class="flex flex-1 gap-4 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark p-6 flex-col hover:border-primary/50 dark:hover:border-primary/50 transition-colors">
                <span class="material-symbols-outlined text-primary text-3xl">mail</span>
                <div class="flex flex-col gap-1">
                    <h3 class="text-primary dark:text-text-dark text-lg font-bold leading-tight">
                        Contact Forms</h3>
                    <p class="text-subtle-light dark:text-subtle-dark text-sm font-normal leading-normal">
                        Easily add contact forms to your portfolio to capture leads and
                        inquiries.</p>
                </div>
            </div>
            <div
                class="flex flex-1 gap-4 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark p-6 flex-col hover:border-primary/50 dark:hover:border-primary/50 transition-colors">
                <span class="material-symbols-outlined text-primary text-3xl">dashboard</span>
                <div class="flex flex-col gap-1">
                    <h3 class="text-primary dark:text-text-dark text-lg font-bold leading-tight">
                        Intuitive Dashboard</h3>
                    <p class="text-subtle-light dark:text-subtle-dark text-sm font-normal leading-normal">
                        Manage all your projects and settings from a single, easy-to-use
                        dashboard.</p>
                </div>
            </div>
        </div>
    </section>

    <div id="about"></div>

    <!-- Timeline Section -->
    <section class="">
        <div class="max-w-3xl mx-auto">
            <h2
                class="text-text-light dark:text-white tracking-tight text-3xl font-bold leading-tight sm:text-4xl text-center">
                Our Story
            </h2>

            <div class="mt-12 grid grid-cols-[auto_1fr] gap-x-4 md:gap-x-8">

                <!-- IDEA -->
                <div class="flex flex-col items-center gap-1.5 pt-3">
                    <div
                        class="flex items-center justify-center size-10 rounded-full bg-secondary/10 dark:bg-secondary/20 text-secondary">
                        <span class="material-symbols-outlined">lightbulb</span>
                    </div>
                    <div class="w-px bg-gray-300 dark:bg-gray-700 h-2 grow"></div>
                </div>
                <div class="flex flex-1 flex-col pb-12 pt-3">
                    <p class="text-subtle-light dark:text-subtle-dark text-sm font-normal leading-normal">Septemmber
                        2025</p>
                    <p class="text-primary dark:text-text-dark text-lg font-medium leading-normal">The Journey
                        Began</p>
                    <p class="text-subtle-light dark:text-subtle-dark text-base font-normal leading-normal mt-1">
                        What started as a simple idea, helping people prove their work and land more gigs — quickly
                        became a mission to build the easiest way to create a professional portfolio.
                    </p>
                </div>

                <!-- BUILD PHASE -->
                <div class="flex flex-col items-center gap-1.5">
                    <div class="w-px bg-gray-300 dark:bg-gray-700 h-2"></div>
                    <div
                        class="flex items-center justify-center size-10 rounded-full bg-secondary/10 dark:bg-secondary/20 text-secondary">
                        <span class="material-symbols-outlined">construction</span>
                    </div>
                    <div class="w-px bg-gray-300 dark:bg-gray-700 h-2 grow"></div>
                </div>
                <div class="flex flex-1 flex-col pb-12 pt-3">
                    <p class="text-subtle-light dark:text-subtle-dark text-sm font-normal leading-normal">October
                        2025</p>
                    <p class="text-primary dark:text-text-dark text-lg font-medium leading-normal">Building the
                        Foundation</p>
                    <p class="text-subtle-light dark:text-subtle-dark text-base font-normal leading-normal mt-1">
                        We began designing the core features, customizable profiles, proof-of-work displays, and
                        tools to help creators stand out in seconds.
                    </p>
                </div>

                <!-- FUTURE -->
                <div class="flex flex-col items-center gap-1.5">
                    <div class="w-px bg-gray-300 dark:bg-gray-700 h-2"></div>
                    <div
                        class="flex items-center justify-center size-10 rounded-full bg-secondary/10 dark:bg-secondary/20 text-secondary">
                        <span class="material-symbols-outlined">rocket_launch</span>
                    </div>
                </div>
                <div class="flex flex-1 flex-col pt-3">
                    <p class="text-subtle-light dark:text-subtle-dark text-sm font-normal leading-normal">Coming
                        November
                        2025</p>
                    <p class="text-primary dark:text-text-dark text-lg font-medium leading-normal">Launch &
                        Growth</p>
                    <p class="text-subtle-light dark:text-subtle-dark text-base font-normal leading-normal mt-1">
                        We're gearing up for our first public launch — empowering professionals to seal their next
                        gig with a portfolio that proves their worth.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="flex flex-col gap-10 items-center">
        <h2 class="text-text-light dark:text-text-dark text-3xl font-bold leading-tight tracking-tight text-center">
            Get Started in 3 Simple Steps</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full">
            <div class="flex flex-col items-center text-center gap-4">
                <div
                    class="flex items-center justify-center size-16 rounded-full bg-primary/20 text-primary text-2xl font-bold">
                    1</div>
                <h3 class="text-primary dark:text-text-dark text-xl font-bold">Choose a
                    Template</h3>
                <p class="text-subtle-light dark:text-subtle-dark">Pick a professionally
                    designed template that fits your style and industry.</p>
            </div>
            <div class="flex flex-col items-center text-center gap-4">
                <div
                    class="flex items-center justify-center size-16 rounded-full bg-primary/20 text-primary text-2xl font-bold">
                    2</div>
                <h3 class="text-primary dark:text-text-dark text-xl font-bold">Customize
                    Your Content</h3>
                <p class="text-subtle-light dark:text-subtle-dark">Add your projects, bio, and
                    contact information with our easy-to-use editor.</p>
            </div>
            <div class="flex flex-col items-center text-center gap-4">
                <div
                    class="flex items-center justify-center size-16 rounded-full bg-primary/20 text-primary text-2xl font-bold">
                    3</div>
                <h3 class="text-primary dark:text-text-dark text-xl font-bold">Publish &amp;
                    Share</h3>
                <p class="text-subtle-light dark:text-subtle-dark">Go live with one click and
                    share your stunning new portfolio with the world.</p>
            </div>
        </div>
    </section>

    <div id="contact"></div>
    <section class="container mx-auto px-4" id="contact">
        <div class="flex flex-col max-w-5xl mx-auto">
            <!-- Page Heading -->
            <div class="flex flex-col gap-3 text-center mb-12">
                <h1
                    class="text-text-light text-4xl sm:text-5xl font-black leading-tight tracking-[-0.033em] text-[#111827] dark:text-white">
                    Get in Touch</h1>
                <p
                    class="text-base sm:text-lg font-normal leading-normal text-[#6B7280] dark:text-gray-400 max-w-2xl mx-auto">
                    We'd love to hear from you. Whether you have a question, feedback, or need support, our team is
                    ready to
                    help.
                </p>
            </div>
            <!-- Main Content Area -->
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 lg:gap-16">
                <!-- Contact Form -->

                <!-- Contact Info & CTA -->
                <div class="lg:col-span-2 flex flex-col gap-8">

                    <div class="flex flex-col gap-6">
                        <div class="flex items-start gap-4">
                            <div
                                class="flex-shrink-0 size-10 flex items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary/80">
                                <span class="material-symbols-outlined text-xl">mail</span>
                            </div>
                            <div>
                                <h4 class="text-base font-semibold text-[#111827] dark:text-white">Email Us</h4>
                                <p class="text-sm text-[#6B7280] dark:text-gray-400">Our support team will get back to
                                    you
                                    within 24 hours.</p>
                                <a class="text-sm font-medium text-primary hover:underline mt-1 inline-block"
                                    href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section -->
    {{-- <section class="flex flex-col gap-10 items-center">
            <h2 class="text-primary dark:text-text-dark text-3xl font-bold leading-tight tracking-tight text-center">
                Loved by Professionals Worldwide</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
                <div
                    class="flex flex-col gap-4 p-6 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark">
                    <p class="text-primary dark:text-text-dark">"POW made it incredibly simple
                        to create a portfolio that truly represents my work. The analytics are a
                        game-changer!"</p>
                    <div class="flex items-center gap-3 mt-2">
                        <img alt="Profile picture of Sarah L." class="w-10 h-10 rounded-full object-cover"
                            data-alt="Headshot of a smiling woman with blonde hair."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuD92e9q4x1pA_lfO__tNm7Jtbar9qKeUaxLUqrj0RoY5sMh0DOwse3zo8RYuNjWjAKIrl_xDie3-e0Oqnof-n6IZRLeHdYeXXgLj4gWR4oWJ2JH4HNAMPLr4bYFA7WAAQdHmdwHXenI2MP445lhkpj33c0pa8BCTU25uAkvSoYl3a8opvKb4H6RhZo6GCvMQu8xpdHh4sbe5zbyWmcHa9R6g0KHxiEySDKm7o6YLbjmpcsKKj5ooSlw9rRQnK4XUW5c7Pg9zmPgfm4" />
                        <div>
                            <p class="font-bold text-primary dark:text-text-dark">Sarah L.</p>
                            <p class="text-sm text-subtle-light dark:text-subtle-dark">Freelance
                                Designer</p>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col gap-4 p-6 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark">
                    <p class="text-primary dark:text-text-dark">"I had my new portfolio up and
                        running in under an hour. The templates are beautiful and so easy to
                        customize."</p>
                    <div class="flex items-center gap-3 mt-2">
                        <img alt="Profile picture of Mike P." class="w-10 h-10 rounded-full object-cover"
                            data-alt="Headshot of a man with short brown hair and glasses."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDMWHH2jOzhpIQ2g_FzSTlJxdrJi-XwTK40ZZwp_gWOnhrzVFfaMpjjUphbzGjluJ86eEtYsakM53XFo7q6EIkbcAh9mzmzmFuEqL_A4P-V-pd_WdqD3tsmK1N7miJ93zT9OP2jWN43rweyExFzKPAGGD0jldS0lm5P4119Xg5LejwF66CvporMt3voHioSe6P4F1kX7w0ml055d_-ZtCe0pNUD39HcrZrVEnl6Y9IE3g5RI-HGGy_4GtCceGDdfD0VrBFiNorGHfo" />
                        <div>
                            <p class="font-bold text-primary dark:text-text-dark">Mike P.</p>
                            <p class="text-sm text-subtle-light dark:text-subtle-dark">Photographer
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col gap-4 p-6 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark">
                    <p class="text-primary dark:text-text-dark">"The custom domain feature was
                        seamless. My portfolio finally looks as professional as my agency."</p>
                    <div class="flex items-center gap-3 mt-2">
                        <img alt="Profile picture of Jane D." class="w-10 h-10 rounded-full object-cover"
                            data-alt="Headshot of a woman with dark curly hair."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAmWV51khryXoWk3MO132187vCrs4mr9O3pAc1in_UmItny286EXxwoOTYwxn9qAp4OnWFFRHWeSDRr4TgK2UfSoWJu5Qo6rxBKGpwXWl8VwwoMUKCkIozdgh6ly_I2afscNZvYUHXAu9xKsUEfVGqcCST-yRcHlCy-fY1Y116q6zUj6B8W6pSRroEg4FTofZn0WIQA4hr0GMIr6ygrJ0FBL4fvGlqqbImNUkxHb0NoktrOICisz19jO6e5vobCMyILAMKAcs9hoqI" />
                        <div>
                            <p class="font-bold text-primary dark:text-text-dark">Jane D.</p>
                            <p class="text-sm text-subtle-light dark:text-subtle-dark">Agency Owner
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    <!-- Pricing Banner -->

    <section
        class="p-8 md:p-12 rounded-xl bg-primary/10 dark:bg-primary/20 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
        <div class="flex flex-col gap-2">
            <h3 class="text-2xl font-bold text-primary dark:text-text-dark">
                70% of professionals lose gigs without a portfolio.
            </h3>
            <p class="text-subtle-light dark:text-subtle-dark">
                We built this to change that — create your Proof of Work in minutes and start
                landing opportunities with a portfolio that speaks for you.
            </p>
        </div>
        <a class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:opacity-90"
            href="route('register')">
            <span class="truncate">Register</span>
        </a>
    </section>

</x-layouts.guest>
