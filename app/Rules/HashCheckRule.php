<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class HashCheckRule implements Rule
{


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Hash::check($value,Auth::user()->getAuthPassword());

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ' the old password is wrong! ';
    }
}
