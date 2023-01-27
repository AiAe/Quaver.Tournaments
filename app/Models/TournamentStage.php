<?php

namespace App\Models;

use App\Enums\TournamentStageFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TournamentStage extends Model
{
    protected $casts = [
        'stage_format' => TournamentStageFormat::class
    ];

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }
}
