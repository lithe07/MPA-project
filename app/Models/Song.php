<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'artist', 'duration', 'genre_id'];

    // 🔗 Relatie: een song kan in meerdere playlists zitten
    public function savedLists()
    {
        return $this->belongsToMany(SavedList::class, 'saved_list_song')
                    ->withTimestamps();
    }

    // 🔗 Relatie: een song hoort bij een genre
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}