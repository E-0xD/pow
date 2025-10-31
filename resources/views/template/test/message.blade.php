   <section id="message">
       <div class="bg-zinc-100/50 dark:bg-zinc-900/50 rounded-xl p-8 sm:p-12">
           <div class="max-w-xl mx-auto text-center">
               <h2 class="text-3xl sm:text-4xl font-heading font-bold text-zinc-900 dark:text-white">
                   Get in Touch</h2>
               <p class="mt-4 text-base leading-relaxed">
                   Have a project in mind or just want to say hello? I’d love to hear from you. Fill
                   out the form below and I'll get back to you as soon as possible.
               </p>
           </div>
           @if (session('type') && session('message'))
               <div
                   class="mt-4 p-4 rounded-lg {{ session('type') === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                   {{ session('message') }}
               </div>
           @endif
           <form action="{{ route('portfolio.message.store', ['portfolio_slug' => $portfolio->slug]) }}" method="POST"
               class="mt-10 max-w-xl mx-auto space-y-6">
               @csrf
               <div>
                   <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 sr-only"
                       for="name">Name</label>
                   <input
                       class="block w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-background-light dark:bg-background-dark shadow-sm focus:border-primary focus:ring-primary @error('name') border-red-500 @enderror"
                       id="name" name="name" placeholder="Your Name" type="text"
                       value="{{ old('name') }}" />
                   @error('name')
                       <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                   @enderror
               </div>
               <div>
                   <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 sr-only"
                       for="email">Email</label>
                   <input
                       class="block w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-background-light dark:bg-background-dark shadow-sm focus:border-primary focus:ring-primary @error('email') border-red-500 @enderror"
                       id="email" name="email" placeholder="Your Email" type="email"
                       value="{{ old('email') }}" />
                   @error('email')
                       <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                   @enderror
               </div>
               <div>
                   <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 sr-only"
                       for="message">Message</label>
                   <textarea
                       class="block w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-background-light dark:bg-background-dark shadow-sm focus:border-primary focus:ring-primary @error('message') border-red-500 @enderror"
                       id="message" name="message" placeholder="Your Message" rows="4">{{ old('message') }}</textarea>
                   @error('message')
                       <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                   @enderror
               </div>
               <div class="text-center">
                   <button
                       class="flex w-full sm:w-auto mx-auto min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-8 bg-primary text-background-dark text-base font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity"
                       type="submit">
                       Send Message
                   </button>
               </div>
           </form>
       </div>
   </section>
