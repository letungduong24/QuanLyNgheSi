<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Artist; // Ensure you include the correct model namespace

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $artist = Artist::inRandomOrder()->first();

        return [
            'name' => $this->faker->word,
            'release_time' => $this->faker->date('Y-m-d'),
            // Fallback: If no artist exists, create one
            'artist_id' => $artist ? $artist->id : Artist::factory()->create()->id,
        ];
    }
}
