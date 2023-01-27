<?php

namespace App\Models;

use App\Enums\TournamentStageFormat;
use Illuminate\Database\Eloquent\Model;

class TournamentStage extends Model
{
    protected $casts = [
        'stage_format' => TournamentStageFormat::class
    ];
}
