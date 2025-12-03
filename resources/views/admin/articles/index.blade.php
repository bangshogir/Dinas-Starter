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
                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 3.75C9.41421 3.75 9.75 4.08579 9.75 4.5V8.25H13.5C13.9142 8.25 14.25 8.58579 14.25 9C14.25 9.41421 13.9142 9.75 13.5 9.75H9.75V13.5C9.75 13.9142 9.41421 14.25 9 14.25C8.58579 14.25 8.25 13.9142 8.25 13.5V9.75H4.5C4.08579 9.75 3.75 9.41421 3.75 9C3.75 8.58579 4.08579 8.25 4.5 8.25H8.25V4.5C8.25 4.08579 8.58579 3.75 9 3.75Z" fill=""/>
                </svg>
                Tambah Artikel
            </a>
        @endcan
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
        <!-- Filter Section -->
        <form method="GET" action="{{ route('admin.articles.index') }}" class="mb-6">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-12">
                <!-- Search -->
                <div class="lg:col-span-4">
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Pencarian
                    </label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul..."
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                </div>

                <!-- Status -->
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Status
                    </label>
                    <div class="relative z-20 bg-transparent dark:bg-dark-900">
                        <select name="status"
                            class="relative z-20 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            <option value="">Semua</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.99922 12.8249C8.83047 12.8249 8.68984 12.7687 8.54922 12.6562L2.08047 6.2999C1.82734 6.04678 1.82734 5.65303 2.08047 5.3999C2.33359 5.14678 2.72734 5.14678 2.98047 5.3999L8.99922 11.278L15.018 5.3999C15.2711 5.14678 15.6648 5.14678 15.918 5.3999C16.1711 5.65303 16.1711 6.04678 15.918 6.2999L9.44922 12.6562C9.30859 12.7687 9.16797 12.8249 8.99922 12.8249Z" fill="" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Kategori -->
                <div class="lg:col-span-3">
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Kategori
                    </label>
                    <div class="relative z-20 bg-transparent dark:bg-dark-900">
                        <select name="category"
                            class="relative z-20 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            <option value="">Semua</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.99922 12.8249C8.83047 12.8249 8.68984 12.7687 8.54922 12.6562L2.08047 6.2999C1.82734 6.04678 1.82734 5.65303 2.08047 5.3999C2.33359 5.14678 2.72734 5.14678 2.98047 5.3999L8.99922 11.278L15.018 5.3999C15.2711 5.14678 15.6648 5.14678 15.918 5.3999C16.1711 5.65303 16.1711 6.04678 15.918 6.2999L9.44922 12.6562C9.30859 12.7687 9.16797 12.8249 8.99922 12.8249Z" fill="" />
                            </svg>
                        </span>
                    </div>
                </div>
                
                <!-- Featured -->
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Featured
                    </label>
                    <div class="relative z-20 bg-transparent dark:bg-dark-900">
                        <select name="featured"
                            class="relative z-20 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            <option value="">Semua</option>
                            <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Ya</option>
                            <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.99922 12.8249C8.83047 12.8249 8.68984 12.7687 8.54922 12.6562L2.08047 6.2999C1.82734 6.04678 1.82734 5.65303 2.08047 5.3999C2.33359 5.14678 2.72734 5.14678 2.98047 5.3999L8.99922 11.278L15.018 5.3999C15.2711 5.14678 15.6648 5.14678 15.918 5.3999C16.1711 5.65303 16.1711 6.04678 15.918 6.2999L9.44922 12.6562C9.30859 12.7687 9.16797 12.8249 8.99922 12.8249Z" fill="" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Button -->
                <div class="lg:col-span-1">
                    <label class="mb-2 block text-sm font-medium text-transparent">
                        Aksi
                    </label>
                    <button type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.25 3C8.25 2.58579 8.58579 2.25 9 2.25C9.41421 2.25 9.75 2.58579 9.75 3V7.5H14.25C14.6642 7.5 15 7.83579 15 8.25C15 8.66421 14.6642 9 14.25 9H9.75V13.5C9.75 13.9142 9.41421 14.25 9 14.25C8.58579 14.25 8.25 13.9142 8.25 13.5V9H3.75C3.33579 9 3 8.66421 3 8.25C3 7.83579 3.33579 7.5 3.75 7.5H8.25V3Z" fill=""/>
                        </svg>
                        Cari
                    </button>
                </div>
            </div>
        </form>

        <!-- Table -->
        <div class="max-w-full overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50 text-left dark:bg-white/[0.03]">
                        <th class="min-w-[220px] px-4 py-4 font-medium text-gray-500 dark:text-gray-400 xl:pl-11">Judul</th>
                        <th class="min-w-[150px] px-4 py-4 font-medium text-gray-500 dark:text-gray-400">Kategori</th>
                        <th class="min-w-[120px] px-4 py-4 font-medium text-gray-500 dark:text-gray-400">Author</th>
                        <th class="min-w-[120px] px-4 py-4 font-medium text-gray-500 dark:text-gray-400">Status</th>
                        <th class="px-4 py-4 font-medium text-gray-500 dark:text-gray-400">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                        <tr>
                            <td class="border-b border-gray-100 px-4 py-5 pl-9 dark:border-gray-800 xl:pl-11">
                                <h5 class="font-medium text-gray-800 dark:text-white/90">{{ Str::limit($article->title, 50) }}</h5>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($article->excerpt, 60) }}</p>
                                @if($article->is_featured)
                                    <span class="mt-1 inline-flex items-center gap-1 rounded-full bg-warning-50 px-2 py-0.5 text-xs font-medium text-warning-600 dark:bg-warning-500/15 dark:text-warning-500">
                                        Featured
                                    </span>
                                @endif
                            </td>
                            <td class="border-b border-gray-100 px-4 py-5 dark:border-gray-800">
                                <p class="text-gray-500 dark:text-gray-400">{{ $article->category->name ?? '-' }}</p>
                            </td>
                            <td class="border-b border-gray-100 px-4 py-5 dark:border-gray-800">
                                <p class="text-gray-500 dark:text-gray-400">{{ $article->author->name }}</p>
                            </td>
                            <td class="border-b border-gray-100 px-4 py-5 dark:border-gray-800">
                                @if($article->status == 'published')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-success-50 px-2 py-0.5 text-xs font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                                        <span class="h-1.5 w-1.5 rounded-full bg-success-600 dark:bg-success-500"></span>
                                        Published
                                    </span>
                                @elseif($article->status == 'draft')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-warning-50 px-2 py-0.5 text-xs font-medium text-warning-600 dark:bg-warning-500/15 dark:text-warning-500">
                                        <span class="h-1.5 w-1.5 rounded-full bg-warning-600 dark:bg-warning-500"></span>
                                        Draft
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-50 px-2 py-0.5 text-xs font-medium text-gray-600 dark:bg-gray-500/15 dark:text-gray-500">
                                        <span class="h-1.5 w-1.5 rounded-full bg-gray-600 dark:bg-gray-500"></span>
                                        Archived
                                    </span>
                                @endif
                            </td>
                            <td class="border-b border-gray-100 px-4 py-5 dark:border-gray-800">
                                <div class="flex items-center space-x-3.5">
                                    <a href="{{ route('admin.articles.show', $article) }}" class="hover:text-primary">
                                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.99981 14.8219C13.4184 14.8219 16.7531 11.2246 17.4451 10.0248C17.7626 9.47414 17.7626 8.52585 17.4451 7.97516C16.7531 6.77534 13.4184 3.17812 8.99981 3.17812C4.58122 3.17812 1.24652 6.77534 0.554516 7.97516C0.237037 8.52585 0.237037 9.47414 0.554516 10.0248C1.24652 11.2246 4.58122 14.8219 8.99981 14.8219ZM8.99981 12.8219C11.332 12.8219 13.2229 10.931 13.2229 8.59875C13.2229 6.26652 11.332 4.37562 8.99981 4.37562C6.66763 4.37562 4.77669 6.26652 4.77669 8.59875C4.77669 10.931 6.66763 12.8219 8.99981 12.8219ZM8.99981 11.0219C10.338 11.0219 11.4229 9.93694 11.4229 8.59875C11.4229 7.26056 10.338 6.17562 8.99981 6.17562C7.66163 6.17562 6.57669 7.26056 6.57669 8.59875C6.57669 9.93694 7.66163 11.0219 8.99981 11.0219Z" fill=""/>
                                        </svg>
                                    </a>
                                    @can('articles.update')
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="hover:text-primary">
                                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.7535 2.47502H11.5879V4.9969H13.7535V2.47502ZM4.85773 13.6323H5.50685L12.2166 6.92255L11.5675 6.27345L4.85773 12.9832V13.6323ZM13.3289 0.912537H11.5879H10.2512C9.71618 0.912537 9.28125 1.34747 9.28125 1.8825V3.83376L3.62823 9.48677C3.36197 9.75303 3.2124 10.1141 3.2124 10.4906V14.2344C3.2124 14.7694 3.64734 15.2044 4.18237 15.2044H7.92613C8.30266 15.2044 8.66373 15.0548 8.93 14.7885L14.583 9.13549V11.1019C14.583 11.6369 15.018 12.0719 15.553 12.0719C16.088 12.0719 16.523 11.6369 16.523 11.1019V2.47502C16.523 1.61252 15.823 0.912537 14.9605 0.912537H13.3289Z" fill=""/>
                                            </svg>
                                        </a>
                                    @endcan
                                    @can('articles.delete')
                                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="hover:text-error-500">
                                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.7535 2.47502H11.5879V4.9969H13.7535V2.47502ZM4.85773 13.6323H5.50685L12.2166 6.92255L11.5675 6.27345L4.85773 12.9832V13.6323ZM13.3289 0.912537H11.5879H10.2512C9.71618 0.912537 9.28125 1.34747 9.28125 1.8825V3.83376L3.62823 9.48677C3.36197 9.75303 3.2124 10.1141 3.2124 10.4906V14.2344C3.2124 14.7694 3.64734 15.2044 4.18237 15.2044H7.92613C8.30266 15.2044 8.66373 15.0548 8.93 14.7885L14.583 9.13549V11.1019C14.583 11.6369 15.018 12.0719 15.553 12.0719C16.088 12.0719 16.523 11.6369 16.523 11.1019V2.47502C16.523 1.61252 15.823 0.912537 14.9605 0.912537H13.3289Z" fill=""/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5 4.5H1.5C1.08579 4.5 0.75 4.83579 0.75 5.25C0.75 5.66421 1.08579 6 1.5 6H2.36496L3.12041 15.0654C3.20919 16.1308 4.10096 16.95 5.16954 16.95H12.8305C13.899 16.95 14.7908 16.1308 14.8796 15.0654L15.635 6H16.5C16.9142 6 17.25 5.66421 17.25 5.25C17.25 4.83579 16.9142 4.5 16.5 4.5ZM14.1229 6H3.87714L4.61581 14.8646C4.64539 15.2196 4.94265 15.45 5.29898 15.45H12.701C13.0573 15.45 13.3546 15.2196 13.3842 14.8646L14.1229 6Z" fill=""/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="mb-4 rounded-full bg-gray-100 p-4 dark:bg-gray-800">
                                        <svg class="fill-gray-400 dark:fill-gray-500" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 2C8.26801 2 2 8.26801 2 16C2 23.732 8.26801 30 16 30C23.732 30 30 23.732 30 16C30 8.26801 23.732 2 16 2ZM16 28C9.37258 28 4 22.6274 4 16C4 9.37258 9.37258 4 16 4C22.6274 4 28 9.37258 28 16C28 22.6274 22.6274 28 16 28Z" fill=""/>
                                            <path d="M16 8C15.4477 8 15 8.44772 15 9V15H9C8.44772 15 8 15.4477 8 16C8 16.5523 8.44772 17 9 17H15V23C15 23.5523 15.4477 24 16 24C16.5523 24 17 23.5523 17 23V17H23C23.5523 17 24 16.5523 24 16C24 15.4477 23.5523 15 23 15H17V9C17 8.44772 16.5523 8 16 8Z" fill=""/>
                                        </svg>
                                    </div>
                                    <h3 class="mb-1 text-lg font-semibold text-gray-800 dark:text-white/90">Belum ada artikel</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Mulai dengan membuat artikel baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $articles->links() }}
        </div>
    </div>
@endsection