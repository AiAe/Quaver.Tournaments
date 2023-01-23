<?php

namespace App\Http\QuaverApi;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Log;

class QuaverApi
{
    private static function request(string $endpoint, array $query = [], ?string $defaultKey = null)
    {
        $cacheKey = "quaver/$endpoint?".implode('&', $query);

        if (Cache::has($cacheKey)) {
            $json = json_decode(Cache::get($cacheKey), true);
        }

        $response = Http::quaver()->get($endpoint, $query);

        if ($response->failed()) {
            $status = $response->status();
            Log::error("Request to $cacheKey failed with status $status");
            return null;
        }

        $json = $response->json();

        if ($json['status'] != 200) {
            $why = $json['message'];
            Log::error("Request to $cacheKey failed with message $why");
            return null;
        }

        Cache::put($cacheKey, $response->body(), Carbon::now()->addMinutes(10));

        if ($defaultKey) {
            return $json[$defaultKey];
        }

        return $json;
    }

    public static function getUserFull(int $id) {
        return self::request("users/full/$id", [], 'user');
    }

    public static function getMap(int $id) {
        return self::request("maps/$id", [], 'map');
    }
}
