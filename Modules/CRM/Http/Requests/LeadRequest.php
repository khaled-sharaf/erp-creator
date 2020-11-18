<?php

namespace Modules\CRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

use App\Rules\PhoneNumber;
use App\Rules\IdCard;

class LeadRequest extends FormRequest
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
            'phone' => [
                'required',
                new PhoneNumber,
                Rule::unique('leads')->ignore($id)
            ],
            'whatsapp_phone' => [
                'nullable',
                new PhoneNumber,
                Rule::unique('leads')->ignore($id)
            ],
            'email' => [
                'nullable',
                'email',
                'max:180',
                Rule::unique('leads')->ignore($id)
            ],
            'id_cart' => [
                'nullable',
                'string',
                new IdCard,
                Rule::unique('leads')->ignore($id)
            ],

            'company_name' => 'nullable|string|between:2,180',
            'company_phone' => [
                'nullable',
                new PhoneNumber,
                Rule::unique('leads')->ignore($id)
            ],
            'company_email' => [
                'nullable',
                'email',
                'max:180',
                Rule::unique('leads')->ignore($id)
            ],
            'company_logo' => 'nullable|string',
            'company_address' => 'nullable|string|between:2,180',
            'company_scope' => 'nullable|string|between:2,180',
            'latitude' => 'nullable|required_with:longitude|numeric|max:999999',
            'longitude' => 'nullable|required_with:latitude|numeric|max:999999',

            'assign_to' => 'nullable|exists:users,id',
            'lead_status_id' => 'nullable|exists:lead_statuses,id',
            'note' => 'nullable|string|max:2000',
            'type' => 'nullable|in:0,1,2'
        ];
    }
}
