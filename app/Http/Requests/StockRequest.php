<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Product;

class StockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'product_id' => 'required|exists:products,id',
            'quantity' => ['required', 'integer', 'min:1'],
            'type' => 'required|in:in,out',
            'note' => 'nullable|string|max:500'
        ];

        // Add stock availability validation for 'out' type
        if ($this->type === 'out') {
            $rules['quantity'][] = function ($attribute, $value, $fail) {
                $product = Product::find($this->product_id);
                if ($product) {
                    $currentStock = $product->stock()
                        ->selectRaw('SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) as current_stock')
                        ->value('current_stock') ?? 0;

                    if ($value > $currentStock) {
                        $fail("Cannot remove {$value} items. Only {$currentStock} items available in stock.");
                    }
                }
            };
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'product_id.required' => 'Please select a product.',
            'product_id.exists' => 'The selected product does not exist.',
            'quantity.required' => 'Please enter the quantity.',
            'quantity.integer' => 'Quantity must be a whole number.',
            'quantity.min' => 'Quantity must be at least 1.',
            'type.required' => 'Stock type is required.',
            'type.in' => 'Stock type must be either "in" or "out".',
            'note.max' => 'Note cannot exceed 500 characters.'
        ];
    }
}
