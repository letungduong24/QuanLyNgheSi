<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
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
            'views' => $this->faker->numberBetween(1000,99999),
            'album_id' => \App\Models\Album::inRandomOrder()->first()->id,
            'release_time' => $this->faker->date('Y-m-d'),
        ];
    }
}
