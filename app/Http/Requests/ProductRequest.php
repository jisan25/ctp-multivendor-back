<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'store_id' => 'required|integer|exists:stores,id',
            'product_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'variant_image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image' => 'nullable|array',
            'product_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string|max:2000',
            'price' => 'required|integer|',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required|integer|exists:categories,id',

            // 'product_attributes' => 'sometimes|nullable|array',
            // 'product_attributes.*.color_id' => 'required|integer|exists:colors,id',
            // 'product_attributes.*.size_id' => 'required|integer|exists:sizes,id',
            // 'product_attributes.*.quantity' => 'required|integer|min:1',
        ];

        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['image'] = 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            $rules['status'] = 'required|integer';
        }

        return $rules;
    }
}
