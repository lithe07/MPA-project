<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\SavedList;

class SavedListController extends Controller
{
    // Toon alle opgeslagen playlists van de ingelogde gebruiker
    public function index()
    {
        $user = Auth::user();

        $savedLists = SavedList::with('songs.genre')
                        ->where('user_id', $user->id)
                        ->get();

        return view('saved.index', compact('savedLists'));
    }
}