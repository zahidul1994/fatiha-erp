<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        'App\Console\Commands\DatabaseBackUp',
        'App\Console\Commands\AdminInactive',
        ];
    protected function schedule(Schedule $schedule): void
    {
         $schedule->command('work:databasebackup')->dailyAt('24:58');
         $schedule->command('work:adminInactive')->dailyAt('00:01');
         $schedule->command('activitylog:clean')->quarterlyOn(3);
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
