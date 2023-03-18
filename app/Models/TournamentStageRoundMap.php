<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TournamentStageRoundMap extends Model
{
    use HasFactory;

    public function round(): BelongsTo
    {
        return $this->belongsTo(TournamentStageRound::class);
    }

    public function map(): BelongsTo
    {
        return $this->belongsTo(QuaverMap::class, 'quaver_map_id', 'quaver_map_id');
    }
}
