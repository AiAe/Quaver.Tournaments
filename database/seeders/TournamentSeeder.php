<?php

namespace Database\Seeders;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Database\Seeder;

class TournamentSeeder extends Seeder
{
    public function run()
    {
        $statuses = TournamentStatus::cases();
        Tournament::factory(5)
            ->sequence(fn($seq) => ['status' => $statuses[$seq->index]->value])
            ->create(['format' => TournamentFormat::Solo]);

        Tournament::factory()
            ->has(Team::factory(5)->has(User::factory(4), 'members'))
            ->create([
                'format' => TournamentFormat::Team,
                'status' => TournamentStatus::RegistrationsOpen
            ]);
    }
}
