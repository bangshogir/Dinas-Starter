@extends('layouts.admin')

@section('title', 'Hero Slides')

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Hero Slides
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium" href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li class="font-medium text-primary">Hero Slides</li>
                </ol>
            </nav>
        </div>

        <a href="{{ route('admin.hero-slides.create') }}"
            class="flex w-full items-center justify-center gap-2 rounded-full bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600 sm:w-auto">
            <i class="fa-solid fa-plus w-5 h-5"></i>
            Tambah Slide
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-success-50 px-6 py-4 text-success-800 dark:bg-success-500/15 dark:text-success-500">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-check-circle"></i>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Table Container -->
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="max-w-full overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Order</p>
                        </th>
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Image</p>
                        </th>
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Info</p>
                        </th>
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Status</p>
                        </th>
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Aksi</p>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($slides as $slide)
                        <tr>
                            <td class="px-5 py-4 sm:px-6">
                                <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                    {{ $slide->order }}
                                </span>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="h-16 w-32 overflow-hidden rounded-md border border-gray-200 dark:border-gray-700">
                                    <img src="{{ asset('assets/' . $slide->image_path) }}" class="h-full w-full object-cover"
                                        alt="Slide">
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div>
                                    <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                        {{ $slide->title ?? '-' }}
                                    </span>
                                    <span class="block text-gray-500 text-theme-xs dark:text-gray-400 mt-1">
                                        {{ $slide->subtitle ?? '' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                @if($slide->is_active)
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                        <span class="h-1.5 w-1.5 rounded-full bg-success-600 dark:bg-success-500"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-gray-50 px-2 py-0.5 text-theme-xs font-medium text-gray-600 dark:bg-gray-500/15 dark:text-gray-500">
                                        <span class="h-1.5 w-1.5 rounded-full bg-gray-600 dark:bg-gray-500"></span>
                                        Non-Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center space-x-3.5">
                                    <a href="{{ route('admin.hero-slides.edit', $slide) }}"
                                        class="text-gray-500 hover:text-primary dark:text-gray-400 dark:hover:text-primary transition-colors">
                                        <i class="fa-regular fa-pen-to-square w-5 h-5 text-current"></i>
                                    </a>
                                    <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Yakin ingin menghapus slide ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-gray-500 hover:text-error-500 dark:text-gray-400 dark:hover:text-error-400 transition-colors">
                                            <i class="fa-regular fa-trash-can w-5 h-5 text-current"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="mb-4 rounded-full bg-gray-100 p-4 dark:bg-gray-800">
                                        <i class="fa-regular fa-images w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <h3 class="mb-1 text-lg font-semibold text-gray-800 dark:text-white/90">Belum ada slide</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Tambahkan gambar slide untuk halaman
                                        depan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection