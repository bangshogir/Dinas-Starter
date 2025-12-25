<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\MarketPrice;
use Illuminate\Http\Request;

class MarketPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marketPrices = MarketPrice::orderBy('commodity_name', 'asc')->get();
        // Categorize prices if possible, or just pass them all. 
        // For now, simple list.

        return view('market-prices.index', compact('marketPrices'));

    }
}
