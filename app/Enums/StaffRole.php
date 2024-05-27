<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum StaffRole: int
{
    use EnumToArray;

    case Organizer = 0;
    case HeadMappooler = 1;
    case Mappooler = 2;
    case Mapper = 3;
    case HeadReferee = 4;
    case Referee = 5;
    case HeadStreamer = 6;
    case Streamer = 7;
    case Commentator = 8;
    case Composer = 9;
    case PlayTester = 10;
    case Spreadsheeter = 11;
    case Designer = 12;

    public function name(): string
    {
        return match ($this) {
            self::Organizer => 'Organizer',
            self::HeadMappooler => 'Head Mappooler',
            self::Mappooler => 'Mappooler',
            self::Mapper => 'Mapper',
            self::HeadReferee => 'Head Referee',
            self::Referee => 'Referee',
            self::HeadStreamer => 'Head Streamer',
            self::Streamer => 'Streamer',
            self::Commentator => 'Commentator',
            self::Composer => 'Composer',
            self::PlayTester => 'PlayTester',
            self::Spreadsheeter => 'Spreadsheeter',
            self::Designer => 'Designer',
        };
    }
}
