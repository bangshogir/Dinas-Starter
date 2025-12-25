<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PublicSidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $profil = \App\Models\ProfilDinas::first();
        $recentArticles = \App\Models\Article::published()->with('category')->latest('published_at')->take(5)->get();
        $marketPrices = \App\Models\MarketPrice::take(5)->get(); // Adjust logic if "latest" or specific items needed
        $categories = \App\Models\ArticleCategory::withCount('articles')->get();

        return view('components.public-sidebar', compact('profil', 'recentArticles', 'marketPrices', 'categories'));
    }
}
