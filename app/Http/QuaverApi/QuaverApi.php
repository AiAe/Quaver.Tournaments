<?php

namespace App\Http\QuaverApi;

use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Log;

class QuaverApi
{
    /**
     * @throws Exception
     */
    private static function request(string $endpoint, array $query = [], ?string $defaultKey = null)
    {
        $cacheKey = "quaver/$endpoint?".implode('&', $query);

        if (Cache::has($cacheKey)) {
            $json = json_decode(Cache::get($cacheKey), true);
        } else {
            $response = Http::quaver()->get($endpoint, $query);

            if ($response->failed()) {
                $message = sprintf("Request to %s failed with status %s", $cacheKey, $response->status());
                Log::error($message);
                throw new Exception($message);
            }

            $json = $response->json();

            if ($json['status'] != 200) {
                $message = sprintf("Request to %s failed with message %s", $cacheKey, $json['message']);
                Log::error($message);
                throw new Exception($message);
            }

            Cache::put($cacheKey, $response->body(), Carbon::now()->addMinutes(10));
        }

        if ($defaultKey) {
            return $json[$defaultKey];
        }

        return $json;
    }

    /**
     * @throws Exception
     */
    public static function getUser(int $id)
    {
        return self::request("users", [
            'id' => $id
        ], 'users');
    }

    /**
     * @throws Exception
     */
    public static function getUserFull(int $id)
    {
        return self::request("users/full/$id", [], 'user');
    }

    /**
     * @throws Exception
     */
    public static function getMap(int $id)
    {
        return self::request("maps/$id", [], 'map');
    }

    /**
     * @throws Exception
     */
    public static function getMapset(int $id)
    {
        return self::request("mapsets/$id", [], 'mapset');
    }

    /**
     * @throws Exception
     */
    public static function getRankedMapsetIds()
    {
        return self::request('mapsets/ranked', [], 'mapsets');
    }
}
