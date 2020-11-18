<?php

namespace App\Http\Requests\CRM;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

use App\Rules\PhoneNumber;

class MeetingRequest extends FormRequest
{
    private $patternPhone = "/^\+?\d{8,14}$/";

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
            'lead_name' => 'required_if:lead_id,|nullable|string|between:2,180',
            'lead_phone' => [
                'required_if:lead_id,',
                'nullable',
                new PhoneNumber,
                Rule::unique('leads', 'phone')
            ],
            'lead_id' => 'nullable|exists:leads,id',
            'meeting_id' => 'nullable|exists:meetings,id',
            'date' => 'required|date|after:today',
            'address' => 'required|string|between:2,180'
        ];
    }
}
