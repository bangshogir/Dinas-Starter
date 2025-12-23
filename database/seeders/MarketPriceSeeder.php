<?php

namespace Database\Seeders;

use App\Models\MarketPrice;
use Illuminate\Database\Seeder;

class MarketPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prices = [
            [
                'commodity_name' => 'Beras Premium',
                'price' => 15000,
                'unit' => 'Kg',
                'trend_status' => 'stabil',
                'trend_percentage' => 0,
            ],
            [
                'commodity_name' => 'Daging Sapi',
                'price' => 120000,
                'unit' => 'Kg',
                'trend_status' => 'turun',
                'trend_percentage' => 2,
            ],
            [
                'commodity_name' => 'Cabai Merah',
                'price' => 45000,
                'unit' => 'Kg',
                'trend_status' => 'naik',
                'trend_percentage' => 5,
            ],
            [
                'commodity_name' => 'Minyak Goreng',
                'price' => 14000,
                'unit' => 'Liter',
                'trend_status' => 'stabil',
                'trend_percentage' => 0,
            ],
        ];

        foreach ($prices as $price) {
            MarketPrice::create($price);
        }
    }
}
