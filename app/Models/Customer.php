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
        'total_credit'
    ];
    // relation with credits
    public function credits()
    {
        return $this->hasMany(Credit::class);
    }
}
