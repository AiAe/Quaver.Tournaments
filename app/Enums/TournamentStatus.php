<?php

namespace App\Enums;

enum TournamentStatus: string
{
    case Unlisted = 'Unlisted';
    case Upcoming = 'Upcoming';
    case RegistrationsOpen = 'RegistrationsOpen';
    case Ongoing = 'Ongoing';
    case Concluded = 'Concluded';
}
