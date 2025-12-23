<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketPrice extends Model
{
    protected $fillable = [
        'commodity_name',
        'price',
        'unit',
        'trend_status',
        'trend_percentage',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'trend_percentage' => 'decimal:2',
    ];

    /**
     * Boot the model to handle automatic trend calculation.
     */
    protected static function booted()
    {
        static::saving(function ($marketPrice) {
            // Only calculate if price has changed and there is an old price
            if ($marketPrice->isDirty('price') && $marketPrice->getOriginal('price')) {
                $oldPrice = $marketPrice->getOriginal('price');
                $newPrice = $marketPrice->price;

                // Avoid division by zero
                if ($oldPrice > 0) {
                    $percentage = (($newPrice - $oldPrice) / $oldPrice) * 100;

                    $marketPrice->trend_percentage = abs(round($percentage, 2));

                    if ($percentage > 0) {
                        $marketPrice->trend_status = 'naik';
                    } elseif ($percentage < 0) {
                        $marketPrice->trend_status = 'turun';
                    } else {
                        $marketPrice->trend_status = 'stabil';
                        $marketPrice->trend_percentage = 0;
                    }
                }
            }
            // If it's a new record or no old price (reset)
            elseif (!$marketPrice->exists || !$marketPrice->getOriginal('price')) {
                // Keep existing values or set defaults if not provided
                if (!isset($marketPrice->attributes['trend_status'])) {
                    $marketPrice->trend_status = 'stabil';
                }
                if (!isset($marketPrice->attributes['trend_percentage'])) {
                    $marketPrice->trend_percentage = 0;
                }
            }
        });
    }
}
