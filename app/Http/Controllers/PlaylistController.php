<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Playlist;
use App\Models\Song;
use App\Models\SavedList;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlist = new Playlist();
        $songs = $playlist->getSongs();
        $totalDuration = $playlist->totalDuration();

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

    /**
     * GET: Toon formulier om playlist op te slaan
     */
    public function showSaveForm()
    {
        $playlist = new Playlist();
        $songs = $playlist->getSongs();

        if ($songs->isEmpty()) {
            return redirect()->route('playlist.index')->with('error', 'Je playlist is leeg.');
        }

        return view('playlist.save', ['songs' => $songs]);
    }

    /**
     * POST: Verwerk het opslaan van de playlist
     */
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $playlist = new Playlist();
        $songIds = $playlist->all();

        if (empty($songIds)) {
            return redirect()->route('playlist.index')->with('error', 'Playlist is leeg.');
        }

        $savedList = SavedList::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
        ]);

        $savedList->songs()->attach($songIds);

        session()->forget('playlist');

        return redirect()->route('playlist.index')->with('success', 'Playlist opgeslagen als "' . $savedList->name . '"!');
    }
}