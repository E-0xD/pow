 <footer class="py-12 border-t border-border-light dark:border-border-dark">
     <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
         <div class="col-span-2 lg:col-span-1 flex flex-col gap-4">
             <div class="flex items-center gap-2 text-primary">
                 <div class="size-6">
                     <img src="{{ asset(config('app.logo')) }}" alt="" srcset="">
                 </div>
                 <h2 class="text-text-light dark:text-text-dark text-xl font-bold">{{ config('app.name') }}</h2>
             </div>
             <p class="text-sm text-subtle-light dark:text-subtle-dark">Your work Your Badge</p>
         </div>
         <div class="flex flex-col gap-3">
             <h4 class="font-bold text-text-light dark:text-text-dark">Product</h4>
             <a class="text-sm text-subtle-light dark:text-subtle-dark hover:text-primary dark:hover:text-primary"
                 href="#">Features</a>

             <a class="text-sm text-subtle-light dark:text-subtle-dark hover:text-primary dark:hover:text-primary"
                 href="#">Register</a>
             <a class="text-sm text-subtle-light dark:text-subtle-dark hover:text-primary dark:hover:text-primary"
                 href="#">Login</a>
         </div>
         <div class="flex flex-col gap-3">
             <h4 class="font-bold text-text-light dark:text-text-dark">Company</h4>
             <a class="text-sm text-subtle-light dark:text-subtle-dark hover:text-primary dark:hover:text-primary"
                 href="#">About Us</a>
             <a class="text-sm text-subtle-light dark:text-subtle-dark hover:text-primary dark:hover:text-primary"
                 href="#">Contact</a>
         </div>
         <div class="flex flex-col gap-3">
             <h4 class="font-bold text-text-light dark:text-text-dark">Legal</h4>
             <a class="text-sm text-subtle-light dark:text-subtle-dark hover:text-primary dark:hover:text-primary"
                 href="{{ route('guest.privacy-policy') }}">Privacy Policy</a>
             <a class="text-sm text-subtle-light dark:text-subtle-dark hover:text-primary dark:hover:text-primary"
                 href="{{ route('guest.refund-policy') }}">Refund Policy</a>
             <a class="text-sm text-subtle-light dark:text-subtle-dark hover:text-primary dark:hover:text-primary"
                 href="{{ route('guest.terms') }}">Terms of Service</a>
         </div>
         <div class="flex flex-col gap-3">
             <h4 class="font-bold text-text-light dark:text-text-dark">Social</h4>
             <div class="flex flex-col gap-4">
                 <!-- Social Icons Here -->
                 <a class="text-subtle-light dark:text-subtle-dark hover:text-primary dark:hover:text-primary"
                     href="{{ config('socials.x') }}">X</a>
                 {{-- <a class="text-subtle-light dark:text-subtle-dark hover:text-primary dark:hover:text-primary"
                     href="#">LinkedIn</a>
                 <a class="text-subtle-light dark:text-subtle-dark hover:text-primary dark:hover:text-primary"
                     href="#">Instagram</a> --}}
             </div>
         </div>
     </div>
     <div
         class="mt-8 pt-8 border-t border-border-light dark:border-border-dark text-center text-sm text-subtle-light dark:text-subtle-dark">
         © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
     </div>
 </footer>
