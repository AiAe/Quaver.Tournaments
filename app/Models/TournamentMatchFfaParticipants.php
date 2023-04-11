<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TournamentMatchFfaParticipants extends Pivot
{
    protected $table = "tournament_match_ffa_participants";

    protected $fillable = [
        'tournament_stage_round_id',
        'tournament_match_id',
        'team_id'
    ];

    public function round()
    {
        return $this->belongsTo(TournamentStageRound::class);
    }

    public function match()
    {
        return $this->belongsTo(TournamentMatch::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
