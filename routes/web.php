<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavedListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🏠 Welkomstpagina
Route::get('/', [SongController::class, 'index'])->name('Homepage');


// 📊 Dashboard (voor ingelogde gebruikers)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 👤 Profielbeheer en gebruikersroutes
Route::middleware('auth')->group(function () {
    // Profiel bewerken
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 💾 Playlist opslaan (GET + POST)
    Route::get('/playlist/save', [PlaylistController::class, 'showSaveForm'])->name('playlist.save.form');
    Route::post('/playlist/save', [PlaylistController::class, 'save'])->name('playlist.save');

    // 📁 Opgeslagen playlists bekijken
    Route::get('/mijn-playlists', [SavedListController::class, 'index'])->name('saved.index');
});

// 🎵 Liedjes overzicht en detail
Route::get('/songs', [SongController::class, 'index'])->name('songs.index');
Route::get('/songs/{id}', [SongController::class, 'show'])->name('songs.show');

// ➕ Voeg toe aan playlist
Route::post('/playlist/add/{id}', [PlaylistController::class, 'add'])->name('playlist.add');

// ❌ Verwijder uit playlist
Route::post('/playlist/remove/{id}', [PlaylistController::class, 'remove'])->name('playlist.remove');

// 📋 Bekijk huidige (tijdelijke) playlist
Route::get('/playlist', [PlaylistController::class, 'index'])->name('playlist.index');

// 🔐 Login, registratie en wachtwoord reset
require __DIR__.'/auth.php';