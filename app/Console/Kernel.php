<?php

namespace App\Console;

use App\Console\Commands\UpdatePaidPayment;
use App\Console\Commands\UpdatePaymentStatus;
use App\Console\Commands\UpdatePaymentStatusExpirationDate;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\DeleteExpiredNotifications;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        UpdatePaymentStatus::class,
        UpdatePaidPayment::class,
        DeleteExpiredNotifications::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('payments:update-pendings')->hourly();
        $schedule->command('payments:update-paids')->dailyAt('23:59');
        $schedule->command('notifications:delete-expired')->daily();
        $schedule->command('update:crypto-rates')->daily();
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
