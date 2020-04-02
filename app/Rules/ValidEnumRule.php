<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidEnumRule implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $arr = explode('.',$attribute);
        $attr = end($arr);
        $enums = config('enums')[$attr];
        return in_array(strtolower($value), $enums, true);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
