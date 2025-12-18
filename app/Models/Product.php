<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'type',
        'package_type',
        'quantity_per_carton',
        'price_per_unit',
        'price_per_carton',
        'weight'
    ];

    protected $casts = [
        'price_per_unit' => 'decimal:2',
        'price_per_carton' => 'decimal:2',
        'weight' => 'decimal:2',
        'quantity_per_carton' => 'integer',
    ];
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
