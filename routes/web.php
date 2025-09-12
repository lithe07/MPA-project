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

// 🔐 Login, registratie en wachtwoord reset
require __DIR__.'/auth.php';

// ✅ Playlist opslaan (GET mag voor iedereen, POST alleen voor ingelogden)
Route::get('/playlist/save', [PlaylistController::class, 'showSaveForm'])->name('playlist.save.form');
Route::post('/playlist/save', [PlaylistController::class, 'save'])->middleware('auth')->name('playlist.save');

// 🧠 Auto-save route na login/registratie
Route::get('/playlist/auto-save', [PlaylistController::class, 'autoSave'])
    ->middleware('auth')
    ->name('playlist.autoSave');

// 👤 Profielbeheer en routes voor ingelogden
Route::middleware('auth')->group(function () {
    // Profiel bewerken
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 📁 Opgeslagen playlists bekijken
    Route::get('/mijn-playlists', [SavedListController::class, 'index'])->name('saved.index');

    // ✏️ Playlist bewerken (naam wijzigen)
    Route::get('/mijn-playlists/{id}/edit', [SavedListController::class, 'edit'])->name('saved.edit');
    Route::put('/mijn-playlists/{id}', [SavedListController::class, 'update'])->name('saved.update');

    // ❌ Playlist verwijderen
    Route::delete('/mijn-playlists/{id}', [SavedListController::class, 'destroy'])->name('saved.destroy');
});

// 🎵 Liedjes overzicht en detail
Route::get('/songs', [SongController::class, 'index'])->name('songs.index');
Route::get('/songs/{id}', [SongController::class, 'show'])->name('songs.show');

// ➕ Voeg toe aan tijdelijke playlist (session)
Route::post('/playlist/add/{id}', [PlaylistController::class, 'add'])->name('playlist.add');

// ❌ Verwijder uit tijdelijke playlist
Route::post('/playlist/remove/{id}', [PlaylistController::class, 'remove'])->name('playlist.remove');

// 📋 Bekijk huidige (tijdelijke) playlist
Route::get('/playlist', [PlaylistController::class, 'index'])->name('playlist.index');