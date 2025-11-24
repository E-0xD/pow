<nav class="bg-background-light dark:bg-background-dark fixed w-full z-20 top-0 start-0 border-b border-border-light dark:border-border-dark backdrop-blur-sm">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

    <!-- Logo + Brand -->
    <a href="{{ route('guest.welcome') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="{{ asset(config('app.logo')) }}" class="h-10" alt="{{ config('app.name') }} Logo">
      <span class="self-center text-2xl font-bold whitespace-nowrap text-text-light dark:text-text-dark">
        {{ config('app.name') }}
      </span>
    </a>

    
    <div class="flex md:order-2 space-x-2 md:space-x-0 rtl:space-x-reverse">
      <a href="{{ route('login') }}"
        class="hidden md:flex md:me-2 items-center justify-center rounded-lg h-10 px-4 bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark border border-border-light dark:border-border-dark text-sm font-bold hover:bg-primary/10">
        Login
      </a>
      <a href="{{ route('register') }}"
        class="hidden md:flex items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:opacity-90">
        Sign Up
      </a>

    
      <button data-collapse-toggle="navbar-sticky" type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-text-light dark:text-text-dark rounded-lg md:hidden hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-border-light dark:focus:ring-border-dark"
        aria-controls="navbar-sticky" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M1 1h15M1 7h15M1 13h15" />
        </svg>
      </button>
    </div>

  
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
      <ul
        class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-border-light dark:border-border-dark rounded-lg bg-background-light dark:bg-background-dark md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent dark:md:bg-transparent">

        <li>
          <a href="#home"
            class="block py-2 px-3 text-primary font-semibold md:p-0 rounded-sm hover:text-primary md:hover:text-primary"
            aria-current="page">Home</a>
        </li>
        <li>
          <a href="#features"
            class="block py-2 px-3 text-text-light dark:text-text-dark rounded-sm hover:text-primary md:p-0">Features</a>
        </li>
        <li>
          <a href="#about"
            class="block py-2 px-3 text-text-light dark:text-text-dark rounded-sm hover:text-primary md:p-0">About</a>
        </li>
        <li>
          <a href="#contact"
            class="block py-2 px-3 text-text-light dark:text-text-dark rounded-sm hover:text-primary md:p-0">Contact</a>
        </li>

        <!-- Mobile-only Buttons -->
        <li class="flex flex-col gap-2 mt-3 md:hidden">
          <a href="{{ route('login') }}"
            class="block text-center rounded-lg py-2 border border-border-light dark:border-border-dark hover:bg-primary/10 text-text-light dark:text-text-dark">
            Login
          </a>
          <a href="{{ route('register') }}"
            class="block text-center rounded-lg py-2 bg-primary text-white hover:opacity-90">
            Sign Up
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>

