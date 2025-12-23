<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketPrice;
use Illuminate\Http\Request;

class MarketPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MarketPrice::query();

        if ($request->filled('search')) {
            $query->where('commodity_name', 'like', '%' . $request->search . '%');
        }

        $prices = $query->latest()->paginate(10);

        return view('admin.market-prices.index', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.market-prices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'commodity_name' => 'required|string|max:255|unique:market_prices,commodity_name',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ], [
            'commodity_name.unique' => 'Komoditas ini sudah ada di database.',
        ]);

        // Default to stable for new items
        $validated['trend_status'] = 'stabil';
        $validated['trend_percentage'] = 0;

        MarketPrice::create($validated);

        return redirect()->route('admin.market-prices.index')
            ->with('success', 'Harga pasar baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MarketPrice $marketPrice)
    {
        // For security, usually authorize here if using policies
        return view('admin.market-prices.edit', compact('marketPrice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MarketPrice $marketPrice)
    {
        $validated = $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        // Only update price. The model hook handles trend calculation automatically.
        $marketPrice->update($validated);

        return redirect()->route('admin.market-prices.index')
            ->with('success', 'Harga ' . $marketPrice->commodity_name . ' berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MarketPrice $marketPrice)
    {
        $name = $marketPrice->commodity_name;
        $marketPrice->delete();

        return redirect()->route('admin.market-prices.index')
            ->with('success', 'Komoditas ' . $name . ' berhasil dihapus.');
    }
}
