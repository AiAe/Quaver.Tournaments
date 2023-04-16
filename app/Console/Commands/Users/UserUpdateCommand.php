<?php

namespace App\Console\Commands\Users;

use App\Enums\UserRoles;
use App\Jobs\UserUpdateJob;
use App\Models\User;
use Illuminate\Console\Command;

class UserUpdateCommand extends Command
{
    protected $signature = 'user:update';

    protected $description = 'Updates all user Quaver data';

    public function handle(): void
    {
        foreach (User::all() as $user) {
            $userRoles = $user->roles->map->role;

            if ($userRoles->contains(UserRoles::Blacklisted)) continue;

            UserUpdateJob::dispatch($user);
        }
    }
}
