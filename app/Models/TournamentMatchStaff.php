<?php

namespace App\Models;

use App\Enums\StaffRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TournamentMatchStaff extends Model
{
    protected $fillable = [
        'match_id',
        'user_id',
        'role',
    ];

    protected $casts = ['role' => StaffRole::class];

    public function match(): BelongsTo
    {
        return $this->belongsTo(TournamentMatch::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
