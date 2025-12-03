@extends('layouts.admin')

@section('title', 'Kategori Artikel')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Kategori Artikel
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium" href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li class="font-medium text-primary">Kategori Artikel</li>
                </ol>
            </nav>
        </div>

        @can('content.create')
            <a href="{{ route('admin.article-categories.create') }}"
                class="flex w-full items-center justify-center gap-2 rounded-full bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600 sm:w-auto">
                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 3.75C9.41421 3.75 9.75 4.08579 9.75 4.5V8.25H13.5C13.9142 8.25 14.25 8.58579 14.25 9C14.25 9.41421 13.9142 9.75 13.5 9.75H9.75V13.5C9.75 13.9142 9.41421 14.25 9 14.25C8.58579 14.25 8.25 13.9142 8.25 13.5V9.75H4.5C4.08579 9.75 3.75 9.41421 3.75 9C3.75 8.58579 4.08579 8.25 4.5 8.25H8.25V4.5C8.25 4.08579 8.58579 3.75 9 3.75Z" fill=""/>
                </svg>
                Tambah Kategori
            </a>
        @endcan
    </div>

    <div class="flex flex-col gap-6">
        @forelse($categories as $category)
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="flex items-center gap-2 text-lg font-bold text-gray-800 dark:text-white/90">
                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.25 6C2.25 4.75736 3.25736 3.75 4.5 3.75H9.23438C9.56586 3.75 9.88378 3.8817 10.1182 4.11612L12.3839 6.38178C12.6183 6.6162 12.9362 6.7479 13.2677 6.7479H19.5C20.7426 6.7479 21.75 7.75526 21.75 9V18C21.75 19.2426 20.7426 20.25 19.5 20.25H4.5C3.25736 20.25 2.25 19.2426 2.25 18V6Z" fill=""/>
                            </svg>
                            {{ $category->name }}
                            @if($category->parent)
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">({{ $category->parent->name }})</span>
                            @endif
                        </h3>
                    </div>
                    <div class="flex items-center gap-2">
                        @if($category->is_active)
                            <span class="inline-flex items-center gap-1 rounded-full bg-success-50 px-2 py-0.5 text-xs font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 rounded-full bg-gray-50 px-2 py-0.5 text-xs font-medium text-gray-600 dark:bg-gray-500/15 dark:text-gray-500">
                                Tidak Aktif
                            </span>
                        @endif
                        <span class="inline-flex items-center gap-1 rounded-full bg-brand-50 px-2 py-0.5 text-xs font-medium text-brand-600 dark:bg-brand-500/15 dark:text-brand-500">
                            {{ $category->publishedArticles->count() }} Artikel
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                    <!-- Left Column: Info & Children -->
                    <div class="lg:col-span-2">
                        <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                            {{ $category->description ?? 'Tidak ada deskripsi' }}
                        </p>

                        <!-- Sub-Categories -->
                        @if($category->children->count() > 0)
                            <div class="mb-6">
                                <h4 class="mb-3 text-sm font-semibold text-gray-800 dark:text-white/90">Sub-Kategori ({{ $category->children->count() }})</h4>
                                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                                    @foreach($category->children as $child)
                                        <div class="flex items-center justify-between rounded-lg border border-gray-100 bg-gray-50 p-3 dark:border-gray-800 dark:bg-white/[0.02]">
                                            <div class="flex items-center gap-2">
                                                <svg class="fill-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6.66667 12.6667L11.3333 8L6.66667 3.33333V12.6667Z" fill=""/>
                                                </svg>
                                                <a href="{{ route('admin.article-categories.show', $child) }}" class="text-sm font-medium text-gray-700 hover:text-brand-500 dark:text-gray-300 dark:hover:text-brand-400">
                                                    {{ $child->name }}
                                                </a>
                                            </div>
                                            <span class="text-xs text-gray-500">{{ $child->publishedArticles->count() }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Recent Articles -->
                        @if($category->publishedArticles->count() > 0)
                            <div>
                                <h4 class="mb-3 text-sm font-semibold text-gray-800 dark:text-white/90">Artikel Terkini</h4>
                                <div class="flex flex-col gap-3">
                                    @foreach($category->publishedArticles->take(3) as $article)
                                        <div class="flex items-start justify-between rounded-lg border border-gray-100 p-3 dark:border-gray-800">
                                            <div>
                                                <a href="{{ route('admin.articles.show', $article) }}" class="text-sm font-medium text-gray-800 hover:text-brand-500 dark:text-white/90 dark:hover:text-brand-400">
                                                    {{ Str::limit($article->title, 60) }}
                                                </a>
                                                <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $article->author->name }} • {{ $article->published_at->format('d M Y') }}
                                                </div>
                                            </div>
                                            @if($article->is_featured)
                                                <svg class="fill-warning-500" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8 1.33333L10.06 5.50667L14.6667 6.18L11.3333 9.42667L12.12 14.0133L8 11.8467L3.88 14.0133L4.66667 9.42667L1.33333 6.18L5.94 5.50667L8 1.33333Z" fill=""/>
                                                </svg>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                @if($category->publishedArticles->count() > 3)
                                    <div class="mt-3">
                                        <a href="{{ route('articles.category', $category) }}" target="_blank" class="text-sm font-medium text-brand-500 hover:text-brand-600">
                                            Lihat Semua Artikel &rarr;
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center py-6 text-center">
                                <div class="mb-3 rounded-full bg-gray-100 p-3 dark:bg-gray-800">
                                    <svg class="fill-gray-400" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.5 20.25H4.5C3.25736 20.25 2.25 19.2426 2.25 18V6C2.25 4.75736 3.25736 3.75 4.5 3.75H9.23438C9.56586 3.75 9.88378 3.8817 10.1182 4.11612L12.3839 6.38178C12.6183 6.6162 12.9362 6.7479 13.2677 6.7479H19.5C20.7426 6.7479 21.75 7.75526 21.75 9V18C21.75 19.2426 20.7426 20.25 19.5 20.25ZM4.5 5.25C4.08579 5.25 3.75 5.58579 3.75 6V18C3.75 18.4142 4.08579 18.75 4.5 18.75H19.5C19.9142 18.75 20.25 18.4142 20.25 18V9C20.25 8.58579 19.9142 8.25 19.5 8.25H13.2677C12.5344 8.25 11.8313 7.95856 11.3129 7.44012L9.04715 5.17446C8.92994 5.05725 8.77098 4.9914 8.60522 4.9914H4.5V5.25Z" fill=""/>
                                        <path d="M16.5 13.5H7.5C7.08579 13.5 6.75 13.1642 6.75 12.75C6.75 12.3358 7.08579 12 7.5 12H16.5C16.9142 12 17.25 12.3358 17.25 12.75C17.25 13.1642 16.9142 13.5 16.5 13.5Z" fill=""/>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada artikel</p>
                            </div>
                        @endif
                    </div>

                    <!-- Right Column: Stats & Actions -->
                    <div class="flex flex-col gap-6 lg:col-span-1">
                        <!-- Stats -->
                        <div class="rounded-xl border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-white/[0.02]">
                            <h4 class="mb-3 text-sm font-semibold text-gray-800 dark:text-white/90">Statistik</h4>
                            <div class="flex flex-col gap-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500 dark:text-gray-400">Total Artikel</span>
                                    <span class="font-medium text-gray-800 dark:text-white/90">{{ $category->articles->count() }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500 dark:text-gray-400">Publikasi</span>
                                    <span class="font-medium text-gray-800 dark:text-white/90">{{ $category->publishedArticles->count() }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500 dark:text-gray-400">Sub-Kategori</span>
                                    <span class="font-medium text-gray-800 dark:text-white/90">{{ $category->children->count() }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500 dark:text-gray-400">Urutan</span>
                                    <span class="font-medium text-gray-800 dark:text-white/90">{{ $category->sort_order }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('admin.article-categories.show', $category) }}" class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                <svg class="fill-current" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 3.33333C4.66667 3.33333 1.82 5.40667 0.666667 8.33333C1.82 11.26 4.66667 13.3333 8 13.3333C11.3333 13.3333 14.18 11.26 15.3333 8.33333C14.18 5.40667 11.3333 3.33333 8 3.33333ZM8 11.6667C6.16 11.6667 4.66667 10.1733 4.66667 8.33333C4.66667 6.49333 6.16 5 8 5C9.84 5 11.3333 6.49333 11.3333 8.33333C11.3333 10.1733 9.84 11.6667 8 11.6667ZM8 6.33333C6.89333 6.33333 6 7.22667 6 8.33333C6 9.44 6.89333 10.3333 8 10.3333C9.10667 10.3333 10 9.44 10 8.33333C10 7.22667 9.10667 6.33333 8 6.33333Z" fill=""/>
                                </svg>
                                Detail
                            </a>
                            @can('content.update')
                                <a href="{{ route('admin.article-categories.edit', $category) }}" class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                    <svg class="fill-current" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.2253 2.20002H10.3003V4.44168H12.2253V2.20002ZM4.31798 12.1176H4.89498L10.8593 6.15335L10.2823 5.57635L4.31798 11.5406V12.1176ZM11.8479 0.811119H10.3003H9.11215C8.63658 0.811119 8.25 1.1977 8.25 1.67327V3.40772L3.22511 8.43261C2.98843 8.66929 2.85547 8.99024 2.85547 9.32491V12.6528C2.85547 13.1283 3.24205 13.5149 3.71762 13.5149H7.04547C7.38014 13.5149 7.70109 13.382 7.93777 13.1453L12.9626 8.12039V9.86834C12.9626 10.3439 13.3492 10.7305 13.8248 10.7305C14.3003 10.7305 14.6869 10.3439 14.6869 9.86834V2.20002C14.6869 1.43335 14.0646 0.811119 13.2979 0.811119H11.8479Z" fill=""/>
                                    </svg>
                                    Edit
                                </a>
                            @endcan
                            @can('content.delete')
                                <form method="POST" action="{{ route('admin.article-categories.destroy', $category) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg border border-error-200 bg-error-50 px-4 py-2 text-sm font-medium text-error-600 hover:bg-error-100 dark:border-error-500/20 dark:bg-error-500/10 dark:text-error-500 dark:hover:bg-error-500/20">
                                        <svg class="fill-current" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.2253 2.20002H10.3003V4.44168H12.2253V2.20002ZM4.31798 12.1176H4.89498L10.8593 6.15335L10.2823 5.57635L4.31798 11.5406V12.1176ZM11.8479 0.811119H10.3003H9.11215C8.63658 0.811119 8.25 1.1977 8.25 1.67327V3.40772L3.22511 8.43261C2.98843 8.66929 2.85547 8.99024 2.85547 9.32491V12.6528C2.85547 13.1283 3.24205 13.5149 3.71762 13.5149H7.04547C7.38014 13.5149 7.70109 13.382 7.93777 13.1453L12.9626 8.12039V9.86834C12.9626 10.3439 13.3492 10.7305 13.8248 10.7305C14.3003 10.7305 14.6869 10.3439 14.6869 9.86834V2.20002C14.6869 1.43335 14.0646 0.811119 13.2979 0.811119H11.8479Z" fill=""/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.6667 4H1.33333C0.965143 4 0.666667 4.29848 0.666667 4.66667C0.666667 5.03486 0.965143 5.33333 1.33333 5.33333H2.10219L2.7737 13.3915C2.85261 14.3385 3.6453 15.0667 4.59515 15.0667H11.4049C12.3547 15.0667 13.1474 14.3385 13.2263 13.3915L13.8978 5.33333H14.6667C15.0349 5.33333 15.3333 5.03486 15.3333 4.66667C15.3333 4.29848 15.0349 4 14.6667 4ZM12.5537 5.33333H3.44635L4.10294 13.213C4.12924 13.5285 4.39347 13.7333 4.7102 13.7333H11.2898C11.6065 13.7333 11.8708 13.5285 11.8971 13.213L12.5537 5.33333Z" fill=""/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="flex flex-col items-center justify-center rounded-2xl border border-gray-200 bg-white py-12 dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="mb-4 rounded-full bg-gray-100 p-4 dark:bg-gray-800">
                    <svg class="fill-gray-400 dark:fill-gray-500" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.5 20.25H4.5C3.25736 20.25 2.25 19.2426 2.25 18V6C2.25 4.75736 3.25736 3.75 4.5 3.75H9.23438C9.56586 3.75 9.88378 3.8817 10.1182 4.11612L12.3839 6.38178C12.6183 6.6162 12.9362 6.7479 13.2677 6.7479H19.5C20.7426 6.7479 21.75 7.75526 21.75 9V18C21.75 19.2426 20.7426 20.25 19.5 20.25ZM4.5 5.25C4.08579 5.25 3.75 5.58579 3.75 6V18C3.75 18.4142 4.08579 18.75 4.5 18.75H19.5C19.9142 18.75 20.25 18.4142 20.25 18V9C20.25 8.58579 19.9142 8.25 19.5 8.25H13.2677C12.5344 8.25 11.8313 7.95856 11.3129 7.44012L9.04715 5.17446C8.92994 5.05725 8.77098 4.9914 8.60522 4.9914H4.5V5.25Z" fill=""/>
                        <path d="M16.5 13.5H7.5C7.08579 13.5 6.75 13.1642 6.75 12.75C6.75 12.3358 7.08579 12 7.5 12H16.5C16.9142 12 17.25 12.3358 17.25 12.75C17.25 13.1642 16.9142 13.5 16.5 13.5Z" fill=""/>
                    </svg>
                </div>
                <h3 class="mb-1 text-lg font-semibold text-gray-800 dark:text-white/90">Belum Ada Kategori</h3>
                <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Mulai dengan membuat kategori pertama untuk mengatur artikel Anda.</p>
                @can('content.create')
                    <a href="{{ route('admin.article-categories.create') }}" class="flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 3.75C9.41421 3.75 9.75 4.08579 9.75 4.5V8.25H13.5C13.9142 8.25 14.25 8.58579 14.25 9C14.25 9.41421 13.9142 9.75 13.5 9.75H9.75V13.5C9.75 13.9142 9.41421 14.25 9 14.25C8.58579 14.25 8.25 13.9142 8.25 13.5V9.75H4.5C4.08579 9.75 3.75 9.41421 3.75 9C3.75 8.58579 4.08579 8.25 4.5 8.25H8.25V4.5C8.25 4.08579 8.58579 3.75 9 3.75Z" fill=""/>
                        </svg>
                        Tambah Kategori Pertama
                    </a>
                @endcan
            </div>
        @endforelse
    </div>
@endsection