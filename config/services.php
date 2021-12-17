<?php

return [
    'quaver' => [
        'client_id' => env('QUAVER_CLIENT_ID'),
        'client_secret' => env('QUAVER_SECRET'),
        'redirect' => env('QUAVER_REDIRECT')
    ],
    'discord' => [
        'client_id' => env('DISCORD_CLIENT_ID'),
        'client_secret' => env('DISCORD_SECRET'),
        'redirect' => env('DISCORD_REDIRECT')
    ],
];
