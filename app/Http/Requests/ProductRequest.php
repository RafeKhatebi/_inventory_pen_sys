<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'package_type' => 'required|string|max:100',
            'quantity_per_carton' => 'required|integer|min:1',
            'price_per_unit' => 'required|numeric|min:0',
            'price_per_carton' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] = 'required|string|max:255|unique:products,name,' . $this->route('product');
        } else {
            $rules['name'] = 'required|string|max:255|unique:products,name';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required',
            'name.unique' => 'Product name already exists',
            'type.required' => 'Product type is required',
            'package_type.required' => 'Package type is required',
            'quantity_per_carton.required' => 'Quantity per carton is required',
            'quantity_per_carton.min' => 'Quantity per carton must be at least 1',
            'price_per_unit.required' => 'Price per unit is required',
            'price_per_unit.min' => 'Price per unit must be positive',
            'price_per_carton.required' => 'Price per carton is required',
            'price_per_carton.min' => 'Price per carton must be positive',
            'weight.required' => 'Weight is required',
            'weight.min' => 'Weight must be positive',
        ];
    }
}