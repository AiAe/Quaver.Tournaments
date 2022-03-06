<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;


class MappoolTypeValidation implements Rule
{

    public static array $types = array(
        'Accuracy / Consistency',
        'Chordjack',
        'Chordjack (dense)',
        'Chordjack (fast)',
        'JS',
        'JS (Dense)',
        'JS (Speed)',
        'Tech',
        'Speed',
        'Rice Emphasis',
        'LN Emphasis',
        'LN Release / Control',
        'LN Speed',
        'LN Mixed',
        'SV Reading',
        'SV Memo',
        'Tiebreaker',
        'Hybrid (LN)',
        'Hybrid (Rice)',
        'LN Noodle',
        'Stamina (Light)',
        'Stamina (Dense)',
        'Speedjack'
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
        if (in_array($value, self::$types)) {
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
        return __("Invalid type!");
    }
}
