<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Form extends Authenticatable
{
    use HasFactory, Notifiable;

    const TYPE = [
        'staff' => 1
    ];

    const STATUS = [
        'new' => 1,
        'rejected' => 2,
        'accepted' => 3
    ];

    protected $fillable = [
        'user_id',
        'data',
        'type',
        'status'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
