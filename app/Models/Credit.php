<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    //
    protected $fillable = ['customer_id', 'amount', 'description', 'paid', 'credit_date'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
