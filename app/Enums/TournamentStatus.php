<?php

namespace App\Enums;

enum TournamentStatus: int
{
    case Unlisted = 0;
    case Upcoming = 1;
    case RegistrationsOpen = 2;
    case Ongoing = 3;
    case Concluded = 4;
}
