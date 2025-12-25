<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        $customerId = $this->customer?->id;
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:10|max:20|unique:customers,phone,' . $customerId,
            'address' => 'nullable|string|max:500',
            'credit_limit' => 'required|numeric|min:0',
        ];
    }
}
