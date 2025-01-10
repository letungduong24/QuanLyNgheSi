<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScheduleDetail>
 */
class ScheduleDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Lấy một dòng ngẫu nhiên từ bảng songs_artists
        $songArtist = \App\Models\Songs_Artists::inRandomOrder()->first();

        return [
            'schedule_id' => \App\Models\Schedule::inRandomOrder()->first()->id,
            'song_id' => $songArtist->song_id,    
            'artist_id' => $songArtist->artist_id, 
            'cast' => $this->faker->numberBetween(1000, 1000000)
        ];
    }
}
