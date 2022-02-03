<?php

namespace App\Console\Commands;

use App\Http\Controllers\Staff\StaffController;
use App\Models\User;
use Illuminate\Console\Command;

class GiveRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gives everyone from the team page their role';

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
        foreach (StaffController::$staff as $name => $type) {
            if ($name == 'mappoolers') {
                foreach ($type as $player) {
                    $user = User::query()->where('quaver_user_id', '=', $player);
                    $user->update([
                        'role' => 3
                    ]);
                }
            }

            if ($name == 'referees') {
                foreach ($type as $player) {
                    $user = User::query()->where('quaver_user_id', '=', $player);
                    $user->update([
                        'role' => 2
                    ]);
                }
            }
        }

        $this->info('Done');
    }
}
