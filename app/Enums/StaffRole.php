<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum StaffRole: int
{
    use EnumToArray;

    case Organizer = 0;
    case HeadMappooler = 1;
    case Mappooler = 2;
    case HeadReferee = 3;
    case Referee = 4;
    case HeadStreamer = 5;
    case Streamer = 6;
    case Commentator = 7;

    public function name(): string
    {
        return match ($this) {
            self::Organizer => 'Organizer',
            self::HeadMappooler => 'Head Mappooler',
            self::Mappooler => 'Mappooler',
            self::HeadReferee => 'Head Referee',
            self::Referee => 'Referee',
            self::HeadStreamer => 'Head Streamer',
            self::Streamer => 'Streamer',
            self::Commentator => 'Commentator',
        };
    }
}
