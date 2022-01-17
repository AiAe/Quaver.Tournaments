<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;


class StaffRoleValidation implements Rule
{

    private $staff_role = array(
        'referee',
//        'mappool',
//        'mapper',
        'streamer',
        'commentator'
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
        $passed = true;

        if(is_array($value)) {
            foreach ($value as $role) {
                if (!in_array($role, $this->staff_role)) {
                    $passed = false;
                }
            }
        }

        return $passed;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __("Invalid staff role!");
    }
}
