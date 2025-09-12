<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Playlist;
use App\Models\Song;
use App\Models\SavedList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlist = new Playlist();
        $songs = $playlist->getSongs();
        $totalDuration = $playlist->totalDuration();

        // ✅ Opgeslagen playlists ophalen voor ingelogde gebruiker
        $savedLists = null;
        if (Auth::check()) {
            $savedLists = SavedList::with('songs.genre')
                ->where('user_id', Auth::id())
                ->get();
        }

        return view('playlist.index', [
            'playlist' => $songs,
            'totalDuration' => $totalDuration,
            'savedLists' => $savedLists, // ✅ meegeven aan view
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

    public function showSaveForm()
    {
        $defaultName = Session::get('pending_playlist_name', '');
        return view('playlist.save', ['defaultName' => $defaultName]);
    }

    public function save(Request $request)
    {
        $playlist = new Playlist();
        $songIds = $playlist->all();

        if (empty($songIds)) {
            return redirect()->route('playlist.index')->with('error', 'Playlist is leeg.');
        }

        // ✅ Bezoeker: sla naam tijdelijk op in session & stuur naar login
        if (!Auth::check()) {
            Session::put('pending_playlist_name', $request->name);
            return redirect()->route('login')->with('info', 'Log in om je playlist op te slaan.');
        }

        // ✅ Ingelogde gebruiker: opslaan in database
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $savedList = SavedList::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
        ]);

        $savedList->songs()->attach($songIds);

        // Playlist en tijdelijke naam opruimen
        session()->forget('playlist');
        session()->forget('pending_playlist_name');

        return redirect()->route('playlist.index')->with('success', 'Playlist opgeslagen als "' . $savedList->name . '"!');
    }

    // ✅ Automatisch opslaan NA login
    public function autoSave()
    {
        $songIds = session('playlist', []);
        $name = session('pending_playlist_name');

        if (empty($songIds) || !$name) {
            return redirect()->route('playlist.index')->with('error', 'Geen playlist om op te slaan.');
        }

        $savedList = SavedList::create([
            'user_id' => Auth::id(),
            'name' => $name,
        ]);

        $savedList->songs()->attach($songIds);

        session()->forget('playlist');
        session()->forget('pending_playlist_name');

        return redirect()->route('saved.index')->with('success', 'Je playlist "' . $name . '" is succesvol opgeslagen!');
    }
}