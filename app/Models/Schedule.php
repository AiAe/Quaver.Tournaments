<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    const PLAYED = [
        'no' => 0,
        'yes' => 1,
    ];

    const NOTIFIED = [
        'no' => 0,
        'yes' => 1,
    ];

    protected $fillable = [
        'match_id',
        'playerRed',
        'playerBlue',
        'playerRedScore',
        'playerBlueScore',
        'referee',
        'streamer',
        'comm1',
        'comm2',
        'timestamp',
        'played',
        'notified'
    ];

}
