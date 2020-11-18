<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Rules\PhoneNumber;
use App\Rules\Amount;

class SupplierRequest extends FormRequest
{

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
        $id = $this->id;
        return [
            'name' => 'required|string|between:2,180',
            'company_name' => 'nullable|string|between:2,180',
            'phone' => [
                'nullable',
                new PhoneNumber,
                Rule::unique('suppliers')->ignore($id)
            ],
            'whatsapp_phone' => [
                'nullable',
                new PhoneNumber,
                Rule::unique('suppliers')->ignore($id)
            ],
            'email' => [
                'nullable',
                'email',
                'max:180',
                Rule::unique('suppliers')->ignore($id)
            ],
            'logo' => 'nullable|string',
            'address' => 'nullable|string|between:2,180',
            'latitude' => 'nullable|required_with:longitude|numeric|max:999999',
            'longitude' => 'nullable|required_with:latitude|numeric|max:999999',
            'note' => 'nullable|string|max:2000',

            'services' => 'nullable|array',
            'services.*.name' => 'required|string|between:2,180',
            'services.*.description' => 'nullable|string|max:2000',
            'services.*.amount' => ['required', new Amount],
            'services.*.active' => 'required|boolean',
        ];
    }
}
