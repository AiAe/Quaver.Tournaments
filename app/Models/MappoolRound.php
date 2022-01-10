<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class MappoolRound extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'position'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'position',
        'status',
        'id'
    ];

    public function maps()
    {
        return $this->hasMany(Mappool::class, 'mappool_round_id', 'id')
            ->orderBy('position', 'asc');
    }
}
