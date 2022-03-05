<?php

namespace App\Console\Commands;

use App\Http\Controllers\Staff\StaffController;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SchedulePing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:ping';

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
        // Fetch matches that are not yet played or notified
        $matches = Schedule::where('played', 0)->where('notified', 0)->get();

        $now = Carbon::now('UTC');
        // $now = Carbon::parse('2022-02-26 18:30:00'); // for testing

        foreach ($matches as $match) {
            $match_date = Carbon::parse($match->timestamp);

            $difference = $match_date->diffInMinutes($now);

            if ($difference <= 59) {
                if (config('app.schedule_webhook')) {
                    self::send($match);
                }

                $match->notified = 1;

                $match->save();
            }
        }
    }

    private function send($match)
    {
        $msg = sprintf("Match ID: %s\nTimestamp: %s\n", $match->match_id, $match->timestamp);

        $referee = User::select(['discord_user_id'])->where('quaver_username', $match->referee)->first();

        if ($referee) {
            $msg .= sprintf("Referee: <@%s>\n", $referee['discord_user_id']);
        } else {
            $msg .= sprintf("Referee: %s\n", $match->referee);
        }

        if ($match->streamer) {
            $streamer = User::select(['discord_user_id'])->where('quaver_username', $match->streamer)->first();
            if ($streamer) {
                $msg .= sprintf("Streamer: <@%s>\n", $streamer['discord_user_id']);
            } else {
                $msg .= sprintf("Streamer: %s", $match->streamer);
            }

            if ($match->comm1) {
                $commentator1 = User::select(['discord_user_id'])->where('quaver_username', $match->comm1)->first();
                if ($commentator1) {
                    $msg .= sprintf("Commentator: <@%s>\n", $commentator1['discord_user_id']);
                } else {
                    $msg .= sprintf("Commentator: %s\n", $match->comm1);
                }
            }

            if ($match->comm2) {
                $commentator2 = User::select(['discord_user_id'])->where('quaver_username', $match->comm2)->first();
                if ($commentator2) {
                    $msg .= sprintf("Commentator: <@%s>\n", $commentator2['discord_user_id']);
                } else {
                    $msg .= sprintf("Commentator: %s\n", $match->comm2);
                }
            }
        }

        $msg .= sprintf("**PLEASE REACT TO THIS MESSAGE TO CONFIRM YOU'RE AVAILABLE**\n");
        $msg .= sprintf("**IF NOT PLEASE INFORM AND FIND SOMEONE TO REPLACE YOU**\n");

        $msg .= sprintf("\n\n **GENERATED LOBBY PASSWORD: `%s`**", \Str::random(8));

        return Http::post(config('app.schedule_webhook'), [
            'content' => $msg
        ]);
    }
}
