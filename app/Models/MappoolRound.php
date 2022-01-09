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

}
