<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['product_id', 'quantity', 'type', 'note'];

    protected $casts = [
        'quantity' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get current stock for a specific product
     */
    public static function getCurrentStock($productId)
    {
        return self::where('product_id', $productId)
            ->selectRaw('SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) as current_stock')
            ->value('current_stock') ?? 0;
    }

    /**
     * Scope for stock in transactions
     */
    public function scopeStockIn($query)
    {
        return $query->where('type', 'in');
    }

    /**
     * Scope for stock out transactions
     */
    public function scopeStockOut($query)
    {
        return $query->where('type', 'out');
    }
}