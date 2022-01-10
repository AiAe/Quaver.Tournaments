<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Player extends Authenticatable
{
    use HasFactory, Notifiable;

    const STATUS = [
        'resign' => 0,
        'new' => 1,
        'added' => 2
    ];

    protected $fillable = [
        'user_id',
        'data',
        'status'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'status',
        'user_id',
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
