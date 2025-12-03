@extends('layouts.app')

@section('title', $category->name)

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
                        {{ $category->name }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Category Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body text-center py-4">
                    <h1 class="mb-2">
                        <i class="ti ti-folders me-2"></i>
                        {{ $category->name }}
                    </h1>
                    @if($category->description)
                        <p class="lead mb-0">{{ $category->description }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Category Stats -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <h3 class="mb-0">{{ $articles->total() }}</h3>
                    <p class="mb-0">Total Artikel</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h3 class="mb-0">{{ $category->publishedArticles->count() }}</h3>
                    <p class="mb-0">Artikel Published</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body text-center">
                    <h3 class="mb-0">{{ $category->children->count() }}</h3>
                    <p class="mb-0">Sub-Kategori</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sub-Categories -->
    @if($category->children->count() > 0)
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="ti ti-folders text-primary me-2"></i>
                            Sub-Kategori ({{ $category->children->count() }})
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($category->children as $child)
                                @if($child->publishedArticles->count() > 0)
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="card border-light h-100">
                                            <div class="card-body text-center">
                                                <h5 class="card-title mb-2">
                                                    <a href="{{ route('articles.category', $child) }}"
                                                       class="text-decoration-none text-primary">
                                                        {{ $child->name }}
                                                    </a>
                                                </h5>
                                                <p class="card-text text-muted mb-2">
                                                    {{ $child->publishedArticles->count() }} artikel
                                                </p>
                                                <a href="{{ route('articles.category', $child) }}"
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

    <!-- Articles List -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="mb-0">
                                <i class="ti ti-file-text text-primary me-2"></i>
                                Artikel dalam Kategori ini
                            </h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <!-- Search Form -->
                            <form method="GET" action="{{ route('articles.search') }}" class="d-flex">
                                <input type="hidden" name="category" value="{{ $category->id }}">
                                <input type="text" name="q" class="form-control me-2"
                                       placeholder="Cari artikel dalam kategori ini..." value="{{ request('q') }}">
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
                            <p class="text-muted mb-4">
                                Maaf, belum ada artikel dalam kategori "{{ $category->name }}" yang tersedia saat ini.
                            </p>
                            <a href="{{ route('articles.index') }}" class="btn btn-primary">
                                <i class="ti ti-arrow-left"></i> Kembali ke Daftar Artikel
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