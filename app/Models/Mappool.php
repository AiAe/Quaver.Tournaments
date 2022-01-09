<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mappool extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'mappool_round_id',
        'category',
        'type',
        'map',
        'data',
        'position'
    ];

    protected $casts = [
        'map' => 'array',
        'data' => 'array'
    ];

}
