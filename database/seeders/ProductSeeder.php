<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'A4 Copy Paper',
                'type' => 'Paper',
                'package_type' => 'Ream',
                'quantity_per_carton' => 5,
                'price_per_unit' => 2.50,
                'price_per_carton' => 12.00,
                'weight' => 2.5
            ],
            [
                'name' => 'Blue Ballpoint Pen',
                'type' => 'Pen',
                'package_type' => 'Box',
                'quantity_per_carton' => 50,
                'price_per_unit' => 0.25,
                'price_per_carton' => 12.00,
                'weight' => 0.5
            ],
            [
                'name' => 'Stapler Heavy Duty',
                'type' => 'Office Equipment',
                'package_type' => 'Individual',
                'quantity_per_carton' => 1,
                'price_per_unit' => 15.00,
                'price_per_carton' => 15.00,
                'weight' => 0.8
            ],
            [
                'name' => 'Sticky Notes Yellow',
                'type' => 'Notes',
                'package_type' => 'Pack',
                'quantity_per_carton' => 12,
                'price_per_unit' => 1.50,
                'price_per_carton' => 18.00,
                'weight' => 0.1
            ],
            [
                'name' => 'Highlighter Set',
                'type' => 'Marker',
                'package_type' => 'Set',
                'quantity_per_carton' => 10,
                'price_per_unit' => 3.00,
                'price_per_carton' => 30.00,
                'weight' => 0.3
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}