@extends('layouts.admin')

@section('title', 'Detail Kategori: ' . $articleCategory->name)

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Detail Kategori
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium" href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li><a class="font-medium" href="{{ route('admin.article-categories.index') }}">Kategori /</a></li>
                    <li class="font-medium text-primary">Detail</li>
                </ol>
            </nav>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.article-categories.index') }}"
                class="flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0203 3.51583C11.1996 3.33653 11.2761 3.0788 11.2238 2.8307C11.1714 2.5826 11.0026 2.37048 10.7601 2.27996C10.5176 2.18944 10.2483 2.23846 10.0518 2.40905L3.42681 8.15905C3.16006 8.39054 3.00003 8.7366 3.00003 9.10006C3.00003 9.46352 3.16006 9.80959 3.42681 10.0411L10.0518 15.7911C10.2483 15.9617 10.5176 16.0107 10.7601 15.9202C11.0026 15.8296 11.1714 15.6175 11.2238 15.3694C11.2761 15.1213 11.1996 14.8636 11.0203 14.6843L5.47163 9.86881L14.25 9.86881C14.6642 9.86881 15 9.53302 15 9.11881C15 8.7046 14.6642 8.36881 14.25 8.36881L5.47163 8.36881L11.0203 3.51583Z" fill=""/>
                </svg>
                Kembali
            </a>
            @can('content.update')
                <a href="{{ route('admin.article-categories.edit', $articleCategory) }}"
                    class="flex w-full items-center justify-center gap-2 rounded-full bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600 sm:w-auto">
                    <x-heroicon-o-pencil class="w-5 h-5" />
                    Edit
                </a>
            @endcan
        </div>
    </div>

    <div class="grid grid-cols-1 gap-9 lg:grid-cols-3">
        <!-- Left Column: Category Info -->
        <div class="flex flex-col gap-9 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                <!-- Header -->
                <div class="mb-6 border-b border-gray-200 pb-6 dark:border-gray-800">
                    <h1 class="mb-4 flex items-center gap-3 text-2xl font-bold text-gray-800 dark:text-white/90 sm:text-3xl">
                        <svg class="fill-current text-brand-500" width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.25 6C2.25 4.75736 3.25736 3.75 4.5 3.75H9.23438C9.56586 3.75 9.88378 3.8817 10.1182 4.11612L12.3839 6.38178C12.6183 6.6162 12.9362 6.7479 13.2677 6.7479H19.5C20.7426 6.7479 21.75 7.75526 21.75 9V18C21.75 19.2426 20.7426 20.25 19.5 20.25H4.5C3.25736 20.25 2.25 19.2426 2.25 18V6Z" fill=""/>
                        </svg>
                        {{ $articleCategory->name }}
                        @if($articleCategory->parent)
                            <span class="text-lg font-normal text-gray-500 dark:text-gray-400">({{ $articleCategory->parent->name }})</span>
                        @endif
                    </h1>
                    
                    <div class="flex flex-wrap items-center gap-3">
                        @if($articleCategory->is_active)
                            <span class="inline-flex items-center gap-1 rounded-full bg-success-50 px-2 py-0.5 text-xs font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 rounded-full bg-gray-50 px-2 py-0.5 text-xs font-medium text-gray-600 dark:bg-gray-500/15 dark:text-gray-500">
                                Tidak Aktif
                            </span>
                        @endif
                        <span class="inline-flex items-center gap-1 rounded-full bg-brand-50 px-2 py-0.5 text-xs font-medium text-brand-600 dark:bg-brand-500/15 dark:text-brand-500">
                            {{ $articleCategory->publishedArticles->count() }} Artikel Published
                        </span>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h4 class="mb-3 text-sm font-semibold text-gray-800 dark:text-white/90">Deskripsi</h4>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ $articleCategory->description ?? 'Tidak ada deskripsi' }}
                    </p>
                </div>

                <!-- Sub-Categories -->
                @if($articleCategory->children->count() > 0)
                    <div class="mb-6">
                        <h4 class="mb-3 text-sm font-semibold text-gray-800 dark:text-white/90">Sub-Kategori ({{ $articleCategory->children->count() }})</h4>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            @foreach($articleCategory->children as $child)
                                <div class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-white/[0.02]">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <svg class="fill-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.66667 12.6667L11.3333 8L6.66667 3.33333V12.6667Z" fill=""/>
                                            </svg>
                                            <a href="{{ route('admin.article-categories.show', $child) }}" class="font-medium text-gray-800 hover:text-brand-500 dark:text-white/90 dark:hover:text-brand-400">
                                                {{ $child->name }}
                                            </a>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs text-gray-500">{{ $child->publishedArticles->count() }} Artikel</span>
                                            @if(!$child->is_active)
                                                <span class="rounded bg-gray-200 px-1.5 py-0.5 text-[10px] font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-400">Non-Aktif</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Recent Articles -->
                <div>
                    <h4 class="mb-3 text-sm font-semibold text-gray-800 dark:text-white/90">Artikel Terbaru</h4>
                    @if($articleCategory->publishedArticles->count() > 0)
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            @foreach($articleCategory->publishedArticles->take(6) as $article)
                                <div class="rounded-lg border border-gray-100 p-4 dark:border-gray-800">
                                    <div class="flex justify-between items-start mb-2">
                                        <a href="{{ route('admin.articles.show', $article) }}" class="font-medium text-gray-800 hover:text-brand-500 dark:text-white/90 dark:hover:text-brand-400 line-clamp-2">
                                            {{ $article->title }}
                                        </a>
                                        @if($article->is_featured)
                                            <svg class="fill-warning-500 shrink-0 ml-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 1.33333L10.06 5.50667L14.6667 6.18L11.3333 9.42667L12.12 14.0133L8 11.8467L3.88 14.0133L4.66667 9.42667L1.33333 6.18L5.94 5.50667L8 1.33333Z" fill=""/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $article->author->name }} • {{ $article->published_at->format('d M Y') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($articleCategory->publishedArticles->count() > 6)
                            <div class="mt-4 text-center">
                                <a href="{{ route('articles.category', $articleCategory) }}" target="_blank" class="text-sm font-medium text-brand-500 hover:text-brand-600">
                                    Lihat Semua Artikel &rarr;
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="flex flex-col items-center justify-center py-8 text-center rounded-lg border border-dashed border-gray-200 dark:border-gray-700">
                            <div class="mb-3 rounded-full bg-gray-100 p-3 dark:bg-gray-800">
                                <svg class="fill-gray-400" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.5 20.25H4.5C3.25736 20.25 2.25 19.2426 2.25 18V6C2.25 4.75736 3.25736 3.75 4.5 3.75H9.23438C9.56586 3.75 9.88378 3.8817 10.1182 4.11612L12.3839 6.38178C12.6183 6.6162 12.9362 6.7479 13.2677 6.7479H19.5C20.7426 6.7479 21.75 7.75526 21.75 9V18C21.75 19.2426 20.7426 20.25 19.5 20.25ZM4.5 5.25C4.08579 5.25 3.75 5.58579 3.75 6V18C3.75 18.4142 4.08579 18.75 4.5 18.75H19.5C19.9142 18.75 20.25 18.4142 20.25 18V9C20.25 8.58579 19.9142 8.25 19.5 8.25H13.2677C12.5344 8.25 11.8313 7.95856 11.3129 7.44012L9.04715 5.17446C8.92994 5.05725 8.77098 4.9914 8.60522 4.9914H4.5V5.25Z" fill=""/>
                                    <path d="M16.5 13.5H7.5C7.08579 13.5 6.75 13.1642 6.75 12.75C6.75 12.3358 7.08579 12 7.5 12H16.5C16.9142 12 17.25 12.3358 17.25 12.75C17.25 13.1642 16.9142 13.5 16.5 13.5Z" fill=""/>
                                </svg>
                            </div>
                            <p class="mb-3 text-sm text-gray-500 dark:text-gray-400">Belum ada artikel yang dipublikasikan.</p>
                            @can('articles.create')
                                <a href="{{ route('admin.articles.create') }}?category_id={{ $articleCategory->id }}" class="text-sm font-medium text-brand-500 hover:text-brand-600">
                                    Tambah Artikel Pertama &rarr;
                                </a>
                            @endcan
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Sidebar -->
        <div class="flex flex-col gap-9 lg:col-span-1">
            <!-- Quick Actions -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Aksi Cepat</h3>
                
                <div class="flex flex-col gap-3">
                    @can('content.update')
                        <a href="{{ route('admin.article-categories.edit', $articleCategory) }}" class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                            <x-heroicon-o-pencil class="w-5 h-5" />
                            Edit Kategori
                        </a>

                        <a href="{{ route('admin.articles.create') }}?category_id={{ $articleCategory->id }}" class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 3.75C9.41421 3.75 9.75 4.08579 9.75 4.5V8.25H13.5C13.9142 8.25 14.25 8.58579 14.25 9C14.25 9.41421 13.9142 9.75 13.5 9.75H9.75V13.5C9.75 13.9142 9.41421 14.25 9 14.25C8.58579 14.25 8.25 13.9142 8.25 13.5V9.75H4.5C4.08579 9.75 3.75 9.41421 3.75 9C3.75 8.58579 4.08579 8.25 4.5 8.25H8.25V4.5C8.25 4.08579 8.58579 3.75 9 3.75Z" fill=""/>
                            </svg>
                            Tambah Artikel
                        </a>
                    @endcan

                    <a href="{{ route('articles.category', $articleCategory) }}" target="_blank" class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.5 1.5C10.5 1.08579 10.8358 0.75 11.25 0.75H16.5C16.9142 0.75 17.25 1.08579 17.25 1.5V6.75C17.25 7.16421 16.9142 7.5 16.5 7.5C16.0858 7.5 15.75 7.16421 15.75 6.75V3.31066L9.53033 9.53033C9.23744 9.82322 8.76256 9.82322 8.46967 9.53033C8.17678 9.23744 8.17678 8.76256 8.46967 8.46967L14.6893 2.25H11.25C10.8358 2.25 10.5 1.91421 10.5 1.5Z" fill=""/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 3C2.17157 3 1.5 3.67157 1.5 4.5V15C1.5 15.8284 2.17157 16.5 3 16.5H13.5C14.3284 16.5 15 15.8284 15 15V9.75C15 9.33579 15.3358 9 15.75 9C16.1642 9 16.5 9.33579 16.5 9.75V15C16.5 16.6569 15.1569 18 13.5 18H3C1.34315 18 0 16.6569 0 15V4.5C0 2.84315 1.34315 1.5 3 1.5H8.25C8.66421 1.5 9 1.83579 9 2.25C9 2.66421 8.66421 3 8.25 3H3Z" fill=""/>
                        </svg>
                        Lihat di Publik
                    </a>

                    @can('content.delete')
                        <form method="POST" action="{{ route('admin.article-categories.destroy', $articleCategory) }}"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Semua artikel dalam kategori ini akan kehilangan kategorinya.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg border border-error-200 bg-error-50 px-4 py-2.5 text-sm font-medium text-error-600 hover:bg-error-100 dark:border-error-500/20 dark:bg-error-500/10 dark:text-error-500 dark:hover:bg-error-500/20">
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.7535 2.47502H11.5879V4.9969H13.7535V2.47502ZM4.85773 13.6323H5.50685L12.2166 6.92255L11.5675 6.27345L4.85773 12.9832V13.6323ZM13.3289 0.912537H11.5879H10.2512C9.71618 0.912537 9.28125 1.34747 9.28125 1.8825V3.83376L3.62823 9.48677C3.36197 9.75303 3.2124 10.1141 3.2124 10.4906V14.2344C3.2124 14.7694 3.64734 15.2044 4.18237 15.2044H7.92613C8.30266 15.2044 8.66373 15.0548 8.93 14.7885L14.583 9.13549V11.1019C14.583 11.6369 15.018 12.0719 15.553 12.0719C16.088 12.0719 16.523 11.6369 16.523 11.1019V2.47502C16.523 1.61252 15.823 0.912537 14.9605 0.912537H13.3289Z" fill=""/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5 4.5H1.5C1.08579 4.5 0.75 4.83579 0.75 5.25C0.75 5.66421 1.08579 6 1.5 6H2.36496L3.12041 15.0654C3.20919 16.1308 4.10096 16.95 5.16954 16.95H12.8305C13.899 16.95 14.7908 16.1308 14.8796 15.0654L15.635 6H16.5C16.9142 6 17.25 5.66421 17.25 5.25C17.25 4.83579 16.9142 4.5 16.5 4.5ZM14.1229 6H3.87714L4.61581 14.8646C4.64539 15.2196 4.94265 15.45 5.29898 15.45H12.701C13.0573 15.45 13.3546 15.2196 13.3842 14.8646L14.1229 6Z" fill=""/>
                                </svg>
                                Hapus Kategori
                            </button>
                        </form>
                    @endcan
                </div>
            </div>

            <!-- Category Info -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Informasi Kategori</h3>
                
                <div class="flex flex-col gap-4">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Slug</span>
                        <span class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $articleCategory->slug }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Status</span>
                        @if($articleCategory->is_active)
                            <span class="inline-flex items-center gap-1 rounded-full bg-success-50 px-2 py-0.5 text-xs font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 rounded-full bg-gray-50 px-2 py-0.5 text-xs font-medium text-gray-600 dark:bg-gray-500/15 dark:text-gray-500">
                                Tidak Aktif
                            </span>
                        @endif
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Urutan</span>
                        <span class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $articleCategory->sort_order }}</span>
                    </div>
                    @if($articleCategory->parent)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500 dark:text-gray-400">Kategori Induk</span>
                            <span class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $articleCategory->parent->name }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Dibuat</span>
                        <span class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $articleCategory->created_at->format('d M Y H:i') }}</span>
                    </div>
                    @if($articleCategory->updated_at != $articleCategory->created_at)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500 dark:text-gray-400">Diupdate</span>
                            <span class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $articleCategory->updated_at->format('d M Y H:i') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Statistics -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Statistik</h3>
                
                <div class="flex flex-col gap-4">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Total Artikel</span>
                        <span class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $articleCategory->articles->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Artikel Published</span>
                        <span class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $articleCategory->publishedArticles->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Artikel Draft</span>
                        <span class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $articleCategory->articles->where('status', 'draft')->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Sub-Kategori</span>
                        <span class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $articleCategory->children->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- SEO Info -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">SEO Info</h3>
                
                <div class="mb-4">
                    <label class="mb-2.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        URL Publik
                    </label>
                    <div class="relative">
                        <input type="text" value="{{ route('articles.category', $articleCategory) }}" readonly
                            class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm text-gray-800 outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                        <button onclick="copyUrl('{{ route('articles.category', $articleCategory) }}')"
                            class="absolute right-2 top-1/2 -translate-y-1/2 rounded-md p-1.5 text-gray-500 hover:bg-gray-200 dark:text-gray-400 dark:hover:bg-gray-800">
                            <svg class="fill-current" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.6667 1.33333H2.66667C1.93333 1.33333 1.33333 1.93333 1.33333 2.66667V10.6667H2.66667V2.66667H10.6667V1.33333ZM12.6667 4H5.33333C4.6 4 4 4.6 4 5.33333V13.3333C4 14.0667 4.6 14.6667 5.33333 14.6667H12.6667C13.4 14.6667 14 14.0667 14 13.3333V5.33333C14 4.6 13.4 4 12.6667 4ZM12.6667 13.3333H5.33333V5.33333H12.6667V13.3333Z" fill=""/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function copyUrl(url) {
    navigator.clipboard.writeText(url).then(function() {
        // Optional: Show toast notification
        alert('URL berhasil disalin!');
    });
}
</script>
@endpush