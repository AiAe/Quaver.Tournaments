<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;


class MappoolRateValidation implements Rule
{

    public static array $rates = array(
        '0.5x',
        '0.55x',
        '0.6x',
        '0.65x',
        '0.7x',
        'o.75x',
        '0.8x',
        '0.85x',
        '0.9x',
        '0.95x',
        '1x',
        '1.05x',
        '1.1x',
        '1.15x',
        '1.2x',
        '1.25',
        '1.3x',
        '1.35x',
        '1.4x',
        '1.45x',
        '1.5x',
        '1.55x',
        '1.6x',
        '1.65x',
        '1.7',
        '1.75x',
        '1.8',
        '1.85x',
        '1.9',
        '1.95x',
        '2x'
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
        if (in_array($value, self::$rates)) {
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
        return __("Invalid rate!");
    }
}
