<?php

namespace App\Models;

use App\Enums\TournamentStageFormat;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TournamentStage extends Model
{
    protected $casts = [
        'stage_format' => TournamentStageFormat::class
    ];

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    public function rounds(): HasMany
    {
        return $this->hasMany(TournamentStageRound::class);
    }

    protected function startsAt(): ?Carbon
    {
        return $this->rounds()->min('starts_at');
    }

    protected function endsAt(): ?Carbon
    {
        return $this->rounds()->max('ends_at');
    }
}