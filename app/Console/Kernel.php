<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        // Test database connection
        try {
            $kioskSched = [];
            if (Schema::hasTable('kiosk_schedule')) {
                $kioskSched = DB::table('kiosk_schedule')->get();
            }

            foreach ($kioskSched as $entry) {
                $schedule->command('kiosk:signoutstudents '.$entry->kiosk_id)->dailyAt($entry->time);
            }
        } catch (\Exception $e) {
            //We dont care if it fails
        }

        $schedule->command('studentdb:update')
            ->weekdays()->at('23:00');
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
