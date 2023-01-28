<?php

namespace App\Console\Commands;

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
    protected $description = 'Give user role';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $username = $this->ask('Enter username');

        $user = User::where('username', $username)->first();

        if($user) {
            $roles = UserRoles::array();

            $role = $this->choice('Which role?', $roles);

            $role_id = array_search($role, $roles);

            if ($this->confirm(sprintf('Do you wish to give %s role %s', $username, $role), true)) {
                $user->roles()->create(['role' => $role_id]);

                $user->save();
            }

            $this->info('Done!');
        } else {
            $this->info('User not found!');
        }

    }
}
