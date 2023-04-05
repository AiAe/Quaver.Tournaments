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

    public function rankColumnName(): string
    {
        return match ($this) {
            self::Keys4 => 'quaver_4k_rank',
            self::Keys7 => 'quaver_7k_rank'
        };
    }
}
