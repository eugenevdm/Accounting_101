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
        Commands\Inspire::class,
        Commands\ImportCompany::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $filePath = "/var/www/html/acc101/public/schedule_output.txt";

        $schedule->command('company:import')->everyMinute()->name('master_schedule')->withoutOverlapping()->appendOutputTo($filePath);
    //})->everyFiveMinutes()->name('master_schedule')->withoutOverlapping()->appendOutputTo($filePath);
    }

}
