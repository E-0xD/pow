 <aside class="w-64 bg-white dark:bg-[#110A19] border-r border-[#E5E7EB] dark:border-white/10 flex flex-col shrink-0">
     <div class="flex h-full min-h-[700px] flex-col justify-between p-4">
         <div class="flex flex-col gap-4">
             <div class="flex items-center gap-3 p-2">
                 <span class="text-2xl font-black text-primary">POW</span>
             </div>
             <div class="flex flex-col gap-2">
                 <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 dark:bg-primary/20 text-primary dark:text-white"
                     href="{{ route('user.dashboard') }}">
                     <span class="material-symbols-outlined text-2xl">dashboard</span>
                     <p class="text-sm font-bold leading-normal">Dashboard</p>
                 </a>
                 <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300"
                     href="{{ route('user.portfolio.index') }}">
                     <span class="material-symbols-outlined !font-bold">image</span>
                     <p class="text-sm font-medium leading-normal">My Portfolios</p>
                 </a>
                 <nav class="flex flex-col gap-2">
                    <a class="flex items-center gap-3 px-3 py-2" href="#">
                         <span class="material-symbols-outlined text-primary">check_circle</span>
                         <p class="text-slate-700 dark:text-slate-300 text-sm font-medium leading-normal">Choose Template</p>
                     </a>
                     <a class="flex items-center gap-3 px-3 py-2" href="#">
                         <span class="material-symbols-outlined text-primary">check_circle</span>
                         <p class="text-slate-700 dark:text-slate-300 text-sm font-medium leading-normal">Basic Info</p>
                     </a>
                     <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 dark:bg-primary/20"
                         href="#">
                         <span class="material-symbols-outlined text-primary fill">radio_button_checked</span>
                         <p class="text-primary text-sm font-bold leading-normal">Arrange Sections</p>
                     </a>
                     <a class="flex items-center gap-3 px-3 py-2" href="#">
                         <span
                             class="material-symbols-outlined text-slate-500 dark:text-slate-400">radio_button_unchecked</span>
                         <p class="text-slate-500 dark:text-slate-400 text-sm font-medium leading-normal">Add Content
                         </p>
                     </a>
                 </nav>
                 <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300"
                     href="#">
                     <span class="material-symbols-outlined text-2xl">pie_chart</span>
                     <p class="text-sm font-medium leading-normal">Analytics</p>
                 </a>
             </div>
         </div>
         <div class="flex flex-col gap-4">
             <div class="flex flex-col gap-1">
                 <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300"
                     href="#">
                     <span class="material-symbols-outlined text-2xl">settings</span>
                     <p class="text-sm font-medium leading-normal">Settings</p>
                 </a>
                 <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10 text-[#1F2937] dark:text-gray-300"
                     href="#">
                     <span class="material-symbols-outlined text-2xl">logout</span>
                     <p class="text-sm font-medium leading-normal">Log out</p>
                 </a>
             </div>
             <div class="flex gap-3 items-center border-t border-[#E5E7EB] dark:border-white/10 pt-4">
                 <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                     data-alt="Avatar of Alex Doe, a gradient of purple and blue"
                     style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDkge7VGK0din6bNORuAhVItey7gevkBW5y_rWqZW17anAWwif879XeJTgK8sXwe7gTlJpjg1ov07eO15kEiawLXH0CKmzOMfpsUVVKBlEaHVN7OMdd5QxfaNWhHDgHBIwvD6Y4lISD2htt1ILKWUPrZ0JYDGOSumpALzCSNGgWRMznFkJovtCQmjxPO_UzpKyv0YK-LbCvg3pR7pMo3W1OFauGAoPhIAuGgaKtU08RvYfVCcWOueMkwTCMXu_exu7PzK_bgDNZDzU");'>
                 </div>
                 <div class="flex flex-col">
                     <h1 class="text-[#1F2937] dark:text-white text-base font-medium leading-normal">Alex
                         Doe</h1>
                     <p class="text-[#6B7280] dark:text-gray-400 text-sm font-normal leading-normal">
                         alex.doe@pow.com</p>
                 </div>
             </div>
         </div>
     </div>
 </aside>
