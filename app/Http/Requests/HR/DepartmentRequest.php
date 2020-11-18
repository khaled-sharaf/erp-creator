<?php

namespace App\Http\Requests\HR;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'name' => 'required|string|between:2,180',
            'job_titles' => 'required|array|min:1',
            'job_titles.*.name' => 'required|string|between:2,180'
        ];
    }
}
