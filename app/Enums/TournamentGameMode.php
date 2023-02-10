<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum TournamentGameMode: int
{
    use EnumToArray;

    case Keys4 = 1;
    case Keys7 = 2;

    public function name(): string
    {
        return match ($this) {
            self::Keys4 => '4 Keys',
            self::Keys7 => '7 Keys'
        };
    }
}
