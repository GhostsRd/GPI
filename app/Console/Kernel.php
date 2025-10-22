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
    $schedule->call(function () {

      $ticket = Ticket::where('priorite', 0)
    ->latest('created_at')
    ->first();
        $notifications = Cache::get('notifications', []);
        $now = Carbon::now();
        $last = end($notifications);

        if (!$last || Carbon::parse($last['created_at'])->diffInMinutes($now) >= 1) {
            $notifications[] = [
                'title' => 'Rappel automatique',
                'message' => 'Notification toutes les minutes'.$ticket->sujet.' et '.$ticket->details,
                'created_at' => $now->toDateTimeString()
            ];

            Cache::put('notifications', $notifications, 60 * 60 * 24); // expire dans 24h
        }

    })->everyMinute(); // toutes les minutes
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
