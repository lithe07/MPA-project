<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Genre;

class SongController extends Controller
{
    /**
     * Toon alle liedjes, eventueel gefilterd op genre.
     */
    public function index(Request $request)
    {
        // Haal alle genres op voor de dropdown
        $genres = Genre::all();

        // Haal het gekozen genre-ID op uit de querystring
        $genreId = $request->input('genre');

        // Als er een genre gekozen is, filter op genre_id
        if ($genreId) {
            $songs = Song::with('genre')
                ->where('genre_id', $genreId)
                ->get();
        } else {
            // Anders, toon alle liedjes
            $songs = Song::with('genre')->get();
        }

        // Geef zowel songs als genres door aan de view
        return view('songs.index', compact('songs', 'genres'));
    }

    /**
     * Toon de detailpagina van één liedje.
     */
    public function show($id)
    {
        $song = Song::with('genre')->findOrFail($id);
        return view('songs.show', compact('song'));
    }
}