<?php

namespace App\Console\Commands;

use App\Http\Controllers\Staff\StaffController;
use App\Models\User;
use Illuminate\Console\Command;

class CachePlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:players';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Caches all the player\'s rank';

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
        $this->info('Dispatching fetching staff');
        dispatch(function () {
            StaffController::fetchStaff();
        });

        $players = User::query()->has('player')->get();

        foreach ($players as $player) {
            $this->info('Dispatching ' . $player['quaver_username']);
            $quaver_user_id = $player->quaver_user_id;
            dispatch(function () use ($quaver_user_id) {
                User::CachePlayer($quaver_user_id);
            });
        }

        $this->info('Done');
    }
}
