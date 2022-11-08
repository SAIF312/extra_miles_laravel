<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('MalaysianFuelPrices:cron')->daily();
        $schedule->command('Motorist:cron')->daily();
        $schedule->command('OpenBiddings:cron')
        ->timezone('UTC +8')
        ->at('16:00');
        $schedule->command('TraficImages:cron')->everyThreeMinutes();
        $schedule->command('CarParking:cron')->weekly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
