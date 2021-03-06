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
        switch ($this->method()) {
            case 'POST': {
        return [
            'name'          => ['required', 'string', 'max:180'],
            'price'         => ['required', 'numeric'],
            'square'        => ['required', 'numeric'],
            'property'      => ['required', 'Boolean'],
            'desc'          => [ 'string','min:100' ,'max:160'],
            'meta'          => ['required', 'string'],
            'address_id'    => ['required', 'integer'],
            'description'   => ['required', 'string','min:100'],
            'status'        => [ 'Boolean'],
            'user_id'       => ['integer'],
            'rooms'       => ['required', 'integer'],
            'type_id'       => ['required', 'integer'],

            'images' => ['required'],
            'images.*' => ['required','mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=400,min_height=450'],
        ];
            }

            case 'PUT':
            case 'PATCH':
            case 'POST': {
                return [
                    'name'          => ['required', 'string', 'max:180'],
                    'price'         => ['required', 'numeric'],
                    'square'        => ['required', 'numeric'],
                    'property'      => ['required', 'Boolean'],
                    'desc'          => [ 'string','min:100' ,'max:160'],
                    'meta'          => ['required', 'string'],
                    'address_id'    => ['required', 'integer'],
                    'description'   => ['required', 'string','min:100'],
                    'status'        => [ 'Boolean'],
                    'user_id'       => ['integer'],
                    'rooms'       => ['required', 'integer'],
                    'type_id'       => ['required', 'integer'],
            ];
            }
            default:break;

        }
    }
}
