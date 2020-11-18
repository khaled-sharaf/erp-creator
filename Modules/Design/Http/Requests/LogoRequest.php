<?php

namespace Modules\Design\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogoRequest extends FormRequest
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
            'logo_name' => 'required|string|between:2,180',
            'user_id' => 'required|exists:users,id',
            'lead_id' => 'required|exists:leads,id',
            'photo' => 'required|max:150000'
            // 'photo' => 'required|image|mimes:jpeg,png,jpg',
            // mimes:jpeg,png
        ];
    }

    public function messages()
    {
        return [
            'logo_name.required' => 'logo name is required.',
            'designer_name.required' => 'designer name is required.',
            'lead_id.required' => 'Lead is not selected',
            'photo.required' => 'photo is required.',
            'photo.max' => 'photo exceeded its limit.',
        ];
    }
}
