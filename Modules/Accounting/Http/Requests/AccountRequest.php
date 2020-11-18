<?php

namespace Modules\Accounting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Rules\IdCard;
use App\Rules\Amount;

class AccountRequest extends FormRequest
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
        $id = $this->id;
        return [
            'name' => 'required|string|between:2,180',
            'kind' => 'nullable|in:bank,cash,partner',
            'type' => 'nullable|in:saving,current,joint,recom',
            'balance' => ['required', new Amount],
            'ratio' => 'nullable|required_if:kind,partner|numeric|between:1,100',
            'account_no' => [
                'nullable',
                'numeric',
                'max:999999999999999999999999',
                'required_if:kind,bank',
                Rule::unique('accounts')->ignore($id)
            ],
            'id_card' => [
                'nullable',
                new IdCard,
                Rule::unique('accounts')->ignore($id)
            ],
        ];
    }
}
