<?php

namespace App\Http\Requests;

use App\Helpers\MethodHelper;
use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'product_id' => 'sometimes|integer|exists:products,id',
            'title' => 'required|string|max:255',
        ];

        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules = array_merge($rules, [
                'product_id' => 'nullable',
                'title' => 'nullable',
                'answer' => 'required|string|max:1000',
            ]);
        }

        return $rules;
    }
}
