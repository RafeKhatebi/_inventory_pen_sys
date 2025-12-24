<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stock;
use App\Models\Product;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $products = Product::all();

        if ($products->count() > 0) {
            foreach ($products as $product) {
                // Add initial stock for each product
                Stock::create([
                    'product_id' => $product->id,
                    'quantity' => rand(50, 200),
                    'type' => 'in',
                    'note' => 'Initial stock entry'
                ]);

                // Add some random stock movements
                for ($i = 0; $i < rand(2, 5); $i++) {
                    Stock::create([
                        'product_id' => $product->id,
                        'quantity' => rand(5, 30),
                        'type' => rand(0, 1) ? 'in' : 'out',
                        'note' => rand(0, 1) ? 'Stock adjustment' : null
                    ]);
                }
            }
        }
    }
}