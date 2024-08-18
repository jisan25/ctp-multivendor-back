<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'store_name' => 'required|string|max:255',
            'store_description' => 'required|string|max:500',
            'store_logo' => 'sometimes|nullable|file|image|max:2048', // Assuming it's an image file
            'store_address' => 'required|string|max:255',
            'store_phone' => 'required|string|max:20',
        ];
        if ($this->isMethod('patch') || $this->isMethod('put')) {

            if (auth()->user()->tokenCan('role:admin')) {
                $rules['status'] = [
                    'required',
                    'integer',
                    'in:0,1',
                ];
                $rules['status'][] = 'in:0,1,2';
            }
        }
        return $rules;
    }
}
