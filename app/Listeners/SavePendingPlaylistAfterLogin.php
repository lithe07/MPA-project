<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Session;
use App\Services\Playlist;
use App\Models\SavedList;

class SavePendingPlaylistAfterLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;

        // Check of er een tijdelijke naam en playlist zijn
        $name = Session::get('pending_playlist_name');
        $songIds = Session::get('playlist', []);

        if ($name && !empty($songIds)) {
            // Opslaan in de database
            $savedList = SavedList::create([
                'user_id' => $user->id,
                'name' => $name,
            ]);

            $savedList->songs()->attach($songIds);

            // Opruimen
            Session::forget('playlist');
            Session::forget('pending_playlist_name');
        }
    }
}