@extends('layouts.app')

@section('title', $article->title)

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
                    @if($article->category)
                        <li class="breadcrumb-item">
                            <a href="{{ route('articles.category', $article->category) }}">
                                {{ $article->category->name }}
                            </a>
                        </li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ \Illuminate\Support\Str::limit($article->title, 50) }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Article Content -->
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <!-- Article Header -->
                    <div class="mb-4">
                        <h1 class="display-5 fw-bold mb-3">{{ $article->title }}</h1>

                        <!-- Meta Information -->
                        <div class="d-flex flex-wrap align-items-center text-muted mb-3">
                            <div class="me-3">
                                <i class="ti ti-user me-1"></i>
                                <span>{{ $article->author->name }}</span>
                            </div>
                            <div class="me-3">
                                <i class="ti ti-calendar me-1"></i>
                                <span>{{ $article->published_at->format('d F Y') }}</span>
                            </div>
                            @if($article->category)
                                <div class="me-3">
                                    <i class="ti ti-folders me-1"></i>
                                    <a href="{{ route('articles.category', $article->category) }}"
                                       class="text-decoration-none text-muted">
                                        {{ $article->category->name }}
                                    </a>
                                </div>
                            @endif
                            @if($article->is_featured)
                                <div class="me-3">
                                    <span class="badge bg-warning">
                                        <i class="ti ti-star"></i> Featured
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Featured Image -->
                    @if($article->featured_image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $article->featured_image) }}"
                                 class="img-fluid rounded" alt="{{ $article->title }}">
                        </div>
                    @endif

                    <!-- Article Content -->
                    <div class="content">
                        {!! $article->content !!}
                    </div>

                    <!-- Article Footer -->
                    <div class="border-top pt-4 mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                <small>
                                    Dipublikasikan pada {{ $article->published_at->format('d F Y H:i') }}
                                    @if($article->updated_at != $article->created_at)
                                        • Diupdate pada {{ $article->updated_at->format('d F Y H:i') }}
                                    @endif
                                </small>
                            </div>
                            <div class="d-flex gap-2">
                                <!-- Share Buttons -->
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="ti ti-share"></i> Bagikan
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="shareOnFacebook()">
                                                <i class="ti ti-brand-facebook text-primary"></i> Facebook
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="shareOnTwitter()">
                                                <i class="ti ti-brand-twitter text-info"></i> Twitter
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="shareOnWhatsApp()">
                                                <i class="ti ti-brand-whatsapp text-success"></i> WhatsApp
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="copyArticleUrl()">
                                                <i class="ti ti-copy"></i> Salin Link
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Author Info -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Penulis</h6>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="avatar avatar-lg bg-primary text-white">
                            {{ strtoupper(substr($article->author->name, 0, 1)) }}
                        </div>
                    </div>
                    <h6 class="mb-1">{{ $article->author->name }}</h6>
                    <p class="text-muted small mb-0">
                        Penulis di {{ $article->published_at->format('F Y') }}
                    </p>
                </div>
            </div>

            <!-- Table of Contents (if needed) -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Daftar Isi</h6>
                </div>
                <div class="card-body">
                    <nav id="table-of-contents">
                        <div class="text-muted small">
                            Daftar isi akan muncul otomatis jika artikel memiliki heading.
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Related Articles -->
            @if($relatedArticles->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Artikel Terkait</h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @foreach($relatedArticles as $relatedArticle)
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">
                                                <a href="{{ route('articles.show', $relatedArticle) }}"
                                                   class="text-decoration-none text-dark">
                                                    {{ \Illuminate\Support\Str::limit($relatedArticle->title, 50) }}
                                                </a>
                                            </h6>
                                            <small class="text-muted">
                                                {{ $relatedArticle->published_at->format('d M Y') }}
                                            </small>
                                        </div>
                                        @if($relatedArticle->featured_image)
                                            <img src="{{ asset('storage/' . $relatedArticle->featured_image) }}"
                                                 class="rounded ms-2" alt="{{ $relatedArticle->title }}"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Back to Articles -->
            <div class="card">
                <div class="card-body text-center">
                    <a href="{{ route('articles.index') }}" class="btn btn-primary w-100">
                        <i class="ti ti-arrow-left"></i> Kembali ke Daftar Artikel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Share functions
function shareOnFacebook() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${title}`, '_blank');
}

function shareOnTwitter() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    window.open(`https://twitter.com/intent/tweet?text=${title}&url=${url}`, '_blank');
}

function shareOnWhatsApp() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    window.open(`https://wa.me/?text=${title}%20${url}`, '_blank');
}

function copyArticleUrl() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        // Show success message
        const button = event.target.closest('button');
        const originalHtml = button.innerHTML;
        button.innerHTML = '<i class="ti ti-check"></i> Tersalin!';
        button.classList.add('btn-success');

        setTimeout(function() {
            button.innerHTML = originalHtml;
            button.classList.remove('btn-success');
        }, 2000);
    });
}

// Generate table of contents
function generateTableOfContents() {
    const content = document.querySelector('.content');
    const tocContainer = document.getElementById('table-of-contents');

    if (!content || !tocContainer) return;

    const headings = content.querySelectorAll('h2, h3, h4, h5, h6');

    if (headings.length === 0) {
        tocContainer.innerHTML = '<div class="text-muted small">Tidak ada heading dalam artikel ini.</div>';
        return;
    }

    let tocHTML = '<ul class="list-unstyled mb-0">';

    headings.forEach((heading, index) => {
        const id = heading.id || `heading-${index}`;
        heading.id = id;

        const level = parseInt(heading.tagName.substring(1));
        const indent = 'ms-' + ((level - 2) * 3);

        tocHTML += `
            <li class="mb-1 ${indent}">
                <a href="#${id}" class="text-decoration-none text-muted small">
                    ${heading.textContent}
                </a>
            </li>
        `;
    });

    tocHTML += '</ul>';
    tocContainer.innerHTML = tocHTML;
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    generateTableOfContents();

    // Smooth scroll for TOC links
    document.querySelectorAll('#table-of-contents a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endpush
@endsection