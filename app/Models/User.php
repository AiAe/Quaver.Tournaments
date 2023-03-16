<?php

namespace App\Models;

use App\Enums\UserRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'quaver_user_id',
        'discord_user_id',
        'username',
        'country'
    ];

    protected $hidden = [
        'remember_token'
    ];

    public function roles(): HasMany
    {
        return $this->hasMany(UserRole::class, 'user_id', 'id');
    }

    public function addRole(UserRoles $role): UserRole
    {
        return $this->roles()->create(['role' => $role]);
    }

    public function hasRole(UserRoles $role): bool
    {
        return $this->roles()->firstWhere('role', $role) != null;
    }

    public function hostedTournaments(): HasMany
    {
        return $this->hasMany(Tournament::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class)
            ->withPivot('is_captain')
            ->withTimestamps();
    }

    // Counterpart of Tournament->participants()
    public function participatedTournaments()
    {
        return $this->teams->map->tournament;
    }

    public function invites()
    {
        return $this->belongsToMany(Team::class, 'team_user_invites')->withTimestamps();
    }

    public function staffedTournaments(): BelongsToMany
    {
        return $this->belongsToMany(Tournament::class, 'tournament_staff')
            ->using(TournamentStaff::class)
            ->orderByPivot('staff_role');
    }

    public function quaverUrl(): string
    {
        $id = $this->quaver_user_id;
        return "https://quavergame.com/user/{$id}";
    }
}
