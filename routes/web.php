<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/songs', [SongController::class, 'index']);
Route::get('/songs/{id}', [SongController::class, 'show'])->name('songs.show');