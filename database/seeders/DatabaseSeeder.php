<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Enums\UserRoles;
use App\Models\Tournament;
use App\Models\User;
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
        $this->seedUsers();
        $this->seedTournaments();
    }

    /**
     * @return void
     */
    private function seedUsers(): void
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

    /**
     * @return void
     */
    private function seedTournaments(): void
    {
        $statuses = TournamentStatus::cases();
        Tournament::factory(5)
            ->sequence(fn($seq) => ['status' => $statuses[$seq->index]->value])
            ->create(['format' => TournamentFormat::Solo]);

        Tournament::factory()->create([
            'format' => TournamentFormat::Team,
            'status' => TournamentStatus::RegistrationsOpen
        ]);
    }
}
