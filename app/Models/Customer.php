<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'credit_limit'
    ];

    protected $casts = [
        'credit_limit' => 'decimal:2',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Calculate current credit balance
    public function getCurrentCredit()
    {
        return $this->transactions()
            ->selectRaw('SUM(CASE WHEN type = "take" THEN amount ELSE -amount END) as balance')
            ->value('balance') ?? 0;
    }

    // Get total amount taken (debt)
    public function getTotalTaken()
    {
        return $this->transactions()->where('type', 'take')->sum('amount');
    }

    // Get total amount given (payments)
    public function getTotalGiven()
    {
        return $this->transactions()->where('type', 'give')->sum('amount');
    }

    // Check if customer can take more credit
    public function canTakeCredit($amount)
    {
        $currentCredit = $this->getCurrentCredit();
        return ($currentCredit + $amount) <= $this->credit_limit;
    }
}