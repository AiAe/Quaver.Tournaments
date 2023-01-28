<?php

namespace App\Models;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kodeine\Metable\Metable;

class Tournament extends Model
{
    use Metable, HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'format',
        'status'
    ];

    protected $casts = [
        'format' => TournamentFormat::class,
        'status' => TournamentStatus::class
    ];

    protected $with = ['metas'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function stages(): HasMany
    {
        return $this->hasMany(TournamentStage::class);
    }

    public function participants()
    {
        return $this->teams->flatMap->members;
    }
}
