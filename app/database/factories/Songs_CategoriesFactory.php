<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Songs_Categories;

class Songs_CategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $songId = \App\Models\Song::inRandomOrder()->first()->id;
            $categoryId = \App\Models\Category::inRandomOrder()->first()->id;
        } while (Songs_Categories::where('song_id', $songId)->where('category_id', $categoryId)->exists());

        return [
            'song_id' => $songId,
            'category_id' => $categoryId,
        ];
    }
}

