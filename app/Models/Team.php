<?php

namespace App\Models;

use App\Enums\TournamentGameMode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'tournament_id',
        'timezone_offset'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    public function captain(): User
    {
        return $this->members()->firstWhere('is_captain', true);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('is_captain')
            ->withTimestamps();
    }

    public function invites(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_user_invites')->withTimestamps();
    }

    public function ffaMatches(): BelongsToMany
    {
        return $this->belongsToMany(TournamentMatch::class, 'tournament_match_ffa_participants');
    }

    public function teamRank(): HasOne
    {
        return $this->hasOne(TeamRank::class);
    }

    public function updateTeamRank()
    {
        $teamRank = $this->teamRank;
        if (!$teamRank) {
            $teamRank = new TeamRank;
            $teamRank->team_id = $this->id;
            $teamRank->tournament_id = $this->tournament_id;
        }

        foreach (TournamentGameMode::cases() as $mode) {
            $column = $mode->rankColumnName();
            $teamRank->{$column} = $this->members()->pluck($column)->average();
        }

        $teamRank->save();
    }
}
