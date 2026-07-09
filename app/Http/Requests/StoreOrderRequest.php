<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_quantity' => [
                'required', 
                'integer', 
                'min:1',
                function ($attribute, $value, $fail) {
                    $product = $this->route('product');
                    if ($product && $product->stock < $value) {
                        $fail("Sorry, only {$product->stock} items left in stock.");
                    }
                }
            ],
        ];
    }
}
