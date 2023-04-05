<?php

namespace App\Observers;

use App\Enums\UserRoles;
use App\Http\QuaverApi\QuaverApi;
use App\Models\User;
use App\Models\UserRole;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        UserRole::create([
            'user_id' => $user->id,
            'role' => UserRoles::User->value
        ]);

        $this->updateUser($user);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $this->updateUser($user);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        $this->updateUser($user);
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }

    private function updateUser(User $user)
    {
        dispatch(function () use ($user) {
            $user_api = QuaverApi::getUserFull($user->quaver_user_id);

            if ($user_api) {
                $user->username = $user_api['info']['username'];
                $user->country = $user_api['info']['country'] ?? 'XX';
                $user->quaver_4k_rank = $user_api['keys4']['globalRank'];
                $user->quaver_7k_rank = $user_api['keys7']['globalRank'];
                $user->save();

                foreach ($user->teams as $team) {
                    $team->updateTeamRank();
                }
            }
        });
    }
}
