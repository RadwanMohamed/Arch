<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuildingRequest extends FormRequest
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
            'name'          => ['required', 'string', 'max:180'],
            'price'         => ['required', 'numeric'],
            'square'        => ['required', 'numeric'],
            'property'      => ['required', 'Boolean'],
            'desc'          => ['required', 'string', 'max:160'],
            'meta'          => ['required', 'string'],
            'address'       => ['required', 'alpha_dash'],
            'description'   => ['required', 'string'],
            'status'        => ['required', 'Boolean'],
            'user_id'       => ['integer'],
            'rooms'       => ['required', 'integer'],
            'type_id'       => ['required', 'integer'],
        ];
    }
}
