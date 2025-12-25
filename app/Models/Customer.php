<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // fillable fields
    protected $fillable = [
        'name',
        'phone',
        'address',
        'credit_limit'
    ];


    // relation with transactions

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}