<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Product;
use App\Models\MarketPrice;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return redirect('/');
        }

        // Search Articles
        $articles = Article::with(['category', 'author'])
            ->published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->take(10)
            ->get();

        // Search Products
        $products = Product::with(['category'])
            ->where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->orWhere('seller_name', 'like', "%{$query}%");
            })
            ->take(10)
            ->get();

        // Search Market Prices
        $marketPrices = MarketPrice::where('commodity_name', 'like', "%{$query}%")
            ->latest()
            ->take(10)
            ->get();

        $totalResults = $articles->count() + $products->count() + $marketPrices->count();

        return view('search.index', compact('articles', 'products', 'marketPrices', 'query', 'totalResults'));
    }
}
