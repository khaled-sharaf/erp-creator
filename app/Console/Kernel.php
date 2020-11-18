<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
     * @apiParam  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @apiSuccess void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        // $schedule->exec('php artisan queue:work')
        $schedule->command('queue:work')
                ->everyMinute()
                // ->withoutOverlapping()
                ->appendOutputTo(storage_path() . '/logs/queue-jobs.log');
    }

    /**
     * Register the commands for the application.
     *
     * @apiSuccess void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
