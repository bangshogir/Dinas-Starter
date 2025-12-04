@extends('layouts.admin')

@section('title', 'Detail Artikel: ' . $article->title)

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Detail Artikel
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium" href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li><a class="font-medium" href="{{ route('admin.articles.index') }}">Artikel /</a></li>
                    <li class="font-medium text-primary">Detail</li>
                </ol>
            </nav>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.articles.index') }}"
                class="flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11.0203 3.51583C11.1996 3.33653 11.2761 3.0788 11.2238 2.8307C11.1714 2.5826 11.0026 2.37048 10.7601 2.27996C10.5176 2.18944 10.2483 2.23846 10.0518 2.40905L3.42681 8.15905C3.16006 8.39054 3.00003 8.7366 3.00003 9.10006C3.00003 9.46352 3.16006 9.80959 3.42681 10.0411L10.0518 15.7911C10.2483 15.9617 10.5176 16.0107 10.7601 15.9202C11.0026 15.8296 11.1714 15.6175 11.2238 15.3694C11.2761 15.1213 11.1996 14.8636 11.0203 14.6843L5.47163 9.86881L14.25 9.86881C14.6642 9.86881 15 9.53302 15 9.11881C15 8.7046 14.6642 8.36881 14.25 8.36881L5.47163 8.36881L11.0203 3.51583Z"
                        fill="" />
                </svg>
                Kembali
            </a>
            @can('articles.update')
                <a href="{{ route('admin.articles.edit', $article) }}"
                    class="flex w-full items-center justify-center gap-2 rounded-full bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600 sm:w-auto">
                    <x-heroicon-o-pencil class="w-5 h-5" />
                    Edit Artikel
                </a>
            @endcan
        </div>
    </div>

    <div class="grid grid-cols-1 gap-9 lg:grid-cols-3">
        <!-- Left Column: Article Content -->
        <div class="flex flex-col gap-9 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                <!-- Article Header -->
                <div class="mb-6 border-b border-gray-200 pb-6 dark:border-gray-800">
                    <h1 class="mb-4 text-2xl font-bold text-gray-800 dark:text-white/90 sm:text-3xl">
                        {{ $article->title }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                        <div class="flex items-center gap-2">
                            <svg class="fill-current" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.3333 2.66667H12.6667V1.33333H11.3333V2.66667H4.66667V1.33333H3.33333V2.66667H2.66667C1.93333 2.66667 1.33333 3.26667 1.33333 4V14.6667C1.33333 15.4 1.93333 16 2.66667 16H13.3333C14.0667 16 14.6667 15.4 14.6667 14.6667V4C14.6667 3.26667 14.0667 2.66667 13.3333 2.66667ZM13.3333 14.6667H2.66667V5.33333H13.3333V14.6667Z"
                                    fill="" />
                            </svg>
                            {{ $article->published_at ? $article->published_at->format('d F Y H:i') : 'Belum dipublikasikan' }}
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="fill-current" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 8C10.21 8 12 6.21 12 4C12 1.79 10.21 0 8 0C5.79 0 4 1.79 4 4C4 6.21 5.79 8 8 8ZM8 2C9.1 2 10 2.9 10 4C10 5.1 9.1 6 8 6C6.9 6 6 5.1 6 4C6 2.9 6.9 2 8 2ZM8 10C5.33 10 0 11.34 0 14V16H16V14C16 11.34 10.67 10 8 10ZM2 14C2.22 13.28 5.31 12 8 12C10.69 12 13.78 13.28 14 14H2Z"
                                    fill="" />
                            </svg>
                            {{ $article->author->name }}
                        </div>
                        @if($article->category)
                            <div class="flex items-center gap-2">
                                <svg class="fill-current" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.3333 2.66667H8.66667L7.33333 1.33333H2.66667C1.93333 1.33333 1.33333 1.93333 1.33333 2.66667V13.3333C1.33333 14.0667 1.93333 14.6667 2.66667 14.6667H13.3333C14.0667 14.6667 14.6667 14.0667 14.6667 13.3333V4C14.6667 3.26667 14.0667 2.66667 13.3333 2.66667ZM13.3333 13.3333H2.66667V4H13.3333V13.3333Z"
                                        fill="" />
                                </svg>
                                {{ $article->category->name }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Featured Image -->
                @if($article->featured_image)
                    <div class="mb-6 overflow-hidden rounded-xl">
                        <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}"
                            class="w-full object-cover">
                    </div>
                @endif

                <!-- Excerpt -->
                @if($article->excerpt)
                    <div
                        class="mb-6 rounded-lg border border-brand-100 bg-brand-50 p-4 text-brand-900 dark:border-brand-500/20 dark:bg-brand-500/10 dark:text-brand-100">
                        <p class="font-medium">{{ $article->excerpt }}</p>
                    </div>
                @endif

                <!-- Content -->
                <div class="prose max-w-none dark:prose-invert">
                    {!! $article->content !!}
                </div>
            </div>
        </div>

        <!-- Right Column: Sidebar -->
        <div class="flex flex-col gap-9 lg:col-span-1">
            <!-- Quick Actions -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Aksi Cepat</h3>

                <div class="flex flex-col gap-3">
                    @can('articles.update')
                        <form method="POST" action="{{ route('admin.articles.publish', $article) }}">
                            @csrf
                            <button type="submit"
                                class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                @if($article->status == 'published')
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.25 1.5H3.75C2.50736 1.5 1.5 2.50736 1.5 3.75V14.25C1.5 15.4926 2.50736 16.5 3.75 16.5H14.25C15.4926 16.5 16.5 15.4926 16.5 14.25V3.75C16.5 2.50736 15.4926 1.5 14.25 1.5ZM6.75 12.75H5.25V5.25H6.75V12.75ZM12.75 12.75H11.25V5.25H12.75V12.75Z"
                                            fill="" />
                                    </svg>
                                    Arsipkan
                                @else
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.25 1.5H3.75C2.50736 1.5 1.5 2.50736 1.5 3.75V14.25C1.5 15.4926 2.50736 16.5 3.75 16.5H14.25C15.4926 16.5 16.5 15.4926 16.5 14.25V3.75C16.5 2.50736 15.4926 1.5 14.25 1.5ZM6.75 5.25L12.75 9L6.75 12.75V5.25Z"
                                            fill="" />
                                    </svg>
                                    Publikasikan
                                @endif
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.articles.featured', $article) }}">
                            @csrf
                            <button type="submit"
                                class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                @if($article->is_featured)
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9 1.5L11.3175 6.195L16.5 6.9525L12.75 10.605L13.635 15.765L9 13.3275L4.365 15.765L5.25 10.605L1.5 6.9525L6.6825 6.195L9 1.5ZM9 4.17L7.5825 7.0425L4.41 7.5075L6.705 9.7425L6.165 12.9L9 11.4075L11.835 12.9L11.295 9.7425L13.59 7.5075L10.4175 7.0425L9 4.17Z"
                                            fill="" />
                                    </svg>
                                    Hapus Featured
                                @else
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9 1.5L11.3175 6.195L16.5 6.9525L12.75 10.605L13.635 15.765L9 13.3275L4.365 15.765L5.25 10.605L1.5 6.9525L6.6825 6.195L9 1.5Z"
                                            fill="" />
                                    </svg>
                                    Jadikan Featured
                                @endif
                            </button>
                        </form>
                    @endcan

                    @can('articles.delete')
                        <form method="POST" action="{{ route('admin.articles.destroy', $article) }}"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex w-full items-center justify-center gap-2 rounded-lg border border-error-200 bg-error-50 px-4 py-2.5 text-sm font-medium text-error-600 hover:bg-error-100 dark:border-error-500/20 dark:bg-error-500/10 dark:text-error-500 dark:hover:bg-error-500/20">
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.7535 2.47502H11.5879V4.9969H13.7535V2.47502ZM4.85773 13.6323H5.50685L12.2166 6.92255L11.5675 6.27345L4.85773 12.9832V13.6323ZM13.3289 0.912537H11.5879H10.2512C9.71618 0.912537 9.28125 1.34747 9.28125 1.8825V3.83376L3.62823 9.48677C3.36197 9.75303 3.2124 10.1141 3.2124 10.4906V14.2344C3.2124 14.7694 3.64734 15.2044 4.18237 15.2044H7.92613C8.30266 15.2044 8.66373 15.0548 8.93 14.7885L14.583 9.13549V11.1019C14.583 11.6369 15.018 12.0719 15.553 12.0719C16.088 12.0719 16.523 11.6369 16.523 11.1019V2.47502C16.523 1.61252 15.823 0.912537 14.9605 0.912537H13.3289Z"
                                        fill="" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16.5 4.5H1.5C1.08579 4.5 0.75 4.83579 0.75 5.25C0.75 5.66421 1.08579 6 1.5 6H2.36496L3.12041 15.0654C3.20919 16.1308 4.10096 16.95 5.16954 16.95H12.8305C13.899 16.95 14.7908 16.1308 14.8796 15.0654L15.635 6H16.5C16.9142 6 17.25 5.66421 17.25 5.25C17.25 4.83579 16.9142 4.5 16.5 4.5ZM14.1229 6H3.87714L4.61581 14.8646C4.64539 15.2196 4.94265 15.45 5.29898 15.45H12.701C13.0573 15.45 13.3546 15.2196 13.3842 14.8646L14.1229 6Z"
                                        fill="" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    @endcan

                    <a href="{{ route('articles.show', $article) }}" target="_blank"
                        class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.5 1.5C10.5 1.08579 10.8358 0.75 11.25 0.75H16.5C16.9142 0.75 17.25 1.08579 17.25 1.5V6.75C17.25 7.16421 16.9142 7.5 16.5 7.5C16.0858 7.5 15.75 7.16421 15.75 6.75V3.31066L9.53033 9.53033C9.23744 9.82322 8.76256 9.82322 8.46967 9.53033C8.17678 9.23744 8.17678 8.76256 8.46967 8.46967L14.6893 2.25H11.25C10.8358 2.25 10.5 1.91421 10.5 1.5Z"
                                fill="" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3 3C2.17157 3 1.5 3.67157 1.5 4.5V15C1.5 15.8284 2.17157 16.5 3 16.5H13.5C14.3284 16.5 15 15.8284 15 15V9.75C15 9.33579 15.3358 9 15.75 9C16.1642 9 16.5 9.33579 16.5 9.75V15C16.5 16.6569 15.1569 18 13.5 18H3C1.34315 18 0 16.6569 0 15V4.5C0 2.84315 1.34315 1.5 3 1.5H8.25C8.66421 1.5 9 1.83579 9 2.25C9 2.66421 8.66421 3 8.25 3H3Z"
                                fill="" />
                        </svg>
                        Lihat di Publik
                    </a>
                </div>
            </div>

            <!-- Article Info -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Informasi Artikel</h3>

                <div class="flex flex-col gap-4">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Status</span>
                        {!! $article->statusBadge !!}
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Featured</span>
                        @if($article->is_featured)
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-warning-50 px-2 py-0.5 text-xs font-medium text-warning-600 dark:bg-warning-500/15 dark:text-warning-500">
                                Ya
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-gray-50 px-2 py-0.5 text-xs font-medium text-gray-600 dark:bg-gray-500/15 dark:text-gray-500">
                                Tidak
                            </span>
                        @endif
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Dibuat</span>
                        <span
                            class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $article->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Diupdate</span>
                        <span
                            class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $article->updated_at->format('d M Y H:i') }}</span>
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
                        <input type="text" value="{{ route('articles.show', $article) }}" readonly
                            class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm text-gray-800 outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                        <button onclick="copyUrl('{{ route('articles.show', $article) }}')"
                            class="absolute right-2 top-1/2 -translate-y-1/2 rounded-md p-1.5 text-gray-500 hover:bg-gray-200 dark:text-gray-400 dark:hover:bg-gray-800">
                            <svg class="fill-current" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.6667 1.33333H2.66667C1.93333 1.33333 1.33333 1.93333 1.33333 2.66667V10.6667H2.66667V2.66667H10.6667V1.33333ZM12.6667 4H5.33333C4.6 4 4 4.6 4 5.33333V13.3333C4 14.0667 4.6 14.6667 5.33333 14.6667H12.6667C13.4 14.6667 14 14.0667 14 13.3333V5.33333C14 4.6 13.4 4 12.6667 4ZM12.6667 13.3333H5.33333V5.33333H12.6667V13.3333Z"
                                    fill="" />
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
            navigator.clipboard.writeText(url).then(function () {
                // Optional: Show toast notification
                alert('URL berhasil disalin!');
            });
        }
    </script>
@endpush