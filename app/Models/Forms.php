<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Forms extends Authenticatable
{
    use HasFactory, Notifiable;

    const TYPE = [
        'staff' => 1,
        'player' => 2
    ];

    protected $fillable = [
        'user_id',
        'data',
        'type'
    ];

    protected $casts = [
        'data' => 'array'
    ];
}
