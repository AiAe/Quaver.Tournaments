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
            'quaver_user_id' => $this->faker->unique()->randomNumber(5),
            'discord_user_id' => $this->faker->optional(0.9)->randomNumber(9),
            'username' => substr($this->faker->userName(), 0, 14),
            'country' => $this->faker->countryCode(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
