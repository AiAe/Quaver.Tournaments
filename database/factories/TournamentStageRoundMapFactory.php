<?php

namespace Database\Factories;

use App\Models\QuaverMap;
use App\Models\TournamentStageRoundMap;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TournamentStageRoundMapFactory extends Factory
{
    protected $model = TournamentStageRoundMap::class;

    public function definition(): array
    {
        $map = QuaverMap::inRandomOrder()->first();
        $category = $this->faker->word();

        return [
            'tournament_stage_round_id' => $this->faker->randomNumber(),
            'quaver_map_id' => $map->quaver_map_id,
            'index' => $this->faker->randomNumber(),
            'category' => $category,
            'sub_category' => $category.' '.$this->faker->word(),
            'mods' => fake()->optional()->randomElement(['NLN', 'NSV', '0.75x']),
            'offset' => fake()->numberBetween(-10, 10),
            'modded_difficulty' => $map->difficulty_rating * $this->faker->randomFloat(2, 0.75, 1.5),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
