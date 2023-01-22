<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'quaver_user_id',
        'discord_user_id',
        'username',
        'country'
    ];

    public function user_role(): HasMany
    {
        return $this->hasMany(UserRole::class, 'user_id', 'id');
    }
}
