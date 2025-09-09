<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\SavedList; // ✅ importeer het juiste model

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * De velden die massaal ingevuld mogen worden.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Verberg deze velden in JSON-uitvoer.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Typecasts voor bepaalde velden.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relatie: een gebruiker heeft meerdere playlists (saved lists)
     */
    public function savedLists()
    {
        return $this->hasMany(SavedList::class);
    }
}