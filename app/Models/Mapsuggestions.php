<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;

class Mapsuggestions extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'map_id',
        'map_type',
        'intended_stage',
        'additional_information',
        'map'
    ];

    protected $casts = [
        'map' => 'array'
    ];

    public static function fetchMap($url)
    {
        $match_map = preg_match('/https:\/\/quavergame\.com\/mapset\/map\/([0-9]*)/', $url, $matches);

        if ($match_map === 1) {
            $map_id = $matches[1];

            $response = Http::get('https://api.quavergame.com/v1/maps/' . $map_id);

            return $response->json();

        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
