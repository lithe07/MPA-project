<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Playlist;
use App\Models\Song;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlist = new Playlist();
        $songs = $playlist->getSongs();
        $totalDuration = $playlist->totalDuration();
        // dd($playlist->all());

        return view('playlist.index', [
            'playlist' => $songs,
            'totalDuration' => $totalDuration,
        ]);
    }

    public function add($id)
    {
        $playlist = new Playlist();
        $playlist->add($id);

        return redirect()->back()->with('success', 'Liedje toegevoegd aan playlist!');
    }

    public function remove($id)
    {
        $playlist = new Playlist();
        $playlist->remove($id);

        return redirect()->back()->with('success', 'Liedje verwijderd uit playlist!');
    }
}