<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum MatchFormat: int
{
    use EnumToArray;

    case OneVsOne = 0;
    case FreeForAll = 1;

    public function name(): string
    {
        return match ($this) {
            MatchFormat::OneVsOne => 'OneVsOne',
            MatchFormat::FreeForAll => 'FreeForAll',
        };
    }
}
