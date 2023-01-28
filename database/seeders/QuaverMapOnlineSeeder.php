<?php

namespace Database\Seeders;

use App\Http\QuaverApi\QuaverApi;
use App\Models\QuaverMap;
use Exception;
use Illuminate\Database\Seeder;

/*
 * Not used by default, use with `artisan db:seed --class=QuaverMapOnlineSeeder`
 */
class QuaverMapOnlineSeeder extends Seeder
{
    public function run()
    {
        $mapsetIds = QuaverApi::getRankedMapsetIds();
        foreach (array_slice($mapsetIds, 1000, 50) as $mapsetId) {
            try {
                $mapsetData = QuaverApi::getMapset($mapsetId);
                foreach ($mapsetData['maps'] as $map) {
                    QuaverMap::create(QuaverMap::quaverDataToAttributes($map));
                }
            } catch (Exception $e) {
                error_log($e->getMessage());
            }
        }
    }
}
