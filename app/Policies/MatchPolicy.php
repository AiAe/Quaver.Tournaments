<?php

namespace App\Policies;

use App\Enums\MatchFormat;
use App\Enums\TournamentStageFormat;
use App\Models\TournamentMatch;
use App\Models\TournamentStageRound;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MatchPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, TournamentMatch $tournamentMatch): bool
    {
        return $user->can('view', $tournamentMatch->tournament());
    }

    // Pass in extra tournament round argument
    public function create(User $user, TournamentStageRound $round): bool
    {
        return $round->stage->tournament->userIsOrganizer($user);
    }

    public function update(User $user, TournamentMatch $tournamentMatch): bool
    {
        return $tournamentMatch->tournament()->userIsOrganizer($user);
    }

    public function delete(User $user, TournamentMatch $tournamentMatch): bool
    {
        return $tournamentMatch->timestamp->isFuture()
            && $tournamentMatch->tournament()->userIsOrganizer($user);
    }

    public function restore(User $user, TournamentMatch $tournamentMatch): bool
    {
        return false;
    }

    public function forceDelete(User $user, TournamentMatch $tournamentMatch): bool
    {
        return false;
    }

    public function assignTeamToQualifierLobby(User $user, TournamentMatch $tournamentMatch): bool
    {
        $isQualifier = $tournamentMatch->round->stage->stage_format == TournamentStageFormat::Qualifier;
        $isFfa = $tournamentMatch->match_format == MatchFormat::FreeForAll;
        $isFuture = $tournamentMatch->timestamp->isFuture();

        if ($isQualifier && $isFfa && $isFuture && $tournamentMatch->tournament()->userIsOrganizer($user)) return true;

        $team = $user->teams()
            ->where('tournament_id', $tournamentMatch->tournament()->id)
            ->first();

        if (!$team) return false;

        $isCaptain = $team->captain()->is($user);

        $noOtherMatches = !$team->ffaMatches()
            ->where('tournament_stage_round_id', $tournamentMatch->round->id)
            ->exists();

        return $isQualifier && $isFfa && $isFuture && $isCaptain && $noOtherMatches;
    }

    public function withdrawTeamFromQualifierLobby(User $user, TournamentMatch $tournamentMatch): bool
    {
        $isQualifier = $tournamentMatch->round->stage->stage_format == TournamentStageFormat::Qualifier;
        $isFfa = $tournamentMatch->match_format == MatchFormat::FreeForAll;

        if ($isQualifier && $isFfa && $tournamentMatch->tournament()->userIsOrganizer($user)) return true;

        $isMoreThan1HourAhead = $tournamentMatch->timestamp->copy()->addHours(-1)->isFuture();

        $team = $user->teams()
            ->where('tournament_id', $tournamentMatch->tournament()->id)
            ->first();

        if (!$team) return false;

        $isCaptain = $team->captain()->is($user);
        $isParticipant = $team->ffaMatches->contains($tournamentMatch);

        return $isQualifier && $isFfa && $isMoreThan1HourAhead && $isCaptain && $isParticipant;
    }
}
