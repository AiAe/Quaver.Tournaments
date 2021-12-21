<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLES = [
        1 => 'User',
        2 => 'Referee',
        100 => 'Admin',
    ];

    protected $fillable = [
        'quaver_user_id',
        'quaver_username',
        'quaver_avatar',
        'discord_user_id',
        'discord_username',
        'role'
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
    ];

    public function getRole() {
        return self::ROLES[$this->role];
    }
}
