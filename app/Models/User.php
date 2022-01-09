<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

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

    public function fetchUserStats() {
        return Cache::remember('quaver_user_' . $this->quaver_user_id, 600, function () {
            // ToDo support both modes
            $mode = 'keys4';

            $response = Http::get('https://api.quavergame.com/v1/users/full/' . $this->quaver_user_id);
            $user = $response->json()['user'];

            return [
                "globalRank" => $user[$mode]['globalRank'],
                "country" => $user['info']['country']
            ];
        });
    }

    public function updateQuaverUsername() {
        $response = Http::get('https://api.quavergame.com/v1/users?id=' . $this->quaver_user_id);
        $user = $response->json()['users'][0];

        $this->quaver_username = $user['username'];
        $this->save();
    }

    public function createChallongePlayer() {
        Http::post('https://api.challonge.com/v1/tournaments/'.config('app.challonge_slug').'/participants.json', [
            'api_key' => config('app.challonge_api'),
            'name' => $this->quaver_username
        ]);
    }
}
