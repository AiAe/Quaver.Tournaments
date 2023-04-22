<?php

namespace App\Models;

use App\Enums\MatchFormat;
use App\Enums\StaffRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class TournamentMatch extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'timestamp' => 'datetime',
        'match_format' => MatchFormat::class,
        'quaver_mp_ids' => 'json'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function round(): BelongsTo
    {
        return $this->belongsTo(TournamentStageRound::class, 'tournament_stage_round_id');
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

    public function ffaParticipants(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'tournament_match_ffa_participants');
    }

    public function tournament(): Tournament
    {
        return $this->round->stage->tournament;
    }

    public function staff(): HasMany
    {
        return $this->hasMany(TournamentMatchStaff::class);
    }

    public function mp_link($mp_id): string
    {
        return "https://quavergame.com/multiplayer/game/" . $mp_id;
    }
}
