<?php

namespace Database\Factories;

use App\Enums\MatchFormat;
use App\Models\Team;
use App\Models\TournamentMatch;
use App\Models\TournamentStageRound;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TournamentMatchFactory extends Factory
{
    protected $model = TournamentMatch::class;

    public function definition(): array
    {
        return [
            'tournament_stage_round_id' => TournamentStageRound::inRandomOrder()->first()->id,
            'label' => $this->faker->word(),
            'match_format' => MatchFormat::OneVsOne,
            'quaver_mp_id' => [$this->faker->optional()->randomNumber(4)],
            'score1' => $this->faker->optional()->randomNumber(1),
            'score2' => $this->faker->optional()->randomNumber(1),
            'team1_id' => Team::inRandomOrder()->first()->id,
            'team2_id' => Team::inRandomOrder()->first()->id,
            'preceding_match1_id' => TournamentMatch::inRandomOrder()->first()?->id,
            'preceding_match2_id' => TournamentMatch::inRandomOrder()->first()?->id,
            'timestamp' => Carbon::now(),
        ];
    }
}
