@extends('layouts.admin')

@section('title', 'Profil Dinas')

@section('content')
    @include('partials.admin.notifications')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Profil Dinas
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium" href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li class="font-medium text-primary">Profil Dinas</li>
                </ol>
            </nav>
        </div>

        {{-- Tombol Edit di Header --}}
        @if($profil)
            @can('profil-dinas.update')
                <a href="{{ route('admin.profil-dinas.edit') }}"
                    class="flex w-full items-center justify-center gap-2 rounded-full bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600 sm:w-auto">
                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
                            fill="" />
                    </svg>
                    Edit Profil
                </a>
            @endcan
        @endif
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
        @if($profil)
            <!-- Informasi Umum -->
            <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                    <div class="w-full">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-6">
                            Informasi Umum
                        </h4>

                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7 2xl:gap-x-32">
                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                    Nama Dinas
                                </p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $profil->nama_dinas }}
                                </p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                    Sub Title
                                </p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $profil->sub_title ?? '-' }}
                                </p>
                            </div>

                            <div class="lg:col-span-2">
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                    Alamat Kantor
                                </p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $profil->alamat_kantor ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                    Nomor Telepon
                                </p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $profil->nomor_telepon ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                    Email
                                </p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $profil->email ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                    <div class="w-full">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-6">
                            Social Media
                        </h4>

                        @if(!empty($profil->social_media_links) && array_filter($profil->social_media_links))
                            <div class="flex flex-wrap gap-3">
                                @foreach($profil->social_media_links as $platform => $url)
                                    @if($url)
                                        <a href="{{ $url }}" target="_blank"
                                            class="flex h-11 w-11 items-center justify-center gap-2 rounded-full border border-gray-300 bg-white text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
                                            title="{{ ucfirst($platform) }}">
                                            @if($platform === 'facebook')
                                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M11.6666 11.2503H13.7499L14.5833 7.91699H11.6666V6.25033C11.6666 5.39251 11.6666 4.58366 13.3333 4.58366H14.5833V1.78374C14.3118 1.7477 13.2858 1.66699 12.2023 1.66699C9.94025 1.66699 8.33325 3.04771 8.33325 5.58342V7.91699H5.83325V11.2503H8.33325V18.3337H11.6666V11.2503Z"
                                                        fill="" />
                                                </svg>
                                            @elseif($platform === 'twitter')
                                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M15.1708 1.875H17.9274L11.9049 8.75833L18.9899 18.125H13.4424L9.09742 12.4442L4.12578 18.125H1.36745L7.80912 10.7625L1.01245 1.875H6.70078L10.6283 7.0675L15.1708 1.875ZM14.2033 16.475H15.7308L5.87078 3.43833H4.23162L14.2033 16.475Z"
                                                        fill="" />
                                                </svg>
                                            @elseif($platform === 'instagram')
                                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10.8567 1.66699C11.7946 1.66854 12.2698 1.67351 12.6805 1.68573L12.8422 1.69102C13.0291 1.69766 13.2134 1.70599 13.4357 1.71641C14.3224 1.75738 14.9273 1.89766 15.4586 2.10391C16.0078 2.31572 16.4717 2.60183 16.9349 3.06503C17.3974 3.52822 17.6836 3.99349 17.8961 4.54141C18.1016 5.07197 18.2419 5.67753 18.2836 6.56433C18.2935 6.78655 18.3015 6.97088 18.3081 7.15775L18.3133 7.31949C18.3255 7.73011 18.3311 8.20543 18.3328 9.1433L18.3335 9.76463C18.3336 9.84055 18.3336 9.91888 18.3336 9.99972L18.3335 10.2348L18.333 10.8562C18.3314 11.794 18.3265 12.2694 18.3142 12.68L18.3089 12.8417C18.3023 13.0286 18.294 13.213 18.2836 13.4351C18.2426 14.322 18.1016 14.9268 17.8961 15.458C17.6842 16.0074 17.3974 16.4713 16.9349 16.9345C16.4717 17.397 16.0057 17.6831 15.4586 17.8955C14.9273 18.1011 14.3224 18.2414 13.4357 18.2831C13.2134 18.293 13.0291 18.3011 12.8422 18.3076L12.6805 18.3128C12.2698 18.3251 11.7946 18.3306 10.8567 18.3324L10.2353 18.333C10.1594 18.333 10.0811 18.333 10.0002 18.333H9.76516L9.14375 18.3325C8.20591 18.331 7.7306 18.326 7.31997 18.3137L7.15824 18.3085C6.97136 18.3018 6.78703 18.2935 6.56481 18.2831C5.67801 18.2421 5.07384 18.1011 4.5419 17.8955C3.99328 17.6838 3.5287 17.397 3.06551 16.9345C2.60231 16.4713 2.3169 16.0053 2.1044 15.458C1.89815 14.9268 1.75856 14.322 1.7169 13.4351C1.707 13.213 1.69892 13.0286 1.69238 12.8417L1.68714 12.68C1.67495 12.2694 1.66939 11.794 1.66759 10.8562L1.66748 9.1433C1.66903 8.20543 1.67399 7.73011 1.68621 7.31949L1.69151 7.15775C1.69815 6.97088 1.70648 6.78655 1.7169 6.56433C1.75786 5.67683 1.89815 5.07266 2.1044 4.54141C2.3162 3.9928 2.60231 3.52822 3.06551 3.06503C3.5287 2.60183 3.99398 2.31641 4.5419 2.10391C5.07315 1.89766 5.67731 1.75808 6.56481 1.71641C6.78703 1.70652 6.97136 1.69844 7.15824 1.6919L7.31997 1.68666C7.7306 1.67446 8.20591 1.6689 9.14375 1.6671L10.8567 1.66699ZM10.0002 5.83308C7.69781 5.83308 5.83356 7.69935 5.83356 9.99972C5.83356 12.3021 7.69984 14.1664 10.0002 14.1664C12.3027 14.1664 14.1669 12.3001 14.1669 9.99972C14.1669 7.69732 12.3006 5.83308 10.0002 5.83308ZM10.0002 7.49974C11.381 7.49974 12.5002 8.61863 12.5002 9.99972C12.5002 11.3805 11.3813 12.4997 10.0002 12.4997C8.6195 12.4997 7.50023 11.3809 7.50023 9.99972C7.50023 8.61897 8.61908 7.49974 10.0002 7.49974ZM14.3752 4.58308C13.8008 4.58308 13.3336 5.04967 13.3336 5.62403C13.3336 6.19841 13.8002 6.66572 14.3752 6.66572C14.9496 6.66572 15.4169 6.19913 15.4169 5.62403C15.4169 5.04967 14.9488 4.58236 14.3752 4.58308Z"
                                                        fill="" />
                                                </svg>
                                            @elseif($platform === 'youtube')
                                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M19.5833 5.83333C19.4375 5.29167 19.0417 4.875 18.5 4.70833C17.0833 4.375 10 4.375 10 4.375C10 4.375 2.91667 4.375 1.5 4.70833C0.958333 4.875 0.5625 5.29167 0.416667 5.83333C0.0833333 7.25 0.0833333 10.2083 0.0833333 10.2083C0.0833333 10.2083 0.0833333 13.1667 0.416667 14.5833C0.5625 15.125 0.958333 15.5208 1.5 15.6875C2.91667 16.0208 10 16.0208 10 16.0208C10 16.0208 17.0833 16.0208 18.5 15.6875C19.0417 15.5208 19.4375 15.125 19.5833 14.5833C19.9167 13.1667 19.9167 10.2083 19.9167 10.2083C19.9167 10.2083 19.9167 7.25 19.5833 5.83333ZM8.125 12.7083V7.70833L13.125 10.2083L8.125 12.7083Z"
                                                        fill="" />
                                                </svg>
                                            @endif
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada link social media</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Logo -->
            <div class="p-5 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                    <div class="w-full">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-6">
                            Logo Dinas
                        </h4>

                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7">
                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                    Logo Tanpa Text
                                </p>
                                @if($profil->logo_tanpa_text)
                                    <div class="mt-3 p-4 border border-gray-200 rounded-lg dark:border-gray-800 inline-block">
                                        <img src="{{ asset('storage/' . $profil->logo_tanpa_text) }}" alt="Logo Tanpa Text"
                                            class="h-20 w-auto">
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 dark:text-gray-400">-</p>
                                @endif
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                    Logo Dengan Text
                                </p>
                                @if($profil->logo_dengan_text)
                                    <div class="mt-3 p-4 border border-gray-200 rounded-lg dark:border-gray-800 inline-block">
                                        <img src="{{ asset('storage/' . $profil->logo_dengan_text) }}" alt="Logo Dengan Text"
                                            class="h-20 w-auto">
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 dark:text-gray-400">-</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-10">
                <p class="text-gray-500 dark:text-gray-400 mb-4">Belum ada data profil dinas.</p>
                @can('profil-dinas.update')
                    <a href="{{ route('admin.profil-dinas.edit') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 1.5C9.41421 1.5 9.75 1.83579 9.75 2.25V8.25H15.75C16.1642 8.25 16.5 8.58579 16.5 9C16.5 9.41421 16.1642 9.75 15.75 9.75H9.75V15.75C9.75 16.1642 9.41421 16.5 9 16.5C8.58579 16.5 8.25 16.1642 8.25 15.75V9.75H2.25C1.83579 9.75 1.5 9.41421 1.5 9C1.5 8.58579 1.83579 8.25 2.25 8.25H8.25V2.25C8.25 1.83579 8.58579 1.5 9 1.5Z"
                                fill="" />
                        </svg>
                        Buat Profil Sekarang
                    </a>
                @endcan
            </div>
        @endif
    </div>
@endsection