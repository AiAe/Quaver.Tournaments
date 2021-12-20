<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;


class MapTypeValidation implements Rule
{

    private $map_types = array(
        'SV',
        'LN',
        'Speed',
        'Jack',
        'Accuracy',
        'Technical',
        'Hybrid',
        'Tiebreaker',
        'Other'
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
        if (in_array($value, $this->map_types)) {
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
        return __("Invalid map type!");
    }
}
