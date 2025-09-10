<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use App\Models\Song;

class Playlist
{
    protected $key = 'playlist';

    public function all()
    {
        return Session::get($this->key, []);
    }

    public function add($songId)
    {
        // dd("add() methond called with song ID: " . $songId);
        $playlist = $this->all();

        if (!in_array($songId, $playlist)) {
            $playlist[] = $songId;
            Session::put($this->key, $playlist);
        }
    }

    public function remove($songId)
    {
        $playlist = $this->all();
        $playlist = array_diff($playlist, [$songId]);
        Session::put($this->key, $playlist);
    }

    public function getSongs()
    {
        return Song::with('genre')->findMany($this->all());
    }

    public function totalDuration()
    {
        return $this->getSongs()->sum(function ($song) {
            [$min, $sec] = explode(':', $song->duration);
            return ((int) $min * 60) + (int) $sec;
        });
    }
}