<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'status' => $this->faker->numberBetween(0, 1),
            'address' => $this->faker->address,
            'time' => $this->faker->date('Y-m-d'),
            'artist_id' => \App\Models\Artist::inRandomOrder()->first()->id,
        ];
    }
}
