<?php

namespace App\Models;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $casts = [
        'format' => TournamentFormat::class,
        'status' => TournamentStatus::class
    ];
}
