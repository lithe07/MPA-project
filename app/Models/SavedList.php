<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedList extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    // 🔗 Relatie: een playlist bevat meerdere liedjes
    public function songs()
    {
        return $this->belongsToMany(Song::class, 'saved_list_song')
                    ->withTimestamps();
    }

    // 🔗 Relatie: een playlist hoort bij een gebruiker
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}