<?php

namespace App\Http\Requests\User;

use App\Rules\CurrentPasswordCheck;
use Illuminate\Foundation\Http\FormRequest;

class PasswordChangeRequest extends FormRequest
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
            'current_password' => new CurrentPasswordCheck(),
            'password' => ['required', 'string', 'min:8', 'max:20', 'confirmed', 'regex:/\A[a-z\d]{8,20}+\z/i'],
        ];
    }
}
