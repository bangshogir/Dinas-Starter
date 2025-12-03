@extends('layouts.app')

@section('title', 'Pencarian Artikel: ' . $query)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Breadcrumb -->
    <div class="row mb-3">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('welcome') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('articles.index') }}">Artikel</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Pencarian
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Search Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body text-center py-4">
                    <h1 class="mb-3">
                        <i class="ti ti-search me-2"></i>
                        Hasil Pencarian
                    </h1>
                    <p class="lead mb-0">
                        Menampilkan {{ $articles->total() }} hasil untuk query: <strong>"{{ $query }}"</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Form -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('articles.search') }}" class="row g-3">
                        <div class="col-md-10">
                            <input type="text" name="q" class="form-control"
                                   placeholder="Cari artikel..." value="{{ $query }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ti ti-search"></i> Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Results -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="ti ti-file-text text-primary me-2"></i>
                        Hasil Pencarian ({{ $articles->count() }} dari {{ $articles->total() }})
                    </h4>
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
                            <i class="ti ti-search-off text-muted mb-3" style="font-size: 3rem;"></i>
                            <h4 class="text-muted mb-3">Tidak Ada Hasil</h4>
                            <p class="text-muted mb-4">
                                Maaf, tidak ada artikel yang ditemukan untuk query "<strong>{{ $query }}</strong>".
                            </p>
                            <div class="mb-4">
                                <h5 class="text-muted mb-3">Saran:</h5>
                                <ul class="text-start text-muted">
                                    <li class="mb-2">
                                        <i class="ti ti-check text-success"></i>
                                        Periksa ejaan kata kunci Anda
                                    </li>
                                    <li class="mb-2">
                                        <i class="ti ti-check text-success"></i>
                                        Gunakan kata kunci yang lebih umum
                                    </li>
                                    <li class="mb-2">
                                        <i class="ti ti-check text-success"></i>
                                        Coba dengan kata kunci yang berbeda
                                    </li>
                                    <li class="mb-0">
                                        <i class="ti ti-check text-success"></i>
                                        Kurangi filter atau kategori
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <a href="{{ route('articles.search') }}" class="btn btn-secondary me-2">
                                    <i class="ti ti-arrow-left"></i> Kembali ke Pencarian
                                </a>
                                <a href="{{ route('articles.index') }}" class="btn btn-primary">
                                    <i class="ti ti-list"></i> Lihat Semua Artikel
                                </a>
                            </div>
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