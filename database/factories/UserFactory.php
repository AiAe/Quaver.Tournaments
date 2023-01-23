<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'quaver_user_id' => $this->faker->unique()->randomNumber(),
            'discord_user_id' => $this->faker->optional(0.9)->randomNumber(),
            'username' => $this->faker->userName(),
            'country' => $this->faker->countryCode(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
