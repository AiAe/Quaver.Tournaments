<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;


class MapValidation implements Rule
{
    private $error = "";

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
        $this->error = "Invalid map link!";
        $match_map = preg_match('/https:\/\/quavergame\.com\/mapset\/map\/([0-9]*)/', $value, $matches);

        if ($match_map === 1) {
            $map_id = $matches[1];

            $response = Http::get('https://api.quavergame.com/v1/maps/' . $map_id);

            $map = $response->json();

            if ($map['status'] === 200) {
                if ($map['map']['game_mode'] === 1) {
                    return true;
                } else {
                    $this->error = "Map is not 4 keys!";
                }
            } else {
                $this->error = "Map not found!";
            }
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
        return __($this->error);
    }
}
