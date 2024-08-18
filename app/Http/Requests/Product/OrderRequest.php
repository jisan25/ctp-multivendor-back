<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'cartitems' => 'required|array',
            'cartitems.*.product_id' => 'required|exists:products,id',
            'cartitems.*.quantity' => 'required|integer|min:1',
            'cartitems.*.delivery_type_id' => 'required|exists:delivery_types,id',
        ];
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules = array_merge($rules, [
                'cartitems' => 'nullable',
                'cartitems.*.product_id' => 'nullable',
                'cartitems.*.quantity' => 'nullable',
                'cartitems.*.delivery_type_id' => 'nullable',
                'status' => 'required|string|max:50',
            ]);
        }

        return $rules;
    }
}
