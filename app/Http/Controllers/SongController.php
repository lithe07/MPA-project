<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::with('genre')->get();
        return view('songs.index', compact('songs'));
    }

    public function show($id)
    {
        $song = Song::with('genre')->findOrFail($id);
        return view('songs.show', compact('song'));
    }
}