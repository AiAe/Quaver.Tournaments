<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum TeamUserStatus: int
{
    use EnumToArray;

    case Declined = 0;
    case Pending = 1;
    case Accepted = 2;

    public function name()
    {
        return match ($this)
        {
            self::Declined => 'Declined',
            self::Pending => 'Pending',
            self::Accepted => 'Accepted'
        };
    }
}
