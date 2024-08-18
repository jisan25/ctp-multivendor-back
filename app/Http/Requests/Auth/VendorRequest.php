<?php

namespace App\Http\Requests\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
                'email:rfc,dns', // Adding RFC and DNS checks
                'max:255',
                Rule::unique('vendors', 'email'),
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed'
            ],
            'store_name' => 'required|string|max:255',
            'store_description' => 'required|string|max:500',
            'store_logo' => 'sometimes|nullable|file|image|max:2048', // Assuming it's an image file
            'store_address' => 'required|string|max:255',
            'store_phone' => 'required|string|max:20',
        ];
    }
}
