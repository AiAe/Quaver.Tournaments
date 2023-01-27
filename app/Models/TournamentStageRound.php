<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TournamentStageRound extends Model
{
    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];
}
