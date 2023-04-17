<?php

namespace App\Policies;

use App\Enums\MatchFormat;
use App\Enums\TournamentStageFormat;
use App\Models\TournamentMatch;
use App\Models\TournamentStageRound;
use App\Models\User;
use Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class MatchPolicy
{
    use HandlesAuthorization;

    public static int $maxPlayersInLobby = 15;

    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, TournamentMatch $match): bool
    {
        // $user->can doesn't work when $user is null
        return Gate::forUser($user)->allows('view', $match->tournament());
    }

    // Pass in extra tournament round argument
    public function create(User $user, TournamentStageRound $round): bool
    {
        return $round->stage->tournament->userIsOrganizer($user);
    }

    public function update(User $user, TournamentMatch $match): bool
    {
        return $match->tournament()->userIsOrganizer($user);
    }

    public function delete(User $user, TournamentMatch $match): bool
    {
        return $match->timestamp->isFuture()
            && $match->tournament()->userIsOrganizer($user);
    }

    public function restore(User $user, TournamentMatch $match): bool
    {
        return false;
    }

    public function forceDelete(User $user, TournamentMatch $match): bool
    {
        return false;
    }

    public function assignTeamToQualifierLobby(User $user, TournamentMatch $match): bool
    {
        $isQualifier = $match->round->stage->stage_format == TournamentStageFormat::Qualifier;
        $isFfa = $match->match_format == MatchFormat::FreeForAll;
        $isFuture = $match->timestamp->isFuture();

        if (!($isQualifier && $isFfa && $isFuture)) {
            return false;
        }

        $team = app('loggedUserTeam');
        if (!$team) {
            return false;
        }

        if (!app('loggedUserTeamCaptain')) {
            return false;
        }

        $noOtherMatches = !$team->ffaMatches()
            ->where('tournament_stage_round_id', $match->round->id)
            ->exists();

        $lobbyNotFull = $match->ffaParticipants->count() < self::$maxPlayersInLobby;

        return $noOtherMatches && $lobbyNotFull;
    }

    public function withdrawTeamFromQualifierLobby(User $user, TournamentMatch $match): bool
    {
        $isQualifier = $match->round->stage->stage_format == TournamentStageFormat::Qualifier;
        $isFfa = $match->match_format == MatchFormat::FreeForAll;
        $isFuture = $match->timestamp->isFuture();

        if(!$isQualifier && $isFfa && $isFuture) return false;

        $isMoreThan1HourAhead = $match->timestamp->copy()->addHours(-1)->isFuture();

        $team = app('loggedUserTeam');

        if (!$team) {
            return false;
        }

        if (!app('loggedUserTeamCaptain')) {
            return false;
        }

        $isParticipant = $team->ffaMatches->contains($match);

        return $isMoreThan1HourAhead && $isParticipant;
    }

    public function editStaff(User $user, TournamentMatch $match)
    {
        $isFuture = $match->timestamp->isFuture();

        $tournament = $match->tournament();

        $organizer = $tournament->userIsOrganizer($user);
        $referee = $tournament->userIsReferee($user);
        $streamer = $tournament->userIsStreamer($user);
        $commentator = $tournament->userIsCommentator($user);

        return $organizer || ($isFuture && ($referee || $streamer || $commentator));
    }
}
