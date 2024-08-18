<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class VendorProfileRequest extends FormRequest
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
        return [
            'full_name' => 'required|string|max:255',
            'email' => [
                'required',
                // 'email:rfc,dns', // Adding RFC and DNS checks
                'max:255',
                Rule::unique('vendors', 'email')->ignore($this->vendor),
            ],
            'password' => [
                'nullable',
                'sometimes',
                'string',
                'min:6',
            ],
            'status' => 'required|integer',
        ];
    }
}
