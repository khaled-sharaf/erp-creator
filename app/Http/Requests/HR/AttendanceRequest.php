<?php

namespace App\Http\Requests\HR;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
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
            'user_id' => 'required:exists:users,id',
            'absent' => 'nullable|boolean',
            'check_in' => 'required_if:absent,0|nullable|date',
            'check_out' => 'nullable|date|after:check_in',
            'overtime' => 'nullable|integer',
            'permission_time' => 'nullable|integer',
            'permission_type' => 'nullable|required_with:permission_time|in:am,pm',
            'comment' => 'nullable|string|max:500',
            'created_at' => 'nullable|date',
        ];
    }
}
