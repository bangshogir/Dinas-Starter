<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @vite(['resources/js/admin/index.js'])
    @livewireStyles
</head>

<body
    x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}">
    <!-- Preloader -->
    @include('partials.admin.preloader')

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('partials.admin.sidebar')

        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Overlay -->
            @include('partials.admin.overlay')

            <!-- Header -->
            @include('partials.admin.header')

            <main>
                <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @livewireScripts
</body>

</html>