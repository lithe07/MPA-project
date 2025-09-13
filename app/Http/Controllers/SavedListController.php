<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\SavedList;

class SavedListController extends Controller
{
    // 📁 Toon alle opgeslagen playlists
    public function index()
    {
        $savedLists = SavedList::with('songs.genre')
            ->where('user_id', Auth::id())
            ->get();
        
        return view('saved.index', compact('savedLists'));
    }

    // 🔎 Detailpagina van één opgeslagen playlist
    public function show(SavedList $savedList)
    {
        // Controleer of de playlist van de huidige gebruiker is
        if ($savedList->user_id !== Auth::id()) {
            abort(403, 'Je hebt geen toegang tot deze playlist.');
        }

        // Liedjes van deze playlist ophalen
        $songs = $savedList->songs()->with('genre')->get();

        return view('saved.show', [
            'playlist' => $savedList,
            'songs' => $songs,
        ]);
    }

    // ✏️ Toon het formulier om een playlist te bewerken
    public function edit(SavedList $savedList)
    {
        return view('saved.edit', compact('savedList'));
    }

    // ✅ Update de naam van de playlist
    public function update(Request $request, SavedList $savedList)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $savedList->update(['name' => $request->name]);

        return redirect()->route('saved.index')->with('success', 'Playlist naam bijgewerkt!');
    }

    // ❌ Playlist verwijderen
    public function destroy($id)
    {
        $playlist = SavedList::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $playlist->delete();

        return redirect()->route('saved.index')->with('success', 'Playlist succesvol verwijderd!');
    }

    // ❌ Liedje verwijderen uit een playlist
    public function removeSong($playlistId, $songId)
    {
        // Zorg dat de playlist van de ingelogde gebruiker is
        $playlist = SavedList::where('id', $playlistId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Koppel de song los van de playlist (pivot rij weg)
        $playlist->songs()->detach($songId);

        return back()->with('success', 'Liedje verwijderd uit "' . $playlist->name . '".');
    }
}