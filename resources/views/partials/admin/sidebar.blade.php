<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0">
    <!-- SIDEBAR HEADER -->
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="flex items-center gap-2 pt-8 sidebar-header pb-7">
        @php
            $profil = \App\Models\ProfilDinas::first();
        @endphp
        <a href="{{ route('admin.dashboard') }}">
            {{-- Logo dengan text (saat sidebar expanded) --}}
            <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                @if($profil && $profil->logo_dengan_text)
                    <img src="{{ asset('storage/' . $profil->logo_dengan_text) }}" alt="{{ $profil->nama_dinas ?? 'Logo' }}"
                        class="h-16 object-contain" />
                @else
                    <img class="dark:hidden" src="/images/logo/logo.svg" alt="Logo" />
                    <img class="hidden dark:block" src="/images/logo/logo-dark.svg" alt="Logo" />
                @endif
            </span>

            {{-- Logo tanpa text / icon (saat sidebar collapsed) --}}
            <img class="logo-icon h-10 object-contain" :class="sidebarToggle ? 'lg:block' : 'hidden'"
                src="{{ $profil && $profil->logo_tanpa_text ? asset('storage/' . $profil->logo_tanpa_text) : asset('images/logo/logo-icon.svg') }}"
                alt="{{ $profil->nama_dinas ?? 'Logo' }}" />
        </a>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
        <!-- Sidebar Menu -->
        <nav
            x-data="{selected: '{{ (request()->routeIs('admin.articles*') || request()->routeIs('admin.article-categories*')) ? 'Articles' : (request()->routeIs('admin.dashboard') ? 'Dashboard' : '') }}' }">
            <!-- Menu Group -->
            <div>
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                        MENU
                    </span>

                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="mx-auto fill-current menu-group-icon" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                            fill="" />
                    </svg>
                </h3>

                <ul class="flex flex-col gap-4 mb-6">
                    <!-- Menu Item Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="menu-item group {{ request()->routeIs('admin.dashboard') ? 'menu-item-active' : 'menu-item-inactive' }}">
                            <i
                                class="fa-solid fa-table-cells-large text-xl {{ request()->routeIs('admin.dashboard') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}"></i>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Dashboard
                            </span>
                        </a>
                    </li>
                    <!-- Menu Item Dashboard -->

                    <!-- Menu Item Profil Dinas -->
                    <li>
                        <a href="{{ route('admin.profil-dinas') }}"
                            class="menu-item group {{ request()->routeIs('admin.profil-dinas*') ? 'menu-item-active' : 'menu-item-inactive' }}">
                            <i
                                class="fa-solid fa-building text-xl {{ request()->routeIs('admin.profil-dinas*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}"></i>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Profil Dinas
                            </span>
                        </a>
                    </li>
                    <!-- Menu Item Profil Dinas -->

                    <!-- Menu Item Harga Pasar -->
                    <li>
                        <a href="{{ route('admin.market-prices.index') }}"
                            class="menu-item group {{ request()->routeIs('admin.market-prices*') ? 'menu-item-active' : 'menu-item-inactive' }}">
                            <i
                                class="fa-solid fa-hand-holding-dollar text-xl {{ request()->routeIs('admin.market-prices*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}"></i>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Harga Pasar
                            </span>
                        </a>
                    </li>
                    <!-- Menu Item Harga Pasar -->

                    <!-- Menu Item Berita & Artikel -->
                    <li>
                        <a href="#"
                            class="menu-item group {{ request()->routeIs('admin.articles*') || request()->routeIs('admin.article-categories*') ? 'menu-item-active' : 'menu-item-inactive' }}"
                            @click.prevent="selected = (selected === 'Articles' ? '' : 'Articles')">
                            <i
                                class="fa-solid fa-newspaper text-xl {{ request()->routeIs('admin.articles*') || request()->routeIs('admin.article-categories*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}"></i>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Berita & Artikel
                            </span>

                            <svg class="menu-item-arrow w-5 h-5" :class="{ 'rotate-180': selected === 'Articles' }"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu Start -->
                        <div class="translate transform overflow-hidden"
                            :class="(selected === 'Articles') ? 'block' : 'hidden'">
                            <ul class="menu-dropdown mt-2 flex flex-col gap-1 pl-9"
                                :class="sidebarToggle ? 'lg:hidden' : 'flex'">
                                <li>
                                    <a href="{{ route('admin.articles.index') }}"
                                        class="menu-dropdown-item group {{ request()->routeIs('admin.articles.index') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive' }}">
                                        Daftar Berita
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.articles.create') }}"
                                        class="menu-dropdown-item group {{ request()->routeIs('admin.articles.create') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive' }}">
                                        Tambah Berita
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.article-categories.index') }}"
                                        class="menu-dropdown-item group {{ request()->routeIs('admin.article-categories*') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive' }}">
                                        Kategori
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Dropdown Menu End -->
                    </li>
                    <!-- Menu Item Berita & Artikel -->

            </div>
        </nav>
        <!-- Sidebar Menu -->
    </div>
</aside>