     <div class="w-full mb-6">
         <nav
             class="flex justify-center lg:justify-start items-center gap-6 border-b border-border-light dark:border-border-dark pb-4 overflow-x-auto">
             <a href="{{ route('user.profile.edit') }}"
                 class="flex flex-col items-center justify-center gap-1 text-sm font-medium transition-all {{ request()->routeIs('settings.profile') ? 'text-primary' : 'text-subtext-light dark:text-subtext-dark hover:text-primary' }}">
                 <span class="material-symbols-outlined text-2xl">
                     person
                 </span>
                 <span>Profile</span>
             </a>

             <a href="{{ route('user.user-password.edit') }}"
                 class="flex flex-col items-center justify-center gap-1 text-sm font-medium transition-all {{ request()->routeIs('settings.security') ? 'text-primary' : 'text-subtext-light dark:text-subtext-dark hover:text-primary' }}">
                 <span class="material-symbols-outlined text-2xl">
                     lock
                 </span>
                 <span>Security</span>
             </a>

             <a href="{{ route('user.subscription.manage') }}" class="flex flex-col items-center hover:text-primary">
                 <span class="material-symbols-outlined text-2xl">subscriptions</span>
                 <span class="text-sm mt-1">Subscription</span>
             </a>

             <form method="POST" action="{{ route('logout') }}">
                 @csrf
                 <button type="submit"
                     class="flex flex-col items-center text-red-500 hover:text-red-600 transition-colors">
                     <span class="material-symbols-outlined text-2xl">logout</span>
                     <span class="text-sm mt-1">Logout</span>
                 </button>
             </form>
         </nav>
     </div>
