<?php

namespace App\Models;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kodeine\Metable\Metable;

class Tournament extends Model
{
    use Metable, HasFactory;

    protected $casts = [
        'format' => TournamentFormat::class,
        'status' => TournamentStatus::class
    ];

    public $defaultMetaValues = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
