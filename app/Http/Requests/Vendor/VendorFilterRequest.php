<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class VendorFilterRequest extends FormRequest
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
            'search' => 'nullable|string|max:255',
            'sort' => 'nullable|string|in:full_name,email,store_name,store_phone,phone,category_name,price,stock_quantity,product_name,order_id,total_amount,quantity,rating,amount,title',
            'direction' => 'nullable|string|in:asc,desc',
            'status' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'payment_method' => 'nullable|string|max:255',
            'delivery_fee' => 'nullable|string|max:255',
        ];
    }

    public function getSearch()
    {
        return $this->input('search');
    }


    public function getSort()
    {
        return $this->input('sort');
    }

    public function getDirection()
    {
        return $this->input('direction', 'asc');
    }
    public function getFilter()
    {
        $filters = ['status', 'type', 'delivery_fee', 'rating', 'payment_method', 'store_id'];

        return $this->only($filters);
    }
}
