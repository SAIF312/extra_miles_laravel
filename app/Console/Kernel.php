<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

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
        // DB::table('crone_jobs')->
        $schedule->command('Motorist:cron')->hourlyAt(39);
        $schedule->command('MalaysianFuelPrices:cron')->hourlyAt(49);
        $schedule->command('OpenBiddings:cron')->hourlyAt(59);
        $schedule->command('TraficImages:cron')->everyThreeMinutes();
        $schedule->command('CarParking:cron')->weekly();

        // $schedule->command('Motorist:cron')->everyMinute();
        // $schedule->command('MalaysianFuelPrices:cron')->everyMinute();
        // $schedule->command('OpenBiddings:cron')->everyMinute();
        // $schedule->command('TraficImages:cron')->everyMinute();
        // $schedule->command('CarParking:cron')->everyMinute();
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
