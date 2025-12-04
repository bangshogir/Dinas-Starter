@extends('layouts.admin')

@section('title', 'Daftar Artikel')

@section('content')
    @include('partials.admin.notifications')

    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Daftar Artikel
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium" href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li class="font-medium text-primary">Artikel</li>
                </ol>
            </nav>
        </div>

        @can('articles.create')
            <a href="{{ route('admin.articles.create') }}"
                class="flex w-full items-center justify-center gap-2 rounded-full bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600 sm:w-auto">
                <x-heroicon-o-plus class="w-5 h-5" />
                Tambah Artikel
            </a>
        @endcan
    </div>

    <!-- Table Container -->
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]"
        x-data="{ showFilters: {{ request()->filled(['status', 'category', 'featured']) ? 'true' : 'false' }} }">

        <!-- Header with Search and Filter -->
        <div
            class="flex flex-col gap-4 px-5 py-4 sm:px-6 sm:flex-row sm:items-center sm:justify-between border-b border-gray-100 dark:border-gray-800">
            <!-- Title -->
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                Daftar Artikel
            </h3>

            <!-- Search and Filter -->
            <form method="GET" action="{{ route('admin.articles.index') }}" class="flex items-center gap-3">
                <!-- Search Input -->
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..."
                        class="w-full sm:w-64 rounded-lg border border-gray-300 bg-transparent pl-11 pr-5 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />

                    <!-- Search Icon -->
                    <x-heroicon-o-magnifying-glass class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500 dark:text-gray-400" />
                </div>

                <!-- Filter Button -->
                <button type="button" @click="showFilters = !showFilters"
                    class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
                    :class="{ 'bg-brand-50 border-brand-300 text-brand-600 dark:bg-brand-500/10 dark:border-brand-700 dark:text-brand-400': showFilters }">
                    <x-heroicon-o-adjustments-horizontal class="w-5 h-5 text-current" />
                    Filter
                </button>
            </form>
        </div>

        <!-- Collapsible Filter Section -->
        <div x-show="showFilters" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="px-5 py-4 sm:px-6 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-white/[0.02]">

            <form method="GET" action="{{ route('admin.articles.index') }}">
                <!-- Preserve search value -->
                <input type="hidden" name="search" value="{{ request('search') }}">

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Status -->
                    <div>
                        <label class="mb-2 block text-xs font-medium text-gray-600 dark:text-gray-400">
                            Status
                        </label>
                        <div class="relative z-20">
                            <select name="status" onchange="this.form.submit()"
                                class="relative z-20 w-full appearance-none rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800">
                                <option value="">Semua Status</option>
                                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published
                                </option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived
                                </option>
                            </select>
                            <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2 pointer-events-none">
                                <x-heroicon-o-chevron-down class="w-5 h-5 text-gray-500 dark:text-gray-400" />
                            </span>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="mb-2 block text-xs font-medium text-gray-600 dark:text-gray-400">
                            Kategori
                        </label>
                        <div class="relative z-20">
                            <select name="category" onchange="this.form.submit()"
                                class="relative z-20 w-full appearance-none rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2 pointer-events-none">
                                <x-heroicon-o-chevron-down class="w-5 h-5 text-gray-500 dark:text-gray-400" />
                            </span>
                        </div>
                    </div>

                    <!-- Featured -->
                    <div>
                        <label class="mb-2 block text-xs font-medium text-gray-600 dark:text-gray-400">
                            Tipe
                        </label>
                        <div class="relative z-20">
                            <select name="featured" onchange="this.form.submit()"
                                class="relative z-20 w-full appearance-none rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800">
                                <option value="">Semua Tipe</option>
                                <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Featured</option>
                                <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>Standard</option>
                            </select>
                            <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2 pointer-events-none">
                                <x-heroicon-o-chevron-down class="w-5 h-5 text-gray-500 dark:text-gray-400" />
                            </span>
                        </div>
                    </div>

                    <!-- Clear Filters Button -->
                    <div class="flex items-end">
                        <a href="{{ route('admin.articles.index') }}"
                            class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                            <x-heroicon-o-x-mark class="w-4 h-4 text-current" />
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="max-w-full overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Judul</p>
                        </th>
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Kategori</p>
                        </th>
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Author</p>
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
                    @forelse($articles as $article)
                        <tr>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 overflow-hidden rounded-md bg-gray-100 dark:bg-gray-800">
                                        @if($article->featured_image)
                                            <img src="{{ asset('storage/' . $article->featured_image) }}"
                                                alt="{{ $article->title }}" class="h-full w-full object-cover" />
                                        @else
                                            <div class="flex h-full w-full items-center justify-center text-gray-400 dark:text-gray-500">
                                                <x-heroicon-o-photo class="w-6 h-6 text-current" />
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                            {{ Str::limit($article->title, 40) }}
                                        </span>
                                        <!-- <span class="block text-gray-500 text-theme-xs dark:text-gray-400">
                                            {{ Str::limit($article->excerpt, 50) }}
                                        </span> -->
                                        <!-- @if($article->is_featured)
                                            <span
                                                class="mt-1 inline-flex items-center gap-1 rounded-full bg-warning-50 px-2 py-0.5 text-[10px] font-medium text-warning-600 dark:bg-warning-500/15 dark:text-warning-500">
                                                Featured
                                            </span>
                                        @endif -->
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $article->category->name ?? '-' }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $article->author->name }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                @if($article->status == 'published')
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                        <span class="h-1.5 w-1.5 rounded-full bg-success-600 dark:bg-success-500"></span>
                                        Published
                                    </span>
                                @elseif($article->status == 'draft')
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-warning-50 px-2 py-0.5 text-theme-xs font-medium text-warning-700 dark:bg-warning-500/15 dark:text-warning-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-warning-600 dark:bg-warning-500"></span>
                                        Draft
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-gray-50 px-2 py-0.5 text-theme-xs font-medium text-gray-600 dark:bg-gray-500/15 dark:text-gray-500">
                                        <span class="h-1.5 w-1.5 rounded-full bg-gray-600 dark:bg-gray-500"></span>
                                        Archived
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center space-x-3.5">
                                    <a href="{{ route('admin.articles.show', $article) }}" class="text-gray-500 hover:text-primary dark:text-gray-400 dark:hover:text-primary transition-colors">
                                        <x-heroicon-o-eye class="w-5 h-5 text-current" />
                                    </a>
                                    @can('articles.update')
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="text-gray-500 hover:text-primary dark:text-gray-400 dark:hover:text-primary transition-colors">
                                            <x-heroicon-o-pencil class="w-5 h-5 text-current" />
                                        </a>
                                    @endcan
                                    @can('articles.delete')
                                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-500 hover:text-error-500 dark:text-gray-400 dark:hover:text-error-400 transition-colors">
                                                <x-heroicon-o-trash class="w-5 h-5 text-current" />
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="mb-4 rounded-full bg-gray-100 p-4 dark:bg-gray-800">
                                        <x-heroicon-o-document-text class="w-8 h-8 text-gray-400 dark:text-gray-500" />
                                    </div>
                                    <h3 class="mb-1 text-lg font-semibold text-gray-800 dark:text-white/90">Belum ada artikel
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Mulai dengan membuat artikel baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-5 py-4 sm:px-6 border-t border-gray-100 dark:border-gray-800">
            {{ $articles->links() }}
        </div>
    </div>
@endsection