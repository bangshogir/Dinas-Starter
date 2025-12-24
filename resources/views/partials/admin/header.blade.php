<header x-data="{menuToggle: false}"
  class="sticky top-0 z-99999 flex w-full border-gray-200 bg-white lg:border-b dark:border-gray-800 dark:bg-gray-900">
  <div class="flex grow flex-col items-center justify-between lg:flex-row lg:px-6">
    <div
      class="flex w-full items-center justify-between gap-2 border-b border-gray-200 px-3 py-3 sm:gap-4 lg:justify-normal lg:border-b-0 lg:px-0 lg:py-4 dark:border-gray-800">
      <!-- Hamburger Toggle BTN -->
      <!-- Hamburger Toggle BTN -->
      <button :class="sidebarToggle ? 'lg:bg-transparent dark:lg:bg-transparent bg-gray-100 dark:bg-gray-800' : ''"
        class="z-99999 flex h-10 w-10 items-center justify-center rounded-lg border-gray-200 text-gray-500 lg:h-11 lg:w-11 lg:border dark:border-gray-800 dark:text-gray-400"
        @click.stop="sidebarToggle = !sidebarToggle">
        <span class="hidden lg:block">
          <i class="fa-solid fa-bars text-current text-xl"></i>
        </span>

        <span :class="sidebarToggle ? 'hidden' : 'block lg:hidden'">
          <i class="fa-solid fa-bars text-current text-xl"></i>
        </span>

        <span :class="sidebarToggle ? 'block lg:hidden' : 'hidden'">
          <i class="fa-solid fa-xmark text-current text-xl"></i>
        </span>
      </button>
      <!-- Hamburger Toggle BTN -->

      <a href="index.html" class="lg:hidden">
        <img class="dark:hidden" src="./images/logo/logo.svg" alt="Logo" />
        <img class="hidden dark:block" src="./images/logo/logo-dark.svg" alt="Logo" />
      </a>

      <!-- Application nav menu button -->
      <button
        class="z-99999 flex h-10 w-10 items-center justify-center rounded-lg text-gray-700 hover:bg-gray-100 lg:hidden dark:text-gray-400 dark:hover:bg-gray-800"
        :class="menuToggle ? 'bg-gray-100 dark:bg-gray-800' : ''" @click.stop="menuToggle = !menuToggle">
        <i class="fa-solid fa-grip text-current text-xl"></i>
      </button>
      <!-- Application nav menu button -->

      <div class="hidden lg:block">
        <form>
          <div class="relative">
            <span class="absolute top-1/2 left-4 -translate-y-1/2">
              <i class="fa-solid fa-magnifying-glass text-gray-500 dark:text-gray-400 text-lg"></i>
            </span>
            <input type="text" placeholder="Search or type command..." id="search-input"
              class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-12 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[430px] dark:border-gray-800 dark:bg-gray-900 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30" />

            <button id="search-button"
              class="absolute top-1/2 right-2.5 inline-flex -translate-y-1/2 items-center gap-0.5 rounded-lg border border-gray-200 bg-gray-50 px-[7px] py-[4.5px] text-xs -tracking-[0.2px] text-gray-500 dark:border-gray-800 dark:bg-white/[0.03] dark:text-gray-400">
              <span> ⌘ </span>
              <span> K </span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <div :class="menuToggle ? 'flex' : 'hidden'"
      class="shadow-theme-md w-full items-center justify-between gap-4 px-5 py-4 lg:flex lg:justify-end lg:px-0 lg:shadow-none">
      <div class="2xsm:gap-3 flex items-center gap-2">
        <!-- Dark Mode Toggler -->
        <button
          class="hover:text-dark-900 relative flex h-11 w-11 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"
          @click.prevent="darkMode = !darkMode">
          <span class="hidden dark:block">
            <i class="fa-regular fa-sun text-lg"></i>
          </span>
          <span class="dark:hidden">
            <i class="fa-regular fa-moon text-lg"></i>
          </span>
        </button>
        <!-- Dark Mode Toggler -->

        <!-- Notification Menu Area -->
        <div class="relative" x-data="{ dropdownOpen: false, notifying: true }" @click.outside="dropdownOpen = false">
          <button
            class="hover:text-dark-900 relative flex h-11 w-11 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"
            @click.prevent="dropdownOpen = ! dropdownOpen; notifying = false">
            <span :class="!notifying ? 'hidden' : 'flex'"
              class="absolute top-0.5 right-0 z-1 h-2 w-2 rounded-full bg-orange-400">
              <span
                class="absolute -z-1 inline-flex h-full w-full animate-ping rounded-full bg-orange-400 opacity-75"></span>
            </span>
            <i class="fa-regular fa-bell text-xl"></i>
          </button>

          <!-- Dropdown Start -->
          <div x-show="dropdownOpen"
            class="shadow-theme-lg dark:bg-gray-dark absolute -right-[240px] mt-[17px] flex h-[480px] w-[350px] flex-col rounded-2xl border border-gray-200 bg-white p-3 sm:w-[361px] lg:right-0 dark:border-gray-800">
            <div class="mb-3 flex items-center justify-between border-b border-gray-100 pb-3 dark:border-gray-800">
              <h5 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                Notification
              </h5>

              <button @click="dropdownOpen = false" class="text-gray-500 dark:text-gray-400">
                <i class="fa-solid fa-xmark text-xl"></i>
              </button>
            </div>

            <ul class="custom-scrollbar flex h-auto flex-col overflow-y-auto">
              <li>
                <a class="flex gap-3 rounded-lg border-b border-gray-100 p-3 px-4.5 py-3 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-white/5"
                  href="#">
                  <span class="relative z-1 block h-10 w-full max-w-10 rounded-full">
                    <img src="./images/user/user-02.jpg" alt="User" class="overflow-hidden rounded-full" />
                    <span
                      class="bg-success-500 absolute right-0 bottom-0 z-10 h-2.5 w-full max-w-2.5 rounded-full border-[1.5px] border-white dark:border-gray-900"></span>
                  </span>

                  <span class="block">
                    <span class="text-theme-sm mb-1.5 block text-gray-500 dark:text-gray-400">
                      <span class="font-medium text-gray-800 dark:text-white/90">Terry Franci</span>
                      requests permission to change
                      <span class="font-medium text-gray-800 dark:text-white/90">Project - Nganter App</span>
                    </span>

                    <span class="text-theme-xs flex items-center gap-2 text-gray-500 dark:text-gray-400">
                      <span>Project</span>
                      <span class="h-1 w-1 rounded-full bg-gray-400"></span>
                      <span>5 min ago</span>
                    </span>
                  </span>
                </a>
              </li>

              <li>
                <a class="flex gap-3 rounded-lg border-b border-gray-100 p-3 px-4.5 py-3 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-white/5"
                  href="#">
                  <span class="relative z-1 block h-10 w-full max-w-10 rounded-full">
                    <img src="./images/user/user-03.jpg" alt="User" class="overflow-hidden rounded-full" />
                    <span
                      class="bg-success-500 absolute right-0 bottom-0 z-10 h-2.5 w-full max-w-2.5 rounded-full border-[1.5px] border-white dark:border-gray-900"></span>
                  </span>

                  <span class="block">
                    <span class="text-theme-sm mb-1.5 block text-gray-500 dark:text-gray-400">
                      <span class="font-medium text-gray-800 dark:text-white/90">Alena Franci</span>
                      requests permission to change
                      <span class="font-medium text-gray-800 dark:text-white/90">Project - Nganter App</span>
                    </span>

                    <span class="text-theme-xs flex items-center gap-2 text-gray-500 dark:text-gray-400">
                      <span>Project</span>
                      <span class="h-1 w-1 rounded-full bg-gray-400"></span>
                      <span>8 min ago</span>
                    </span>
                  </span>
                </a>
              </li>

              <li>
                <a class="flex gap-3 rounded-lg border-b border-gray-100 p-3 px-4.5 py-3 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-white/5"
                  href="#">
                  <span class="relative z-1 block h-10 w-full max-w-10 rounded-full">
                    <img src="./images/user/user-04.jpg" alt="User" class="overflow-hidden rounded-full" />
                    <span
                      class="bg-success-500 absolute right-0 bottom-0 z-10 h-2.5 w-full max-w-2.5 rounded-full border-[1.5px] border-white dark:border-gray-900"></span>
                  </span>

                  <span class="block">
                    <span class="text-theme-sm mb-1.5 block text-gray-500 dark:text-gray-400">
                      <span class="font-medium text-gray-800 dark:text-white/90">Jocelyn Kenter</span>
                      requests permission to change
                      <span class="font-medium text-gray-800 dark:text-white/90">Project - Nganter App</span>
                    </span>

                    <span class="text-theme-xs flex items-center gap-2 text-gray-500 dark:text-gray-400">
                      <span>Project</span>
                      <span class="h-1 w-1 rounded-full bg-gray-400"></span>
                      <span>15 min ago</span>
                    </span>
                  </span>
                </a>
              </li>

              <li>
                <a class="flex gap-3 rounded-lg border-b border-gray-100 p-3 px-4.5 py-3 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-white/5"
                  href="#">
                  <span class="relative z-1 block h-10 w-full max-w-10 rounded-full">
                    <img src="./images/user/user-05.jpg" alt="User" class="overflow-hidden rounded-full" />
                    <span
                      class="bg-error-500 absolute right-0 bottom-0 z-10 h-2.5 w-full max-w-2.5 rounded-full border-[1.5px] border-white dark:border-gray-900"></span>
                  </span>

                  <span class="block">
                    <span class="text-theme-sm mb-1.5 block text-gray-500 dark:text-gray-400">
                      <span class="font-medium text-gray-800 dark:text-white/90">Brandon Philips</span>
                      requests permission to change
                      <span class="font-medium text-gray-800 dark:text-white/90">Project - Nganter App</span>
                    </span>

                    <span class="text-theme-xs flex items-center gap-2 text-gray-500 dark:text-gray-400">
                      <span>Project</span>
                      <span class="h-1 w-1 rounded-full bg-gray-400"></span>
                      <span>1 hr ago</span>
                    </span>
                  </span>
                </a>
              </li>

              <li>
                <a class="flex gap-3 rounded-lg border-b border-gray-100 p-3 px-4.5 py-3 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-white/5"
                  href="#">
                  <span class="relative z-1 block h-10 w-full max-w-10 rounded-full">
                    <img src="./images/user/user-02.jpg" alt="User" class="overflow-hidden rounded-full" />
                    <span
                      class="bg-success-500 absolute right-0 bottom-0 z-10 h-2.5 w-full max-w-2.5 rounded-full border-[1.5px] border-white dark:border-gray-900"></span>
                  </span>

                  <span class="block">
                    <span class="text-theme-sm mb-1.5 block text-gray-500 dark:text-gray-400">
                      <span class="font-medium text-gray-800 dark:text-white/90">Terry Franci</span>
                      requests permission to change
                      <span class="font-medium text-gray-800 dark:text-white/90">Project - Nganter App</span>
                    </span>

                    <span class="text-theme-xs flex items-center gap-2 text-gray-500 dark:text-gray-400">
                      <span>Project</span>
                      <span class="h-1 w-1 rounded-full bg-gray-400"></span>
                      <span>5 min ago</span>
                    </span>
                  </span>
                </a>
              </li>

              <li>
                <a class="flex gap-3 rounded-lg border-b border-gray-100 p-3 px-4.5 py-3 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-white/5"
                  href="#">
                  <span class="relative z-1 block h-10 w-full max-w-10 rounded-full">
                    <img src="./images/user/user-03.jpg" alt="User" class="overflow-hidden rounded-full" />
                    <span
                      class="bg-success-500 absolute right-0 bottom-0 z-10 h-2.5 w-full max-w-2.5 rounded-full border-[1.5px] border-white dark:border-gray-900"></span>
                  </span>

                  <span class="block">
                    <span class="text-theme-sm mb-1.5 block text-gray-500 dark:text-gray-400">
                      <span class="font-medium text-gray-800 dark:text-white/90">Alena Franci</span>
                      requests permission to change
                      <span class="font-medium text-gray-800 dark:text-white/90">Project - Nganter App</span>
                    </span>

                    <span class="text-theme-xs flex items-center gap-2 text-gray-500 dark:text-gray-400">
                      <span>Project</span>
                      <span class="h-1 w-1 rounded-full bg-gray-400"></span>
                      <span>8 min ago</span>
                    </span>
                  </span>
                </a>
              </li>

              <li>
                <a class="flex gap-3 rounded-lg border-b border-gray-100 p-3 px-4.5 py-3 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-white/5"
                  href="#">
                  <span class="relative z-1 block h-10 w-full max-w-10 rounded-full">
                    <img src="./images/user/user-04.jpg" alt="User" class="overflow-hidden rounded-full" />
                    <span
                      class="bg-success-500 absolute right-0 bottom-0 z-10 h-2.5 w-full max-w-2.5 rounded-full border-[1.5px] border-white dark:border-gray-900"></span>
                  </span>

                  <span class="block">
                    <span class="text-theme-sm mb-1.5 block text-gray-500 dark:text-gray-400">
                      <span class="font-medium text-gray-800 dark:text-white/90">Jocelyn Kenter</span>
                      requests permission to change
                      <span class="font-medium text-gray-800 dark:text-white/90">Project - Nganter App</span>
                    </span>

                    <span class="text-theme-xs flex items-center gap-2 text-gray-500 dark:text-gray-400">
                      <span>Project</span>
                      <span class="h-1 w-1 rounded-full bg-gray-400"></span>
                      <span>15 min ago</span>
                    </span>
                  </span>
                </a>
              </li>

              <li>
                <a class="flex gap-3 rounded-lg border-b border-gray-100 p-3 px-4.5 py-3 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-white/5"
                  href="#">
                  <span class="relative z-1 block h-10 w-full max-w-10 rounded-full">
                    <img src="./images/user/user-05.jpg" alt="User" class="overflow-hidden rounded-full" />
                    <span
                      class="bg-error-500 absolute right-0 bottom-0 z-10 h-2.5 w-full max-w-2.5 rounded-full border-[1.5px] border-white dark:border-gray-900"></span>
                  </span>

                  <span class="block">
                    <span class="text-theme-sm mb-1.5 block text-gray-500 dark:text-gray-400">
                      <span class="font-medium text-gray-800 dark:text-white/90">Brandon Philips</span>
                      requests permission to change
                      <span class="font-medium text-gray-800 dark:text-white/90">Project - Nganter App</span>
                    </span>

                    <span class="text-theme-xs flex items-center gap-2 text-gray-500 dark:text-gray-400">
                      <span>Project</span>
                      <span class="h-1 w-1 rounded-full bg-gray-400"></span>
                      <span>1 hr ago</span>
                    </span>
                  </span>
                </a>
              </li>
            </ul>

            <a href="#"
              class="text-theme-sm shadow-theme-xs mt-3 flex justify-center rounded-lg border border-gray-300 bg-white p-3 font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
              View All Notification
            </a>
          </div>
          <!-- Dropdown End -->
        </div>
        <!-- Notification Menu Area -->
      </div>

      <!-- User Area -->
      <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
        <a class="flex items-center text-gray-700 dark:text-gray-400" href="#"
          @click.prevent="dropdownOpen = ! dropdownOpen">
          <span
            class="mr-3 h-11 w-11 overflow-hidden rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
            @if(auth()->user()->profile_photo_path)
              <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="{{ auth()->user()->name }}"
                class="w-full h-full object-cover" />
            @else
              <span
                class="text-lg font-semibold text-gray-600 dark:text-gray-300">{{ substr(auth()->user()->name, 0, 1) }}</span>
            @endif
          </span>

          <span class="text-theme-sm mr-1 block font-medium"> {{ auth()->user()->name }} </span>

          <i :class="dropdownOpen && 'rotate-180'"
            class="fa-solid fa-chevron-down stroke-gray-500 dark:stroke-gray-400 text-sm">
          </i>
        </a>

        <!-- Dropdown Start -->
        <div x-show="dropdownOpen"
          class="shadow-theme-lg dark:bg-gray-dark absolute right-0 mt-[17px] flex w-[260px] flex-col rounded-2xl border border-gray-200 bg-white p-3 dark:border-gray-800">
          <div>
            <span class="text-theme-sm block font-medium text-gray-700 dark:text-gray-400">
              {{ auth()->user()->name }}
            </span>
            <span class="text-theme-xs mt-0.5 block text-gray-500 dark:text-gray-400">
              {{ auth()->user()->email }}
            </span>
          </div>

          <ul class="flex flex-col gap-1 border-b border-gray-200 pt-4 pb-3 dark:border-gray-800">
            <li>
              <a href="{{ route('profile') }}"
                class="group text-theme-sm flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                <i
                  class="fa-regular fa-user text-xl fill-gray-500 group-hover:fill-gray-700 dark:fill-gray-400 dark:group-hover:fill-gray-300"></i>
                Edit profile
              </a>
            </li>
          </ul>
          <livewire:layout.admin-logout />
        </div>
        <!-- Dropdown End -->
      </div>
      <!-- User Area -->
    </div>
  </div>
</header>