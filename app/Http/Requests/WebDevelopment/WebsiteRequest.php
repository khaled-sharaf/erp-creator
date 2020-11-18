<?php

namespace App\Http\Requests\WebDevelopment;

use Illuminate\Foundation\Http\FormRequest;

class WebsiteRequest extends FormRequest
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
            'website_name' => 'required|string|between:2,180',
            'lead_id' => 'required|exists:leads,id',
            // 'user_id' => 'required|array|exists:users,id',
            'document' => 'required|unique:websites,document'


            // 'photo' => 'required|image|mimes:jpeg,png,jpg',
            // mimes:jpeg,png
        ];
    }

    public function messages()
    {
        return [
            'website_name.required' => 'website name is required.',
            'lead_id.required' => 'Lead is not selected',
            'user_id.required' => 'User is not selected',
            'document.required' => 'document is required.',
            'document.max' => 'document exceeded its limit.',
        ];
    }
}
