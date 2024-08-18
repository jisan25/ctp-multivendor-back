<?php

namespace App\Http\Requests;

use App\Helpers\MethodHelper;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
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
        $rules = [
            'full_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email:rfc,dns', // Adding RFC and DNS checks
                'max:255',
                Rule::unique('customers', 'email'),
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed'
            ],
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'division_id' => 'required|integer|exists:divisions,id',
            'district_id' => 'required|integer|exists:districts,id',
            'upazila_id' => 'required|integer|exists:upazilas,id',
        ];
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $customer = MethodHelper::getCustomer();
            $customerId = $this->my_customer ?: $customer->id;

            $rules['email'] = [
                'required',
                'email:rfc,dns', // Adding RFC and DNS checks
                'max:255',
                Rule::unique('customers', 'email')->ignore($customerId),
            ];

            $rules['password'] = [
                'nullable',
                'sometimes',
                'string',
                'min:6',
                'confirmed'
            ];
        }


        return $rules;
    }
}
