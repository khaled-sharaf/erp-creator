<?php

namespace App\Http\Requests\WebDevelopment;

use Illuminate\Foundation\Http\FormRequest;

class DomainRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'domain_name' => 'required|string|between:2,180',
            'price' => 'required|integer|max:100000',
            'description' => 'nullable|string|max:2000',
            'booking_date' => 'required|date',
            'renewal_date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'domain_name.required' => 'Domain name is required.',
            'price.required' => 'price is required.',
            'price.integer' => 'price must be numbers only.',
            'price.max' => 'price exceeded 100000.',
            'booking_date.required' => 'booking date is required',
            'renewal_date.required' => 'renewal date is required',
        ];
    }
}
