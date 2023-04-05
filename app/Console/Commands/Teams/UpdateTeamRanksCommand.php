<?php

namespace App\Console\Commands\Teams;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Models\Tournament;
use Illuminate\Console\Command;

class UpdateTeamRanksCommand extends Command
{
    protected $signature = 'team:update-ranks';

    protected $description = 'Populate team ranks table';

    public function handle(): void
    {
        $tournaments = Tournament::whereNot('status', TournamentStatus::Concluded)
            ->where('format', TournamentFormat::Team)
            ->with(['teams', 'teams.teamRank'])
            ->get();

        $teams = $tournaments->flatMap->teams->unique('id');

        foreach ($teams as $team) {
            $team->updateTeamRank();
        }

        $this->info("Done updating team ranks for {$teams->count()} teams");
    }
}
