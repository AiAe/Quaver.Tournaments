<?php

namespace App\Models;

use App\Enums\UserRoles;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable = [
        'user_id',
        'role'
    ];

    protected $casts = [
        'role' => UserRoles::class
    ];
}
