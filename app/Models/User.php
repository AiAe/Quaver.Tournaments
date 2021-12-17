<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'quaver_user_id',
        'quaver_username',
        'discord_user_id',
        'discord_username',
        'timezone'
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
    ];
}
