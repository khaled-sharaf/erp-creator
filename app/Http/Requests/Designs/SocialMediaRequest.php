<?php

namespace App\Http\Requests\Designs;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaRequest extends FormRequest
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
            'media_name' => 'required|string|between:2,180',
            'lead_id' => 'required|exists:leads,id',
            'user_id' => 'required|exists:users,id',
            'photo' => 'required|max:150000'
        ];
    }

    public function messages()
    {
        return [
            'media_name.required' => 'logo name is required.',
            'lead_id.required' => 'Lead is not selected',
            'user_id.required' => 'Designer must be selected',
            'photo.required' => 'photo is required.',
            'photo.max' => 'photo exceeded its limit.',
        ];
    }
}
