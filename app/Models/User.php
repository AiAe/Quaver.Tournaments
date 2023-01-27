<?php

namespace App\Models;

use App\Enums\UserRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    public function hasRole(UserRoles $role): bool
    {
        return $this->roles()->firstWhere('role', $role)->count() == 1;
    }

    public function tournaments(): HasMany
    {
        return $this->hasMany(Tournament::class);
    }
}
