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
                            <p class="text-sm text-[#6B7280] dark:text-gray-400">Our support team will get back to you
                                within 24 hours.</p>
                            <a class="text-sm font-medium text-primary hover:underline mt-1 inline-block"
                                href="mailto:{{config('mail.from.address')}}">{{config('mail.from.address')}}</a>
                        </div>
                    </div>
                  
                </div>
             
            </div>
        </div>
    </div>
</div>
 </x-layouts.guest>