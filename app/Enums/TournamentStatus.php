<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum TournamentStatus: int
{
    use EnumToArray;

    case Unlisted = 0;
    case Upcoming = 1;
    case RegistrationsOpen = 2;
    case Ongoing = 3;
    case Concluded = 4;

    public function name()
    {
        return match ($this)
        {
            self::Unlisted => 'Unlisted',
            self::Upcoming => 'Upcoming',
            self::RegistrationsOpen => 'Registrations Open',
            self::Ongoing => 'Ongoing',
            self::Concluded => 'Concluded'
        };
    }
}
