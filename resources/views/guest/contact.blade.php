 <x-layouts.guest>

<div class="container mx-auto px-4">
    <div class="flex flex-col max-w-5xl mx-auto">
        <!-- Page Heading -->
        <div class="flex flex-col gap-3 text-center mb-12">
            <h1 class="text-4xl sm:text-5xl font-black leading-tight tracking-[-0.033em] text-[#111827] dark:text-white">
                Get in Touch</h1>
            <p
                class="text-base sm:text-lg font-normal leading-normal text-[#6B7280] dark:text-gray-400 max-w-2xl mx-auto">
                We'd love to hear from you. Whether you have a question, feedback, or need support, our team is ready to
                help.
            </p>
        </div>
        <!-- Main Content Area -->
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 lg:gap-16">
            <!-- Contact Form -->
            <div
                class="lg:col-span-3 bg-white dark:bg-gray-900/50 p-8 rounded-xl border border-gray-200 dark:border-gray-800">
                <h2 class="text-[#111827] dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] pb-6">
                    Send us a message</h2>
                <form class="flex flex-col gap-6">
                    <!-- Full Name -->
                    <label class="flex flex-col flex-1">
                        <p class="text-[#111827] dark:text-gray-200 text-sm font-medium leading-normal pb-2">Full Name
                        </p>
                        <input
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111827] dark:text-gray-200 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark h-12 placeholder:text-[#6B7280] p-[15px] text-base font-normal leading-normal transition-all"
                            placeholder="Enter your full name" type="text" value="" />
                    </label>
                    <!-- Email Address -->
                    <label class="flex flex-col flex-1">
                        <p class="text-[#111827] dark:text-gray-200 text-sm font-medium leading-normal pb-2">Email
                            Address</p>
                        <input
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111827] dark:text-gray-200 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark h-12 placeholder:text-[#6B7280] p-[15px] text-base font-normal leading-normal transition-all"
                            placeholder="you@company.com" type="email" value="" />
                    </label>
                    <!-- Message -->
                    <label class="flex flex-col flex-1">
                        <p class="text-[#111827] dark:text-gray-200 text-sm font-medium leading-normal pb-2">Message</p>
                        <textarea
                            class="form-textarea flex w-full min-w-0 flex-1 resize-y overflow-hidden rounded-lg text-[#111827] dark:text-gray-200 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark placeholder:text-[#6B7280] p-[15px] text-base font-normal leading-normal min-h-[120px] transition-all"
                            placeholder="Enter your message here..."></textarea>
                    </label>
                    <!-- Submit Button -->
                    <button
                        class="flex min-w-[84px] w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/50 dark:focus:ring-offset-background-dark">
                        <span class="truncate">Send Message</span>
                    </button>
                </form>
            </div>
            <!-- Contact Info & CTA -->
            <div class="lg:col-span-2 flex flex-col gap-8">
                <h3 class="text-[#111827] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] lg:mt-2">
                    Other ways to connect</h3>
                <div class="flex flex-col gap-6">
                    <div class="flex items-start gap-4">
                        <div
                            class="flex-shrink-0 size-10 flex items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary/80">
                            <span class="material-symbols-outlined text-xl">mail</span>
                        </div>
                        <div>
                            <h4 class="text-base font-semibold text-[#111827] dark:text-white">Email Us</h4>
                            <p class="text-sm text-[#6B7280] dark:text-gray-400">Our support team will get back to you
                                within 24 hours.</p>
                            <a class="text-sm font-medium text-primary hover:underline mt-1 inline-block"
                                href="mailto:support@pow.com">support@pow.com</a>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div
                            class="flex-shrink-0 size-10 flex items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary/80">
                            <span class="material-symbols-outlined text-xl">location_on</span>
                        </div>
                        <div>
                            <h4 class="text-base font-semibold text-[#111827] dark:text-white">Our Office</h4>
                            <p class="text-sm text-[#6B7280] dark:text-gray-400">123 Portfolio Lane, Suite
                                100<br />Creative City, CA 90210</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 border-t border-gray-200 dark:border-gray-800 pt-8">
                    <h3 class="text-[#111827] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">
                        Looking for a quick answer?</h3>
                    <p class="text-sm text-[#6B7280] dark:text-gray-400 mt-2 mb-4">Check out our frequently asked
                        questions to find answers to common inquiries instantly.</p>
                    <a class="inline-flex items-center gap-2 text-sm font-bold text-primary hover:underline"
                        href="#">
                        <span>Visit our FAQs</span>
                        <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
 </x-layouts.guest>