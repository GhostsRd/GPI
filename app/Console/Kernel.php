<?php

namespace App\Console;

use App\Models\ticket;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
   protected function schedule(Schedule $schedule)
{
    $schedule->command('fetch:emails')->everyMinute();
}

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()   
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
