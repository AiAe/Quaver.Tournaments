<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TournamentStageRoundMap extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tournament_stage_round_id',
        'quaver_map_id',
        'category',
        'sub_category',
        'mods',
        'offset',
        'modded_difficulty',
        'modded_bpm',
        'index'
    ];

    public function scope(Builder $query): Builder
    {
        return $query->orderBy('index', 'asc');
    }

    public function round(): BelongsTo
    {
        return $this->belongsTo(TournamentStageRound::class);
    }

    public function map(): BelongsTo
    {
        return $this->belongsTo(QuaverMap::class, 'quaver_map_id', 'quaver_map_id');
    }
}
