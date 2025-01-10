<?php

namespace Database\Factories;

use App\Models\Songs_Artists;
use Illuminate\Database\Eloquent\Factories\Factory;
class Songs_ArtistsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $artistId = \App\Models\Artist::inRandomOrder()->first()->id;
            $songId = \App\Models\Song::inRandomOrder()->first()->id;
        } while (Songs_Artists::where('artist_id', $artistId)->where('song_id', $songId)->exists());

        return [
            'artist_id' => $artistId,
            'song_id' => $songId,
        ];
    }
}

