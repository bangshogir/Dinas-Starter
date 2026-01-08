<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\MarketPrice;
use App\Models\Product;
use App\Models\ProductCategory;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_articles' => Article::count(),
            'total_products' => Product::count(),
            'total_product_categories' => ProductCategory::count(),
            'total_market_prices' => MarketPrice::count(),
        ];

        $recentArticles = Article::with('category')
            ->latest()
            ->take(5)
            ->get();

        $recentProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        $recentMarketPrices = MarketPrice::latest()
            ->take(5)
            ->get();

        $monthlyVisitors = \App\Models\Visitor::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Ensure all 12 months have data (default 0)
        $visitorCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $visitorCounts[] = $monthlyVisitors[$i] ?? 0;
        }

        return view('admin.dashboard', compact('stats', 'recentArticles', 'recentProducts', 'recentMarketPrices', 'visitorCounts'));
    }
}
