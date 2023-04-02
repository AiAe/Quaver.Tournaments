<?php

namespace App\Models;

use App\Enums\StaffRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TournamentStaff extends Model
{
    public $incrementing = true;

    protected $fillable = [
        'tournament_id',
        'user_id',
        'staff_role'
    ];

    protected $casts = [
        'staff_role' => StaffRole::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }
}
