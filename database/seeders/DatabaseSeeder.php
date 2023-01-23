<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\UserRoles;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $users = User::factory(25)->create();

        $i = 0;
        foreach (UserRoles::cases() as $case) {
            if ($case->value == UserRoles::User->value) continue;

            $user = $users[$i];
            $user->roles()->create(['role' => $case->value]);
            $i++;
        }
    }
}
