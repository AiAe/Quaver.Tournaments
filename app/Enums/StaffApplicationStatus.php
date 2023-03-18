<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum StaffApplicationStatus: int
{
    use EnumToArray;

    case Pending = 0;
    case Accepted = 1;
    case Denied = 2;

    public function name(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Accepted => 'Accepted',
            self::Denied => 'Denied',
        };
    }
}
