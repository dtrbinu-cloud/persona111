<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'xp',
        'level',
        'streak',
        'learning_character',
        'spotify_playlist_url',
        'last_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'last_login' => 'datetime',
        ];
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function wrongAnswers(): HasMany
    {
        return $this->hasMany(WrongAnswer::class);
    }
}
