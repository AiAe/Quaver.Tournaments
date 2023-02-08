<?php

namespace App\Models;

use App\Enums\StaffRole;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TournamentStaff extends Pivot
{
    public $incrementing = true;

    protected $casts = [
        'staff_role' => StaffRole::class
    ];
}
