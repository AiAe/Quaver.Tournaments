<?php

namespace App\Enums;

enum TournamentStatus: int
{
    case Unlisted = -1;
    case Upcoming = 0;
    case RegistrationsOpen = 1;
    case Ongoing = 2;
    case Concluded = 3;
}
