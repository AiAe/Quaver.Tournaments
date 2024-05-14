<?php

namespace App\Policies;

use App\Enums\StaffRole;
use App\Enums\TournamentStatus;
use App\Enums\UserRoles;
use App\Models\Tournament;
use App\Models\TournamentStageRound;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TournamentPolicy
{
    use HandlesAuthorization;

    public function before(): bool|null
    {
        if(!app()->isProduction() && Auth::user() && Auth::user()->hasRole(UserRoles::Admin)) return true;

        return null;
    }

    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Tournament $tournament): bool
    {
        return $tournament->status != TournamentStatus::Unlisted
            || ($user && $tournament->userIsOrganizer($user));
    }

    public function create(User $user): bool
    {
        return $user->hasRole(UserRoles::Organizer);
    }

    public function update(User $user, Tournament $tournament): bool
    {
        return $tournament->userIsOrganizer($user);
    }

    public function delete(User $user, Tournament $tournament): bool
    {
        return $tournament->userIsOrganizer($user);
    }

    public function restore(User $user, Tournament $tournament): bool
    {
        return false;
    }

    public function forceDelete(User $user, Tournament $tournament): bool
    {
        return false;
    }

    public function viewUnlisted(User $user): bool
    {
        return false;
    }

    public function updateMappool(User $user, Tournament $tournament, TournamentStageRound $round): bool
    {
        $roundHasNotEndedYet = $round->ends_at->isFuture();

        $userCanUpdate = $this->update($user, $tournament)
            || $tournament->userHasStaffRole($user, StaffRole::HeadMappooler);

        return $roundHasNotEndedYet && $userCanUpdate;
    }

    public function viewPlayers(User $user, Tournament $tournament): bool
    {
        return $this->update($user, $tournament)
            || $tournament->userHasStaffRole($user, StaffRole::HeadReferee)
            || $tournament->userHasStaffRole($user, StaffRole::HeadStreamer);
    }
}
