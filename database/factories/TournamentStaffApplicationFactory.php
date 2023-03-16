<?php

namespace Database\Factories;

use App\Enums\StaffApplicationStatus;
use App\Models\Tournament;
use App\Models\TournamentStaffApplication;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TournamentStaffApplicationFactory extends Factory
{
    protected $model = TournamentStaffApplication::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'tournament_id' => Tournament::factory(),
            'message' => $this->faker->paragraphs(3, true),
            'status' => StaffApplicationStatus::Pending,
        ];
    }
}
