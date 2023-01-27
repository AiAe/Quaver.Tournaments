<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum UserRoles : int
{
    use EnumToArray;

    case Blacklisted = 0;
    case User = 1;
    case Admin = 2;
    case Organizer = 3;

    public function name()
    {
        return match ($this)
        {
            self::Blacklisted => 'Blacklisted',
            self::User => 'User',
            self::Admin => 'Admin',
            self::Organizer => 'Organizer'
        };
    }
}
