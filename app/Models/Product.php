<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
        'seller_name',
        'seller_phone',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'double',
    ];
}
