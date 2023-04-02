<?php

namespace App\Models;

use App\Enums\MatchFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TournamentMatch extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'timestamp' => 'datetime',
        'match_format' => MatchFormat::class
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
