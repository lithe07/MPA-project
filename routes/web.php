<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Http\Controllers\PlaylistController;


// Homepagina (eventueel later aanpassen)
Route::get('/', function () {
    return view('welcome');
});

// 🎵 Liedjes overzicht (met genre filtering)
Route::get('/songs', [SongController::class, 'index'])->name('songs.index');

// 🎵 Liedje detailpagina
Route::get('/songs/{id}', [SongController::class, 'show'])->name('songs.show');

// 🎧 Playlist routes
Route::get('/playlist', [PlaylistController::class, 'index'])->name('playlist.index');
Route::get('/playlist/add/{id}', [PlaylistController::class, 'add'])->name('playlist.add');
Route::get('/playlist/remove/{id}', [PlaylistController::class, 'remove'])->name('playlist.remove');