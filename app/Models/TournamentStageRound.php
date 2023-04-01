<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TournamentStageRound extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tournament_stage_id',
        'name',
        'index',
        'starts_at',
        'ends_at',
        'round_text'
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function stage(): BelongsTo
    {
        return $this->belongsTo(TournamentStage::class);
    }

    public function maps(): HasMany
    {
        return $this->hasMany(TournamentStageRoundMap::class);
    }

    public function matches(): HasMany
    {
        return $this->hasMany(TournamentMatch::class)->orderBy('timestamp');
    }
}
