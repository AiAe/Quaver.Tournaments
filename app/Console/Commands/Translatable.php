<?php

namespace App\Console\Commands;

use App\Http\Controllers\Staff\StaffController;
use App\Models\User;
use Illuminate\Console\Command;

class Translatable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qot:translatable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates or populates missing strings';

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
        \Artisan::call(sprintf('translatable:export %s', config('app.languages')));

        $this->info('Done');
    }
}
