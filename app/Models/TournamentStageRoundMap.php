<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TournamentStageRoundMap extends Model
{
    use HasFactory;

    public function round(): BelongsTo
    {
        return $this->belongsTo(TournamentStageRound::class);
    }

    public function map(): HasOne
    {
        return $this->hasOne(QuaverMap::class);
    }
}
