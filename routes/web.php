<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage (welkomstpagina)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (voor ingelogde gebruikers)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Gebruikersprofiel (alleen als ingelogd)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🎵 Liedjes overzicht en detail
Route::get('/songs', [SongController::class, 'index'])->name('songs.index');
Route::get('/songs/{id}', [SongController::class, 'show'])->name('songs.show');

// ➕ Voeg toe aan playlist
Route::post('/playlist/add/{id}', [PlaylistController::class, 'add'])->name('playlist.add');

// ❌ Verwijder uit playlist
Route::post('/playlist/remove/{id}', [PlaylistController::class, 'remove'])->name('playlist.remove');

// 📋 Bekijk huidige playlist (uit session)
Route::get('/playlist', [PlaylistController::class, 'index'])->name('playlist.index');

// Login, register, wachtwoord reset routes
require __DIR__.'/auth.php';