<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    // protected $commands = [
    //     Commands\DeleteExpiredSubscriptions::class,
    // ];

    // protected function schedule(Schedule $schedule)
    // {
    //     // Запуск команды каждый день в полночь
    //     $schedule->command('subscriptions:delete-expired')->daily();
    // }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}