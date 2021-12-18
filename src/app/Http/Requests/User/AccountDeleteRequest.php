<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AccountDeleteRequest extends FormRequest
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
            'user_delete_check' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'user_delete_check' => '同意チェック',
        ];
    }
}
