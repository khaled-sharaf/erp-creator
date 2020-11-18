<?php

namespace App\Http\Requests\HR;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Rules\PhoneNumber;
use App\Rules\IdCard;

class UserRequest extends FormRequest
{

    // private $patternPassword = "/^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z0-9]{6,16}$/";

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $id = $this->id;
        return [
            'name' => 'required|string|between:2,180',
            'password' => $id != null ? 'nullable' : 'required' .
                          '|string|between:4,16|confirmed',
            'email' => [
                'required',
                'email',
                'max:180',
                Rule::unique('users')->ignore($id)
            ],

            'id_cart' => [
                'nullable',
                'string',
                new IdCard,
                Rule::unique('users')->ignore($id)
            ],

            'photo' => 'nullable|string',
            'name_ar' => 'nullable|string|max:180',
            'phone' => ['nullable', new PhoneNumber],
            'home_phone' => ['nullable', new PhoneNumber],
            'emergency_phone' => ['nullable', new PhoneNumber],
            'country' => 'nullable|string|max:180',
            'city' => 'nullable|string|max:180',
            'address' => 'nullable|string|max:180',
            'nationality' => 'nullable|string|max:180',
            'marital_status' => 'nullable|in:single,engaged,married,others',
            'gender' => 'nullable|in:male,female,others',
            'birth_date' => 'nullable|date',

            'work_phone' => ['nullable', new PhoneNumber],
            'work_email' => 'nullable|email|max:180',
            'work_address' => 'nullable|string|max:180',
            'bank_account_number' => 'nullable|numeric|max:99999999999999999999999999999',
            'visa_number' => 'nullable|numeric|max:99999999999999999999',
            'visa_expire_date' => 'nullable|date',

            'certificate_level' => 'nullable|string|max:180',
            'school' => 'nullable|string|max:180',

            'job_title_id' => 'nullable|exists:job_titles,id',
            'work_period_id' => 'nullable',

            'hiring_date' => 'nullable|date',
            'salary' => 'nullable|integer|max:100000',
            'documents' => 'nullable|array',
            'active' => 'nullable|boolean',

            'document_note' => 'nullable|string|max:1000',

        ];
    }
}
