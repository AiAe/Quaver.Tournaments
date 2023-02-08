<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TournamentMatch extends Model
{
    use HasFactory;

    protected $casts = [
        'timestamp' => 'datetime'
    ];

    public function round(): BelongsTo
    {
        return $this->belongsTo(TournamentStageRound::class);
    }

    public function team1(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function team2(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function precedingMatch1(): BelongsTo
    {
        return $this->belongsTo(TournamentMatch::class);
    }

    public function precedingMatch2(): BelongsTo
    {
        return $this->belongsTo(TournamentMatch::class);
    }
}
