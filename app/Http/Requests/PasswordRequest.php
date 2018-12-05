<?php

namespace App\Http\Requests;

use App\Rules\HashCheckRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PasswordRequest extends FormRequest
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
            'old_password'=>['required','string', new HashCheckRule],
            'password' => ['required', 'string', 'min:6', 'confirmed','different:old_password'],
        ];
    }
}