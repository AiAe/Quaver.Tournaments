<?php

namespace App\Models;

use App\Enums\TournamentStageFormat;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TournamentStage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'index',
        'tournament_id',
        'stage_format',
        'stage_text'
    ];

    protected $casts = [
        'stage_format' => TournamentStageFormat::class
    ];

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    public function rounds(): HasMany
    {
        return $this->hasMany(TournamentStageRound::class, 'tournament_stage_id');
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
