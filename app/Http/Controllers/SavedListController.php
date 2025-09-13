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

        // Songs + genre ophalen
        $savedList->load('songs.genre');

        return view('saved.show', compact('savedList'));
    }

    // ✏️ Toon het formulier om een playlist te bewerken
    public function edit(SavedList $savedList)
    {
        if ($savedList->user_id !== Auth::id()) {
            abort(403, 'Je hebt geen toegang om deze playlist te bewerken.');
        }

        return view('saved.edit', compact('savedList'));
    }

    // ✅ Update de naam van de playlist
    public function update(Request $request, SavedList $savedList)
    {
        if ($savedList->user_id !== Auth::id()) {
            abort(403, 'Je hebt geen toegang om deze playlist te bewerken.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $savedList->update(['name' => $request->name]);

        return redirect()->route('saved.index')->with('success', 'Playlist naam bijgewerkt!');
    }

    // ❌ Playlist verwijderen
    public function destroy(SavedList $savedList)
    {
        if ($savedList->user_id !== Auth::id()) {
            abort(403, 'Je hebt geen toegang om deze playlist te verwijderen.');
        }

        $savedList->delete();

        return redirect()->route('saved.index')->with('success', 'Playlist succesvol verwijderd!');
    }

    // ❌ Liedje verwijderen uit een playlist
    public function removeSong(SavedList $savedList, $songId)
    {
        if ($savedList->user_id !== Auth::id()) {
            abort(403, 'Je hebt geen toegang om deze playlist te wijzigen.');
        }

        $savedList->songs()->detach($songId);

        return back()->with('success', 'Liedje verwijderd uit "' . $savedList->name . '".');
    }
}