<?php

namespace App\Console\Commands;

use App\Http\Controllers\Staff\StaffController;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ScheduleFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for matches that will start soon and pings staff';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get(config('app.schedule_exec'));

        $data = $response->json();

        if (is_array($data) && count($data)) {
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
