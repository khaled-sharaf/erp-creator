<?php

namespace App\Http\Requests\CRM;

use Illuminate\Foundation\Http\FormRequest;

class QuotationRequest extends FormRequest
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
        $leadId = $this->input('lead.id');
        $personalSalesId = $this->input('personal_sales.id');
        return [
            'lead_id' => 'required|exists:leads,id',
            'sales_id' => 'required|exists:users,id',

            'services' => 'required|array|min:1',
            'services.*.service_id' => 'required|exists:services,id',
            'services.*.amount' => 'required|integer|min:10,max:1000000',
            'currency_id'=>'required'
        ];
    }
}
