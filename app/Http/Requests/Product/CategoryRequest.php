<?php

namespace App\Http\Requests\Product;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $categoryId = $this->route('category'); // Assuming the route has a 'category' parameter for the category ID

        $rules = [
            'category_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($categoryId), // Ensure category_name is unique, ignoring the current category
            ],
            'type' => 'required|string|max:255',
        ];

        if ($this->input('type') == 'sub_category' || $this->input('type') == 'child_category') {
            $rules['parent_category_id'] = ['required', 'integer', 'exists:categories,id'];
        }

        return $rules;
    }
    public function messages(): array
    {
        return [
            'parent_category_id.required' => 'Parent Category is Required',
        ];
    }
}
