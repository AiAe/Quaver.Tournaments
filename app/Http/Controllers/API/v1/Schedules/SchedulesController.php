<?php

namespace App\Http\Controllers\API\v1\Schedules;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    public function save(Request $request)
    {
        $headers = $request->header();

        var_dump($headers);

        if (isset($headers['secret']) && $headers['secret'] !== config('app.schedule_secret')) {
            return "";
        }

        $data = $request->json()->all();

        var_dump($data);

        if (is_array($data)) {
            foreach ($data as $match) {
                Schedule::updateOrCreate([
                    'match_id' => $match['matchId']
                ], [
                    'playerRed' => $match['playerRed'],
                    'playerBlue' => $match['playerBlue'],
                    'playerRedScore' => $match['playerRedScore'],
                    'playerBlueScore' => $match['playerBlueScore'],
                    'referee' => $match['referee'],
                    'streamer' => $match['streamer'],
                    'comm1' => $match['comm1'],
                    'comm2' => $match['comm2'],
                    'timestamp' => \Carbon\Carbon::parse($match['timestamp'])->toDateTimeString(),
                    'played' => ($match['playerRedScore'] + $match['playerBlueScore'] !== 0)
                ]);
            }
        }
    }
}
