<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;


class MappoolModsValidation implements Rule
{

    public static array $mods = array(
        'None',
        'NLN',
        'NSV',
        'NLN, NSV'
    );

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (in_array($value, self::$mods)) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __("Invalid mod!");
    }
}
