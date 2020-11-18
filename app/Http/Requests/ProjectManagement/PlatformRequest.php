<?php

namespace App\Http\Requests\ProjectManagement;

use Illuminate\Foundation\Http\FormRequest;

class PlatformRequest extends FormRequest
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
            'platforms' => 'required|array',
            'platforms.*.name' => 'required|string|max:180',
            'platforms.*.logo' => 'required|string',
            'platforms.*.cover_width' => 'nullable|integer|max:100000',
            'platforms.*.cover_height' => 'nullable|integer|max:100000',
            'platforms.*.profile_width' => 'nullable|integer|max:100000',
            'platforms.*.profile_height' => 'nullable|integer|max:100000',
            'platforms.*.post_width' => 'nullable|integer|max:100000',
            'platforms.*.post_height' => 'nullable|integer|max:100000',
            'platforms.*.display' => 'required|boolean'
        ];
    }
}
