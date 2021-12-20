<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;


class MapStageValidation implements Rule
{

    private $map_stages = array(
        'Round of 128',
        'Round of 64',
        'Round of 32',
        'Round of 16',
        'Quarterfinals',
        'Semifinals',
        'Finals',
        'Grand Finals',
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
        if (in_array($value, $this->map_stages)) {
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
        return __("Invalid map stage!");
    }
}
