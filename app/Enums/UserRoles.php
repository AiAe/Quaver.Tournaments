<?php

namespace App\Enums;

enum UserRoles : int
{
    case Blacklisted = 0;
    case User = 1;
    case Admin = 2;
    case Organizer = 3;
}
