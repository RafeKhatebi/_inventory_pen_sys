<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'customer_id',
        'type',
        'amount',
        'transaction_date',
        'note',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Scope for credit taken (debt)
    public function scopeTaken($query)
    {
        return $query->where('type', 'take');
    }

    // Scope for payments given
    public function scopeGiven($query)
    {
        return $query->where('type', 'give');
    }

    // Get formatted amount with sign
    public function getFormattedAmountAttribute()
    {
        return $this->type === 'take' ? '+' . number_format($this->amount, 2) : '-' . number_format($this->amount, 2);
    }
}
