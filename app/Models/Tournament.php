<?php

namespace App\Models;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tournament extends Model
{
    protected $casts = [
        'format' => TournamentFormat::class,
        'status' => TournamentStatus::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
