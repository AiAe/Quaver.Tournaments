<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuaverMap extends Model
{
    protected $fillable = [
        'quaver_map_id',
        'quaver_mapset_id',
        'quaver_creator_id',
        'creator_username',
        'game_mode',
        'ranked_status',
        'artist',
        'title',
        'difficulty_name',
        'length',
        'bpm',
        'difficulty_rating',
        'count_hitobject_normal',
        'count_hitobject_long',
    ];

    public static function quaverDataToAttributes(array $data): array
    {
        return [
            'quaver_map_id' => $data['id'],
            'quaver_mapset_id' => $data['mapset_id'],
            'quaver_creator_id' => $data['creator_id'],
            'creator_username' => $data['creator_username'],
            'game_mode' => $data['game_mode'],
            'ranked_status' => $data['ranked_status'],
            'artist' => $data['artist'],
            'title' => $data['title'],
            'difficulty_name' => $data['difficulty_name'],
            'length' => $data['length'],
            'bpm' => $data['bpm'],
            'difficulty_rating' => $data['difficulty_rating'],
            'count_hitobject_normal' => $data['count_hitobject_normal'],
            'count_hitobject_long' => $data['count_hitobject_long'],
        ];
    }

    public function tournamentUses(): HasMany
    {
        return $this->hasMany(TournamentStageRoundMap::class);
    }

    public function __toString(): string
    {
        return "{$this->artist} - {$this->title} [{$this->difficulty_name}] ({$this->creator_username})";
    }

    public function quaverUrl(): string
    {
        $id = $this->quaver_map_id;
        return "https://quavergame.com/mapsets/map/{$id}";
    }
}
