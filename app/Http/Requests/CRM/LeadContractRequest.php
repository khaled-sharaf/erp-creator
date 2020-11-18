<?php

namespace App\Http\Requests\CRM;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

use App\Rules\IdCard;

class LeadContractRequest extends FormRequest
{

    private $patternIdCart = "/^\+?\d{14}$/";

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $leadId = $this->input('lead.id');
        $personalSalesId = $this->input('personal_sales.id');
        return [
            'lead.id' => 'required|exists:leads,id',
            'lead.name' => 'required|string|between:2,180',
            'lead.id_cart' => [
                'nullable',
                'string',
                new IdCard,
                Rule::unique('leads', 'id_cart')->ignore($leadId)
            ],
            'lead.company_name' => 'required|string|between:2,180',
            'lead.company_scope' => 'required|string|between:2,180',
            'lead.company_address' => 'required|string|between:2,180',
            'lead.email' => [
                'nullable',
                'email',
                'max:180',
                Rule::unique('leads', 'email')->ignore($leadId)
            ],

            'personal_sales.id' => 'required|exists:users,id',
            'personal_sales.name_ar' => 'required|string|between:2,180',
            'personal_sales.address' => 'required|string|between:2,180',
            'personal_sales.id_cart' => [
                'required',
                'string',
                new IdCard,
                Rule::unique('users', 'id_cart')->ignore($personalSalesId)
            ],
            'job_title_lead' => "required|string|between:2,180",
            'created_at' => 'nullable|date',
            'start_date' => 'required|date',
            'duration' => 'required',
            'duration_unit'=>'required',

            'services' => 'required|array|min:1',
            'services.*.service_id' => 'required|exists:services,id',
            'services.*.amount' => 'required|integer|min:10,max:1000000',

            'terms' => 'nullable|array',
            'terms.*.content' => 'required|string|max:4000',
            'note' => 'nullable|string|max:4000',
            'currency_id'=>'required'
        ];
    }
}
