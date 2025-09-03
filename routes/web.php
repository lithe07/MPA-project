<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;

Route::get('/', function () {
    return view('welcome');
});

// Route naar het liedjesoverzicht met filtering
Route::get('/songs', [SongController::class, 'index'])->name('songs.index');

// Route naar detailpagina van een liedje
Route::get('/songs/{id}', [SongController::class, 'show'])->name('songs.show');