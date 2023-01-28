<?php

namespace Database\Seeders;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStageFormat;
use App\Enums\TournamentStatus;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\TournamentStage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TournamentSeeder extends Seeder
{
    public function run()
    {
        $statuses = TournamentStatus::cases();
        Tournament::factory(5)
            ->sequence(fn($seq) => ['status' => $statuses[$seq->index]->value])
            ->create(['format' => TournamentFormat::Solo]);

        $this->createFullTournament([
            [TournamentStageFormat::Registration, 4],
            [TournamentStageFormat::Qualifier, 2],
            [TournamentStageFormat::Swiss, 6],
            [TournamentStageFormat::DoubleElimination, 4]
        ]);
    }

    private function createFullTournament(array $stages)
    {
        $tournament = Tournament::factory()
            ->create([
                'format' => TournamentFormat::Team,
                'status' => TournamentStatus::RegistrationsOpen
            ]);

        $this->createTeams($tournament, 5, 4);
        $this->createStages($tournament, $stages);
    }

    private function createTeams(Tournament $tournament, int $teamCount, int $memberCountPerTeam): void
    {
        Team::factory($teamCount)
            ->recycle($tournament)
            ->hasAttached(
                User::factory($memberCountPerTeam),
                new Sequence(fn($sequence) => ['is_captain' => $sequence->index % $memberCountPerTeam == 0]),
                'members'
            )->create();
    }

    private function createStages(Tournament $tournament, array $stages): void
    {
        $i = 0;
        $startsAt = Carbon::now();
        foreach ($stages as [$format, $weeks]) {
            $stage = $tournament->stages()
                ->create([
                    'name' => $format->name(),
                    'stage_format' => $format,
                    'index' => $i
                ]);

            $this->generateRounds($stage, $startsAt, $weeks);

            $startsAt->addWeeks($weeks);
            $i++;
        }
    }

    private function generateRounds(TournamentStage $stage, Carbon $startsAt, int $weeks): void
    {
        $format = $stage->stage_format;
        switch ($format) {
            case TournamentStageFormat::Qualifier:
            case TournamentStageFormat::SingleElimination:
            case TournamentStageFormat::DoubleElimination:
            case TournamentStageFormat::Swiss:
                for ($i = 0; $i < $weeks; $i++) {
                    $stage->rounds()->create([
                        'name' => sprintf('%s Round %s', $format->name(), $i + 1),
                        'starts_at' => $startsAt->copy()->addWeeks($i),
                        'ends_at' => $startsAt->copy()->addWeeks($i + 1),
                        'index' => $i
                    ]);
                }
                return;
            case TournamentStageFormat::Registration:
                $stage->rounds()->create([
                    'name' => "Registration",
                    'starts_at' => $startsAt,
                    'ends_at' => $startsAt->copy()->addWeeks($weeks),
                    'index' => 0
                ]);
                return;
        }
    }
}
