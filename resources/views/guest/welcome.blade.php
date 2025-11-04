<x-layouts.guest>

    <!-- HeroSection -->
    <section class="flex flex-col gap-8 text-center items-center">
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
                <span class="truncate">Start Proving Your Work</span>
            </a>

        </div>
        <div class="w-full mt-8 aspect-[16/9] bg-card-light dark:bg-card-dark rounded-xl border border-border-light dark:border-border-dark shadow-lg"
            data-alt="A mockup image showing the POW portfolio builder on a desktop screen and a mobile device.">
            <img alt="POW platform mockup" class="w-full h-full object-cover rounded-xl"
                src="{{ asset('images/hero/image3.png') }}" />
        </div>
    </section>
    <!-- FeatureSection -->
    <section class="flex flex-col gap-10 @container">
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
                    <h3 class="text-text-light dark:text-text-dark text-lg font-bold leading-tight">
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
                    <h3 class="text-text-light dark:text-text-dark text-lg font-bold leading-tight">
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
                    <h3 class="text-text-light dark:text-text-dark text-lg font-bold leading-tight">
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
                    <h3 class="text-text-light dark:text-text-dark text-lg font-bold leading-tight">
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
                    <h3 class="text-text-light dark:text-text-dark text-lg font-bold leading-tight">
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
                    <h3 class="text-text-light dark:text-text-dark text-lg font-bold leading-tight">
                        Intuitive Dashboard</h3>
                    <p class="text-subtle-light dark:text-subtle-dark text-sm font-normal leading-normal">
                        Manage all your projects and settings from a single, easy-to-use
                        dashboard.</p>
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
                <h3 class="text-text-light dark:text-text-dark text-xl font-bold">Choose a
                    Template</h3>
                <p class="text-subtle-light dark:text-subtle-dark">Pick a professionally
                    designed template that fits your style and industry.</p>
            </div>
            <div class="flex flex-col items-center text-center gap-4">
                <div
                    class="flex items-center justify-center size-16 rounded-full bg-primary/20 text-primary text-2xl font-bold">
                    2</div>
                <h3 class="text-text-light dark:text-text-dark text-xl font-bold">Customize
                    Your Content</h3>
                <p class="text-subtle-light dark:text-subtle-dark">Add your projects, bio, and
                    contact information with our easy-to-use editor.</p>
            </div>
            <div class="flex flex-col items-center text-center gap-4">
                <div
                    class="flex items-center justify-center size-16 rounded-full bg-primary/20 text-primary text-2xl font-bold">
                    3</div>
                <h3 class="text-text-light dark:text-text-dark text-xl font-bold">Publish &amp;
                    Share</h3>
                <p class="text-subtle-light dark:text-subtle-dark">Go live with one click and
                    share your stunning new portfolio with the world.</p>
            </div>
        </div>
    </section>
    <!-- Testimonial Section -->
    {{-- <section class="flex flex-col gap-10 items-center">
            <h2 class="text-text-light dark:text-text-dark text-3xl font-bold leading-tight tracking-tight text-center">
                Loved by Professionals Worldwide</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
                <div
                    class="flex flex-col gap-4 p-6 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark">
                    <p class="text-text-light dark:text-text-dark">"POW made it incredibly simple
                        to create a portfolio that truly represents my work. The analytics are a
                        game-changer!"</p>
                    <div class="flex items-center gap-3 mt-2">
                        <img alt="Profile picture of Sarah L." class="w-10 h-10 rounded-full object-cover"
                            data-alt="Headshot of a smiling woman with blonde hair."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuD92e9q4x1pA_lfO__tNm7Jtbar9qKeUaxLUqrj0RoY5sMh0DOwse3zo8RYuNjWjAKIrl_xDie3-e0Oqnof-n6IZRLeHdYeXXgLj4gWR4oWJ2JH4HNAMPLr4bYFA7WAAQdHmdwHXenI2MP445lhkpj33c0pa8BCTU25uAkvSoYl3a8opvKb4H6RhZo6GCvMQu8xpdHh4sbe5zbyWmcHa9R6g0KHxiEySDKm7o6YLbjmpcsKKj5ooSlw9rRQnK4XUW5c7Pg9zmPgfm4" />
                        <div>
                            <p class="font-bold text-text-light dark:text-text-dark">Sarah L.</p>
                            <p class="text-sm text-subtle-light dark:text-subtle-dark">Freelance
                                Designer</p>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col gap-4 p-6 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark">
                    <p class="text-text-light dark:text-text-dark">"I had my new portfolio up and
                        running in under an hour. The templates are beautiful and so easy to
                        customize."</p>
                    <div class="flex items-center gap-3 mt-2">
                        <img alt="Profile picture of Mike P." class="w-10 h-10 rounded-full object-cover"
                            data-alt="Headshot of a man with short brown hair and glasses."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDMWHH2jOzhpIQ2g_FzSTlJxdrJi-XwTK40ZZwp_gWOnhrzVFfaMpjjUphbzGjluJ86eEtYsakM53XFo7q6EIkbcAh9mzmzmFuEqL_A4P-V-pd_WdqD3tsmK1N7miJ93zT9OP2jWN43rweyExFzKPAGGD0jldS0lm5P4119Xg5LejwF66CvporMt3voHioSe6P4F1kX7w0ml055d_-ZtCe0pNUD39HcrZrVEnl6Y9IE3g5RI-HGGy_4GtCceGDdfD0VrBFiNorGHfo" />
                        <div>
                            <p class="font-bold text-text-light dark:text-text-dark">Mike P.</p>
                            <p class="text-sm text-subtle-light dark:text-subtle-dark">Photographer
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col gap-4 p-6 rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark">
                    <p class="text-text-light dark:text-text-dark">"The custom domain feature was
                        seamless. My portfolio finally looks as professional as my agency."</p>
                    <div class="flex items-center gap-3 mt-2">
                        <img alt="Profile picture of Jane D." class="w-10 h-10 rounded-full object-cover"
                            data-alt="Headshot of a woman with dark curly hair."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAmWV51khryXoWk3MO132187vCrs4mr9O3pAc1in_UmItny286EXxwoOTYwxn9qAp4OnWFFRHWeSDRr4TgK2UfSoWJu5Qo6rxBKGpwXWl8VwwoMUKCkIozdgh6ly_I2afscNZvYUHXAu9xKsUEfVGqcCST-yRcHlCy-fY1Y116q6zUj6B8W6pSRroEg4FTofZn0WIQA4hr0GMIr6ygrJ0FBL4fvGlqqbImNUkxHb0NoktrOICisz19jO6e5vobCMyILAMKAcs9hoqI" />
                        <div>
                            <p class="font-bold text-text-light dark:text-text-dark">Jane D.</p>
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
            <h3 class="text-2xl font-bold text-text-light dark:text-text-dark">
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
