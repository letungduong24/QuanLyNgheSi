<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'birthday' => $this->faker->date('Y-m-d'),
            'gender' => $this->faker->randomElement(['Male', 'Female', 'Other']),
            'artist_field' => $this->faker->randomElement(['Ca sĩ', 'Nghệ sĩ trình diễn']),
            'status' => $this->faker->numberBetween(0, 1),
            'join_time' => $this->faker->date('Y-m-d'),
            'expired_time' => $this->faker->date('Y-m-d'),
        ];
    }
}
