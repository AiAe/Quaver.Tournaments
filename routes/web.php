<?php

use App\Http\Controllers\Auth\OAuthController;
use Illuminate\Support\Facades\Route;



Route::get('/oauth/{driver}', [OAuthController::class, 'redirectToProvider'])->name('oauth');
Route::get('/oauth/{driver}/callback', [OAuthController::class, 'handleProviderCallback'])->name('oauth.callback');

Route::get('/logout', [OAuthController::class, 'logout'])->name('logout');

Route::get('/', [\App\Http\Controllers\Home\HomeController::class, 'page'])->name('home');
