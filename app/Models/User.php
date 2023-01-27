<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'quaver_user_id',
        'discord_user_id',
        'username',
        'country'
    ];

    public function roles(): HasMany
    {
        return $this->hasMany(UserRole::class, 'user_id', 'id');
    }

    public function tournaments(): HasMany
    {
        return $this->hasMany(Tournament::class);
    }

    public function captainTeams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function memberTeams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
}
