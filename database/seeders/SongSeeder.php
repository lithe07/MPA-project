<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Song; // ✅ importeer het Song model

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Song::create([
            'name' => 'Bohemian Rhapsody',
            'artist' => 'Queen',
            'duration' => '5:55',
            'genre_id' => 1, // Rock
        ]);

        Song::create([
            'name' => 'Imagine',
            'artist' => 'John Lennon',
            'duration' => '3:04',
            'genre_id' => 2, // Pop
        ]);

        Song::create([
            'name' => 'Take Five',
            'artist' => 'Dave Brubeck',
            'duration' => '5:24',
            'genre_id' => 3, // Jazz
        ]);

        Song::create([
            'name' => 'Lose Yourself',
            'artist' => 'Eminem',
            'duration' => '5:20',
            'genre_id' => 4, // Hip-Hop
        ]);

        Song::create([
            'name' => 'Für Elise',
            'artist' => 'Beethoven',
            'duration' => '2:53',
            'genre_id' => 5, // Classical
        ]);
    }
}