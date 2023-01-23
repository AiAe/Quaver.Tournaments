<?php

namespace Database\Seeders;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Models\Tournament;
use Illuminate\Database\Seeder;

class TournamentSeeder extends Seeder
{
    public function run()
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
