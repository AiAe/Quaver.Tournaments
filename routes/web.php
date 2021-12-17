<?php

use App\Http\Controllers\Auth\OAuthController;
use Illuminate\Support\Facades\Route;



Route::get('oauth/{driver}', [OAuthController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleProviderCallback'])->name('social.callback');


Route::get('/', [\App\Http\Controllers\Home\HomeController::class, 'page'])->name('home');
