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
}