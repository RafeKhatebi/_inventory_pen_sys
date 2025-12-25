<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:transaction_date',
            'status' => 'required|in:pending,paid,partial',
            'description' => 'nullable|string|max:500',
        ];
    }
}
