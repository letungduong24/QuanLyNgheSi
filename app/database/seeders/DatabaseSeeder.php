<?php

namespace Database\Seeders;

use App\Models\Songs_Artists;
use App\Models\Songs_Categories;
use Illuminate\Database\Seeder;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Category;
use App\Models\Song;
use App\Models\SongArtist;
use App\Models\SongCategory;
use App\Models\Schedule;
use App\Models\ScheduleDetail;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Tạo dữ liệu cho Artist
        Artist::factory(10)->create();

        // Tạo dữ liệu cho Album
        Album::factory(10)->create();

        // Tạo dữ liệu cho Song liên kết với Album
        Song::factory(30)->create();
        Category::factory(3)->create();

        // Tạo dữ liệu cho SongArtist liên kết giữa Artist và Song
        Songs_Artists::factory(50)->create();

        // Tạo dữ liệu cho SongCategory liên kết giữa Song và Category
        Songs_Categories::factory(50)->create();

        // Tạo dữ liệu cho Schedule và liên kết với Artist
        Schedule::factory(20)->create();

        // Tạo dữ liệu cho ScheduleDetail liên kết giữa Schedule và Song
        ScheduleDetail::factory(40)->create();
    }
}
