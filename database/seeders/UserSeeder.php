<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = User::factory(25)->create();

        $i = 0;
        foreach (UserRoles::cases() as $case) {
            if ($case->value == UserRoles::User->value) {
                continue;
            }

            $user = $users[$i];
            $user->roles()->create(['role' => $case->value]);
            $i++;
        }
    }
}
