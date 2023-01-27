<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum TournamentStageFormat: int
{
    use EnumToArray;

    case Qualifier = 0;
    case SingleElimination = 1;
    case DoubleElimination = 2;
    case Swiss = 3;
    case Registration = 4;

    public function name(): string
    {
        return match ($this) {
            self::Qualifier => 'Qualifier',
            self::SingleElimination => 'Single Elimination',
            self::DoubleElimination => 'Double Elimination',
            self::Swiss => 'Swiss',
            self::Registration => 'Registration',
        };
    }
}
