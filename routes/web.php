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

// 🏠 Home = liedjesoverzicht
Route::get('/', [SongController::class, 'index'])->name('Homepage');

// 📊 Dashboard (alleen ingelogd)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔐 Auth routes (Breeze)
require __DIR__.'/auth.php';

// ✅ Playlist opslaan (GET mag voor iedereen om formulier te zien; POST alleen ingelogd)
Route::get('/playlist/save', [PlaylistController::class, 'showSaveForm'])->name('playlist.save.form');
Route::post('/playlist/save', [PlaylistController::class, 'save'])->middleware('auth')->name('playlist.save');

// 🧠 Auto-save route na login/registratie (indien gebruikt)
Route::get('/playlist/auto-save', [PlaylistController::class, 'autoSave'])
    ->middleware('auth')
    ->name('playlist.autoSave');

// 👤 Gebruikersprofiel + opgeslagen playlists (alleen ingelogd)
Route::middleware('auth')->group(function () {
    // Profiel
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 📁 Overzicht opgeslagen playlists
    Route::get('/mijn-playlists', [SavedListController::class, 'index'])->name('saved.index');

    // 🔎 Detailpagina van één playlist (album)
    Route::get('/mijn-playlists/{savedList}', [SavedListController::class, 'show'])->name('saved.show');

    // ✏️ Naam van playlist wijzigen (formulier + update)
    Route::get('/mijn-playlists/{savedList}/edit', [SavedListController::class, 'edit'])->name('saved.edit');
    Route::patch('/mijn-playlists/{savedList}', [SavedListController::class, 'update'])->name('saved.update');

    // 🗑️ Playlist (album) verwijderen
    Route::delete('/mijn-playlists/{savedList}', [SavedListController::class, 'destroy'])->name('saved.destroy');

    // ❌ Liedje uit opgeslagen playlist verwijderen (gebruiken we straks op de detailpagina)
    Route::delete('/mijn-playlists/{savedList}/songs/{song}', [SavedListController::class, 'removeSong'])
        ->name('saved.removeSong');
});

// 🎵 Liedjes overzicht & detail (publiek)
Route::get('/songs', [SongController::class, 'index'])->name('songs.index');
Route::get('/songs/{id}', [SongController::class, 'show'])->name('songs.show');

// 🧺 Tijdelijke (session) playlist voor bezoeker
Route::post('/playlist/add/{id}', [PlaylistController::class, 'add'])->name('playlist.add');
Route::post('/playlist/remove/{id}', [PlaylistController::class, 'remove'])->name('playlist.remove');
Route::get('/playlist', [PlaylistController::class, 'index'])->name('playlist.index');