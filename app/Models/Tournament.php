<?php

namespace App\Models;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Models\Scopes\UnlistedScope;
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

    protected $with = ['metas'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new UnlistedScope);
    }
}
