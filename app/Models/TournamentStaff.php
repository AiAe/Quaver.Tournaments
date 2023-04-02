<?php

namespace App\Models;

use App\Enums\StaffRole;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TournamentStaff extends Pivot
{
    public $incrementing = true;

    protected $fillable = [
        'tournament_id',
        'user_id',
        'staff_role'
    ];

    protected $casts = [
        'staff_role' => StaffRole::class
    ];
}
