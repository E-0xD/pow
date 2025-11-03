<x-layouts.app>
    <!-- TopNavBar -->
    <header
        class="flex items-center justify-between whitespace-nowrap border-b border-gray-200 dark:border-gray-700/50 bg-white dark:bg-[#20152d] px-6 h-[65px]">
        <div class="flex items-center gap-8">
            <label class="relative hidden sm:block">
                <span
                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500">search</span>
                <input
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-gray-300 dark:border-gray-700 bg-white dark:bg-background-dark h-10 placeholder:text-gray-400 dark:placeholder:text-gray-500 pl-10 pr-4 text-sm font-normal"
                    placeholder="Search..." value="" />
            </label>
        </div>
        <div class="flex items-center gap-4">
            <button
                class="relative flex items-center justify-center rounded-full h-10 w-10 text-gray-500 dark:text-gray-400 hover:bg-background-light dark:hover:bg-background-dark">
                <span class="material-symbols-outlined">notifications</span>
                <span class="absolute top-2 right-2 flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                </span>
            </button>
            <button
                class="flex items-center justify-center rounded-full h-10 w-10 text-gray-500 dark:text-gray-400 hover:bg-background-light dark:hover:bg-background-dark">
                <span class="material-symbols-outlined">dark_mode</span>
            </button>
            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="Admin avatar"
                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCnywR8bDOTDGAhlRg9t0-JqSG6-9vO0JoNp2Nk28nBro7iotpsXxQ4kZlsXUDPRYksD9YDMXiWdB0wTK07l8ROH7RvgYxQVDflNJyMzhZEJLgD0-QdmWpbprWOuFMVwzXjO3U4P32Bu1sc2Elp8QXJmW4uhsHphFxrs945nrKtpK2gwxgja32YzOzPJpuutWY29t9uymtqetlDj8uIvL4c0gKECk2WYqWV2ZTZDaHsWUPSIoPQNHNPOqZPIjd9H_dbJndlEDyoTc0");'>
            </div>
        </div>
    </header>
    <div class="flex-1 overflow-y-auto p-6 md:p-8">
        <!-- PageHeading -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <h1 class="text-gray-900 dark:text-white text-3xl font-bold leading-tight tracking-tight">Manage Users</h1>
            <button
                class="flex items-center justify-center gap-2 min-w-[84px] cursor-pointer overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 focus:ring-2 focus:ring-primary/50">
                <span class="material-symbols-outlined text-base">add</span>
                <span class="truncate">Add New User</span>
            </button>
        </div>
        <!-- Filters -->
        <div class="bg-white dark:bg-[#20152d] rounded-xl p-4 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="col-span-1 md:col-span-2">
                    <label class="relative">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500">search</span>
                        <input
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark h-11 placeholder:text-gray-400 dark:placeholder:text-gray-500 pl-10 pr-4 text-sm font-normal"
                            placeholder="Search by name or email..." value="" />
                    </label>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <button
                        class="flex h-11 w-full items-center justify-between gap-x-2 rounded-lg bg-background-light dark:bg-background-dark px-4 border border-gray-300 dark:border-gray-700">
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Subscription Plan</p>
                        <span
                            class="material-symbols-outlined text-gray-500 dark:text-gray-400 text-base">expand_more</span>
                    </button>
                    <button
                        class="flex h-11 w-full items-center justify-between gap-x-2 rounded-lg bg-background-light dark:bg-background-dark px-4 border border-gray-300 dark:border-gray-700">
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Status</p>
                        <span
                            class="material-symbols-outlined text-gray-500 dark:text-gray-400 text-base">expand_more</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- Users Table -->
        <div class="bg-white dark:bg-[#20152d] rounded-xl overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700/20 dark:text-gray-400">
                    <tr>
                        <th class="p-4" scope="col"><input
                                class="form-checkbox rounded border-gray-300 text-primary focus:ring-primary/50"
                                type="checkbox" /></th>
                        <th class="px-6 py-3" scope="col">Name</th>
                        <th class="px-6 py-3 text-center" scope="col">Portfolios</th>
                        <th class="px-6 py-3" scope="col">Join Date</th>
                        <th class="px-6 py-3" scope="col">Status</th>
                        <th class="px-6 py-3" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table Row 1 -->
                    <tr
                        class="bg-white dark:bg-[#20152d] border-b dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-800/20">
                        <td class="w-4 p-4"><input
                                class="form-checkbox rounded border-gray-300 text-primary focus:ring-primary/50"
                                type="checkbox" /></td>
                        <th class="flex items-center px-6 py-4 text-gray-900 dark:text-white whitespace-nowrap"
                            scope="row">
                            <img class="w-10 h-10 rounded-full" data-alt="Olivia Rhye's avatar"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCn3pbb4usrI3IOHb8U-otFImqxn23upuTmFs-v5XFfOQAghMBAWINaAlIc6l3bnOdMC83lPOnUBmoFn2j0ew1k5Ra_H3CMBPbFOkYOOC12bYo-eV7KjyVh3ZkttQ7q5kthsSKCekzOa4pYV1DQaP1fz0vCU403CXpX2o-f6y6z-oAVv-z0tdoQdOiemQrb0-nCXURvst-Qikuon8OspL0J3iGHHH7oiSCcXW3XI0n_ecqWAr0nLsJPQt9gQm6a8i8FKiZR966RRqQ" />
                            <div class="pl-3">
                                <div class="text-base font-semibold">Olivia Rhye</div>
                                <div class="font-normal text-gray-500">olivia@pow.com</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">Pro</td>
                        <td class="px-6 py-4 text-center">12</td>
                        <td class="px-6 py-4">Jan 15, 2024</td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Active</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <button class="p-1 text-gray-500 rounded hover:bg-gray-100 dark:hover:bg-gray-700"><span
                                        class="material-symbols-outlined text-lg">visibility</span></button>
                                <button class="p-1 text-gray-500 rounded hover:bg-gray-100 dark:hover:bg-gray-700"><span
                                        class="material-symbols-outlined text-lg">edit</span></button>
                                <button class="p-1 text-gray-500 rounded hover:bg-gray-100 dark:hover:bg-gray-700"><span
                                        class="material-symbols-outlined text-lg">block</span></button>
                                <button class="p-1 text-red-500 rounded hover:bg-red-100 dark:hover:bg-red-900/50"><span
                                        class="material-symbols-outlined text-lg">delete</span></button>
                            </div>
                        </td>
                    </tr>
                    <!-- Table Row 2 -->
                    <tr
                        class="bg-white dark:bg-[#20152d] border-b dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-800/20">
                        <td class="w-4 p-4"><input
                                class="form-checkbox rounded border-gray-300 text-primary focus:ring-primary/50"
                                type="checkbox" /></td>
                        <th class="flex items-center px-6 py-4 text-gray-900 dark:text-white whitespace-nowrap"
                            scope="row">
                            <img class="w-10 h-10 rounded-full" data-alt="Lana Steiner's avatar"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAGRv4tk05WHEcR-e3bf5fDqIysEMElVvx1C2CvpnUieDmt8HIXcPJx8wYGvtJ5fBS9zfguP-nndxlK8jGJp-kHET8D_Ud7fyT6MQDv6m-lAqXh-Fl5B3KGCHRk3p5tMd8qlfzxPkM9RjOciKKWYF5lSyY7ul6aDb_dzRHox3y6K42jXOEiKzrTPKbxd9EvY7Hy5VRSxv3xqSnTcP50oexqtcEUkTbOyv9Z4YDpgyf54GQLdl9PWnb3FwJXiZCE5Bna6dXj_Vtj2Hg" />
                            <div class="pl-3">
                                <div class="text-base font-semibold">Lana Steiner</div>
                                <div class="font-normal text-gray-500">lana.steiner@pow.com</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">Business</td>
                        <td class="px-6 py-4 text-center">45</td>
                        <td class="px-6 py-4">Jan 12, 2024</td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Active</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <button
                                    class="p-1 text-gray-500 rounded hover:bg-gray-100 dark:hover:bg-gray-700"><span
                                        class="material-symbols-outlined text-lg">visibility</span></button>
                                <button
                                    class="p-1 text-gray-500 rounded hover:bg-gray-100 dark:hover:bg-gray-700"><span
                                        class="material-symbols-outlined text-lg">edit</span></button>
                                <button
                                    class="p-1 text-gray-500 rounded hover:bg-gray-100 dark:hover:bg-gray-700"><span
                                        class="material-symbols-outlined text-lg">block</span></button>
                                <button
                                    class="p-1 text-red-500 rounded hover:bg-red-100 dark:hover:bg-red-900/50"><span
                                        class="material-symbols-outlined text-lg">delete</span></button>
                            </div>
                        </td>
                    </tr>
                    <!-- Table Row 3 -->
                    <tr
                        class="bg-white dark:bg-[#20152d] border-b dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-800/20">
                        <td class="w-4 p-4"><input
                                class="form-checkbox rounded border-gray-300 text-primary focus:ring-primary/50"
                                type="checkbox" /></td>
                        <th class="flex items-center px-6 py-4 text-gray-900 dark:text-white whitespace-nowrap"
                            scope="row">
                            <img class="w-10 h-10 rounded-full" data-alt="Phoenix Baker's avatar"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDgGjMAyej9TYBte7yGTIjhVdnwZHrtvMs0C3tOUQNDVdFWaU78etNUoiBpGV2WIjLkZM9ayj20F8AHPTuqc5fZg-93msrevWfNS0QbhIDdf_Uq7W_8D8VMjTBYXNTwYNZ-g-kYQKGBc_-J6WzVZIztG_NppmqX_0ngkLM4MC6qlFXJbf1W5IrEIk7Q7KVw-nkyMYBVD6lKp9dNJDXEUnScxCj3BgVuTocR3K09smN65poypXEhPBEsUO1N7TPvoNOvTO8v3pM9990" />
                            <div class="pl-3">
                                <div class="text-base font-semibold">Phoenix Baker</div>
                                <div class="font-normal text-gray-500">phoenix@pow.com</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">Free</td>
                        <td class="px-6 py-4 text-center">3</td>
                        <td class="px-6 py-4">Dec 28, 2023</td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">Suspended</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <button
                                    class="p-1 text-gray-500 rounded hover:bg-gray-100 dark:hover:bg-gray-700"><span
                                        class="material-symbols-outlined text-lg">visibility</span></button>
                                <button
                                    class="p-1 text-gray-500 rounded hover:bg-gray-100 dark:hover:bg-gray-700"><span
                                        class="material-symbols-outlined text-lg">edit</span></button>
                                <button
                                    class="p-1 text-gray-500 rounded hover:bg-gray-100 dark:hover:bg-gray-700"><span
                                        class="material-symbols-outlined text-lg">block</span></button>
                                <button
                                    class="p-1 text-red-500 rounded hover:bg-red-100 dark:hover:bg-red-900/50"><span
                                        class="material-symbols-outlined text-lg">delete</span></button>
                            </div>
                        </td>
                    </tr>
                    <!-- Table Row 4 -->
                    <tr class="bg-white dark:bg-[#20152d] hover:bg-gray-50 dark:hover:bg-gray-800/20">
                        <td class="w-4 p-4"><input
                                class="form-checkbox rounded border-gray-300 text-primary focus:ring-primary/50"
                                type="checkbox" /></td>
                        <th class="flex items-center px-6 py-4 text-gray-900 dark:text-white whitespace-nowrap"
                            scope="row">
                            <img class="w-10 h-10 rounded-full" data-alt="Leo Chanel's avatar"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCAFvrFtZ-9ZBQQPWjf4QVgLmGoCDOrQUI3glbbhEIhyQzjHbhA102ec5U_2FeNLQe0yBhXMRTPmcGWvQYyw-BXA7qU_IoZSxbUYJrG4HDCQTX68prQJyhYNjeHNS9cJlBp37zcUkXNxK9CEq2qLia08w5w4Xk0Jc-mE3ew18MMa-TZ-Zy5ae3wSkKK357vVg6B_n9_ZQgSbtQJ3i-ILR8-4WlFXVu5hnVR2tqzPGfJ_MTkhckPBmfrtP_hovXZst-8Am0faDBjx9Y" />
                            <div class="pl-3">
                                <div class="text-base font-semibold">Leo Chanel</div>
                                <div class="font-normal text-gray-500">leo.chanel@pow.com</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">Pro</td>
                        <td class="px-6 py-4 text-center">21</td>
                        <td class="px-6 py-4">Dec 20, 2023</td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">Pending</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <button
                                    class="p-1 text-gray-500 rounded hover:bg-gray-100 dark:hover:bg-gray-700"><span
                                        class="material-symbols-outlined text-lg">visibility</span></button>
                                <button
                                    class="p-1 text-gray-500 rounded hover:bg-gray-100 dark:hover:bg-gray-700"><span
                                        class="material-symbols-outlined text-lg">edit</span></button>
                                <button
                                    class="p-1 text-gray-500 rounded hover:bg-gray-100 dark:hover:bg-gray-700"><span
                                        class="material-symbols-outlined text-lg">block</span></button>
                                <button
                                    class="p-1 text-red-500 rounded hover:bg-red-100 dark:hover:bg-red-900/50"><span
                                        class="material-symbols-outlined text-lg">delete</span></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <nav aria-label="Table navigation" class="flex items-center justify-between pt-4">
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing <span
                    class="font-semibold text-gray-900 dark:text-white">1-4</span> of <span
                    class="font-semibold text-gray-900 dark:text-white">100</span></span>
            <div class="inline-flex items-center -space-x-px text-sm h-8">
                <button
                    class="flex items-center justify-center px-3 h-8 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-[#20152d] dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</button>
                <button
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-[#20152d] dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</button>
                <button
                    class="flex items-center justify-center px-3 h-8 leading-tight text-primary bg-primary/20 border border-primary hover:bg-primary/30 hover:text-primary dark:border-gray-700 dark:bg-gray-700 dark:text-white">2</button>
                <button
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-[#20152d] dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">3</button>
                <button
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-[#20152d] dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</button>
            </div>
        </nav>
</x-layouts.app>
