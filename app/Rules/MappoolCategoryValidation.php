<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;


class MappoolCategoryValidation implements Rule
{

    public static array $categories = array(
        'SV',
        'Rice 1',
        'Rice 2',
        'Hybrid',
        'LN',
        'TB'
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
        if (in_array($value, self::$categories)) {
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
        return __("Invalid category!");
    }
}
