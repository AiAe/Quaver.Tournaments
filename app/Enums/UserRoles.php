<?php

namespace App\Enums;

enum UserRoles : string
{
    case Blacklisted = 'Blacklisted';
    case User = 'User';
    case Admin = 'Admin';
    case Organizer = 'Organizer';
}
