<?php

namespace App\Policies;

use App\Enums\TournamentStatus;
use App\Enums\UserRoles;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TournamentPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Tournament $tournament): bool
    {
        return $tournament->status != TournamentStatus::Unlisted || $tournament->user->is($user);
    }

    public function create(User $user): bool
    {
        return $user->hasRole(UserRoles::Organizer);
    }

    public function update(User $user, Tournament $tournament): bool
    {
        return $tournament->user_id == $user->id;
    }

    public function delete(User $user, Tournament $tournament): bool
    {
        return $tournament->user_id == $user->id;
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
}
