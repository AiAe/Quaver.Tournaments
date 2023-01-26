<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum TournamentFormat: int
{
    use EnumToArray;

    case Solo = 0;
    case Team = 1;

    public function name()
    {
        return match ($this)
        {
            self::Solo => 'Solo',
            self::Team => 'Team'
        };
    }
}
