<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::with(['category', 'author'])
            ->published()
            ->latest('published_at')
            ->paginate(9);

        $featuredArticles = Article::with(['category', 'author'])
            ->published()
            ->featured()
            ->latest('published_at')
            ->take(3)
            ->get();

        $categories = ArticleCategory::active()
            ->withCount('publishedArticles')
            ->ordered()
            ->get();

        return view('articles.index', compact('articles', 'featuredArticles', 'categories'));
    }

    public function show(Article $article)
    {
        if ($article->status !== 'published' || !$article->published_at) {
            abort(404);
        }

        $article->load(['category', 'author']);

        // Get related articles
        $relatedArticles = Article::with(['category', 'author'])
            ->published()
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    public function category(ArticleCategory $category)
    {
        if (!$category->is_active) {
            abort(404);
        }

        $articles = Article::with(['category', 'author'])
            ->published()
            ->byCategory($category->id)
            ->latest('published_at')
            ->paginate(9);

        return view('articles.category', compact('articles', 'category'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return redirect()->route('articles.index');
        }

        $articles = Article::with(['category', 'author'])
            ->published()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->paginate(9);

        return view('articles.search', compact('articles', 'query'));
    }
}
