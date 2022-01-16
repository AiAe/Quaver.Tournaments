<?php

use Illuminate\Support\Facades\Route;

Route::middleware('json.response')->prefix('v1')->as('v1.')->group(function() {
    Route::get('players', [\App\Http\Controllers\API\v1\Players\PlayersController::class, 'players']);
    Route::get('mappool', [\App\Http\Controllers\API\v1\Mappool\MappoolController::class, 'mappool']);
    Route::get('staff', [\App\Http\Controllers\API\v1\Staff\StaffController::class, 'staff']);
});
