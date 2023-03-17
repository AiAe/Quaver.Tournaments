<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum StaffRole: int
{
    use EnumToArray;

    case Organizer = 0;
    case Mappooler = 1;
    case Referee = 2;
    case Streamer = 3;
    case Commentator = 4;

    public function name(): string
    {
        return match ($this) {
            self::Organizer => 'Organizer',
            self::Mappooler => 'Mappooler',
            self::Referee => 'Referee',
            self::Streamer => 'Streamer',
            self::Commentator => 'Commentator',
        };
    }
}
