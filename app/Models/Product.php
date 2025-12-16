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
        'price_unit',
        'price_carton',
        'weight'
    ];
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
