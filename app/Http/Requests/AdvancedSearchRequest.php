<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvancedSearchRequest extends FormRequest
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
            'name' => ['nullable','string', 'max:180'],
            'property' => ['nullable','Boolean'],
            'rooms' => ['nullable','integer'],
            'price' => ['nullable','integer'],
            'type_id' => ['nullable','integer'],
        ];
    }
}
