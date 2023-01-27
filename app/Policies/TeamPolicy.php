<?php

namespace App\Policies;

use App\Enums\TournamentStatus;
use App\Enums\UserRoles;
use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole(UserRoles::Admin)) {
            return true;
        }
    }

    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Team $team): bool
    {
        return $user->can('view', $team->tournament);
    }

    public function create(User $user): bool
    {
        return !$user->hasRole(UserRoles::Blacklisted);
    }

    public function update(User $user, Team $team): bool
    {
        return $user->is($team->user) && $team->tournament->status == TournamentStatus::RegistrationsOpen;
    }

    public function delete(User $user, Team $team): bool
    {
        return $this->update($user, $team);
    }

    public function restore(User $user, Team $team): bool
    {
        return false;
    }

    public function forceDelete(User $user, Team $team): bool
    {
        return false;
    }
}
