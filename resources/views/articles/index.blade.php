@extends('layouts.app')

@section('title', 'Berita & Artikel')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Hero Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body text-center py-5">
                    <h1 class="mb-3">Berita & Artikel</h1>
                    <p class="lead mb-0">Temukan informasi terbaru dan wawasan mendalam dari tim kami</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Articles -->
    @if($featuredArticles->count() > 0)
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="ti ti-star text-warning me-2"></i>
                            Artikel Unggulan
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($featuredArticles as $article)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        @if($article->featured_image)
                                            <div class="card-img-top">
                                                <img src="{{ asset('storage/' . $article->featured_image) }}"
                                                     class="card-img-top" alt="{{ $article->title }}"
                                                     style="height: 200px; object-fit: cover; width: 100%;">
                                            </div>
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">
                                                <a href="{{ route('articles.show', $article) }}" class="text-decoration-none text-dark">
                                                    {{ \Illuminate\Support\Str::limit($article->title, 60) }}
                                                </a>
                                            </h5>
                                            @if($article->excerpt)
                                                <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($article->excerpt, 120) }}</p>
                                            @endif
                                            <div class="mt-auto">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
                                                        <i class="ti ti-calendar"></i>
                                                        {{ $article->published_at->format('d M Y') }}
                                                    </small>
                                                    @if($article->category)
                                                        <span class="badge bg-info">{{ $article->category->name }}</span>
                                                    @endif
                                                </div>
                                                <div class="mt-2">
                                                    <a href="{{ route('articles.show', $article) }}" class="btn btn-primary btn-sm">
                                                        Baca Selengkapnya
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Categories -->
    @if($categories->count() > 0)
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="ti ti-folders text-info me-2"></i>
                            Kategori
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($categories as $category)
                                @if($category->published_articles_count > 0)
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="card border-light h-100">
                                            <div class="card-body text-center">
                                                <h5 class="card-title mb-2">
                                                    <a href="{{ route('articles.category', $category) }}"
                                                       class="text-decoration-none text-primary">
                                                        {{ $category->name }}
                                                    </a>
                                                </h5>
                                                <p class="card-text text-muted mb-2">
                                                    {{ $category->published_articles_count }} artikel
                                                </p>
                                                <a href="{{ route('articles.category', $category) }}"
                                                   class="btn btn-outline-primary btn-sm">
                                                    Lihat Semua
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- All Articles -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="mb-0">
                                <i class="ti ti-file-text text-primary me-2"></i>
                                Semua Artikel
                            </h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <!-- Search Form -->
                            <form method="GET" action="{{ route('articles.search') }}" class="d-flex">
                                <input type="text" name="q" class="form-control me-2"
                                       placeholder="Cari artikel..." value="{{ request('q') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($articles as $article)
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="row g-0">
                                        @if($article->featured_image)
                                            <div class="col-md-4">
                                                <img src="{{ asset('storage/' . $article->featured_image) }}"
                                                     class="img-fluid rounded-start" alt="{{ $article->title }}"
                                                     style="height: 200px; object-fit: cover; width: 100%;">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <a href="{{ route('articles.show', $article) }}"
                                                           class="text-decoration-none text-dark">
                                                            {{ $article->title }}
                                                        </a>
                                                    </h5>
                                                    @if($article->excerpt)
                                                        <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($article->excerpt, 150) }}</p>
                                                    @endif
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">
                                                            <i class="ti ti-user"></i>
                                                            {{ $article->author->name }} •
                                                            <i class="ti ti-calendar"></i>
                                                            {{ $article->published_at->format('d M Y') }}
                                                        </small>
                                                        <div>
                                                            @if($article->category)
                                                                <span class="badge bg-info me-1">{{ $article->category->name }}</span>
                                                            @endif
                                                            @if($article->is_featured)
                                                                <span class="badge bg-warning"><i class="ti ti-star"></i></span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-12">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <a href="{{ route('articles.show', $article) }}"
                                                           class="text-decoration-none text-dark">
                                                            {{ $article->title }}
                                                        </a>
                                                    </h5>
                                                    @if($article->excerpt)
                                                        <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($article->excerpt, 150) }}</p>
                                                    @endif
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">
                                                            <i class="ti ti-user"></i>
                                                            {{ $article->author->name }} •
                                                            <i class="ti ti-calendar"></i>
                                                            {{ $article->published_at->format('d M Y') }}
                                                        </small>
                                                        <div>
                                                            @if($article->category)
                                                                <span class="badge bg-info me-1">{{ $article->category->name }}</span>
                                                            @endif
                                                            @if($article->is_featured)
                                                                <span class="badge bg-warning"><i class="ti ti-star"></i></span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Sidebar -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Informasi Artikel</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <strong>Penulis:</strong><br>
                                            <span>{{ $article->author->name }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <strong>Dipublikasikan:</strong><br>
                                            <span>{{ $article->published_at->format('d F Y H:i') }}</span>
                                        </div>
                                        @if($article->category)
                                            <div class="mb-3">
                                                <strong>Kategori:</strong><br>
                                                <span>{{ $article->category->name }}</span>
                                            </div>
                                        @endif
                                        <div>
                                            <a href="{{ route('articles.show', $article) }}" class="btn btn-primary btn-sm w-100">
                                                <i class="ti ti-eye"></i> Baca Selengkapnya
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="ti ti-file-off text-muted mb-3" style="font-size: 3rem;"></i>
                            <h4 class="text-muted mb-3">Belum Ada Artikel</h4>
                            <p class="text-muted mb-4">Maaf, belum ada artikel yang tersedia saat ini.</p>
                            <a href="{{ route('welcome') }}" class="btn btn-primary">
                                <i class="ti ti-home"></i> Kembali ke Beranda
                            </a>
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    @if($articles->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $articles->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection