<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;

class MappoolRound extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'position'
    ];

    public function maps() {
        return $this->hasMany(Mappool::class, 'mappool_round_id', 'id');
    }
}