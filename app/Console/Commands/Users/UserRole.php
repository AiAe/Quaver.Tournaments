<?php

namespace App\Console\Commands\Users;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Console\Command;

class UserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give or remove role from user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = $this->ask('Enter username');

        $user = User::where('username', $username)->first();

        if ($user) {
            $userRoles = $user->roles->map->role;
            $roleLabels = [];

            foreach (UserRoles::cases() as $role) {
                $label = $role->name();
                if ($userRoles->contains($role)) {
                    $label .= ' (✓)';
                }
                $roleLabels[$role->value] = $label;
            }

            $roleId = array_search($this->choice('Which role?', $roleLabels), $roleLabels);
            $role = UserRoles::cases()[$roleId];

            if ($userRoles->contains($role)) {
                if ($this->confirm(sprintf('Do you wish to remove %s role from %s', $role->name(), $username),
                    true)) {
                    $user->roles()->firstWhere('role', $roleId)->delete();
                    $user->save();
                }
            } else {
                if ($this->confirm(sprintf('Do you wish to give %s role to %s', $role->name(), $username), true)) {
                    $user->roles()->create(['role' => $role]);
                    $user->save();
                }
            }

            $this->info('Done!');
        } else {
            $this->error('User not found!');
        }
    }
}
