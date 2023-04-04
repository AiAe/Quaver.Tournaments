<?php

namespace App\Policies;

use App\Models\Tournament;
use App\Models\TournamentMatch;
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

    // Pass in extra tournament argument
    public function create(User $user, Tournament $tournament): bool
    {
        return $user->is($tournament->user);
    }

    public function update(User $user, TournamentMatch $tournamentMatch): bool
    {
        return self::isOrganizer($user, $tournamentMatch);
    }

    private static function isOrganizer(User $user, TournamentMatch $tournamentMatch): bool
    {
        return $user->is($tournamentMatch->tournament()->user);
    }

    public function delete(User $user, TournamentMatch $tournamentMatch): bool
    {
        return $tournamentMatch->timestamp->isFuture() && self::isOrganizer($user, $tournamentMatch);
    }

    public function restore(User $user, TournamentMatch $tournamentMatch): bool
    {
        return false;
    }

    public function forceDelete(User $user, TournamentMatch $tournamentMatch): bool
    {
        return false;
    }
}
