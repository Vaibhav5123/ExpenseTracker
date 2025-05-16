<?php

namespace App\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use App\Console\Commands\SendMonthlyReport;

class ConsoleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            SendMonthlyReport::class,
        ]);
    }

    public function boot(Schedule $schedule)
    {
        $schedule->command('send-monthly-report')
                 ->everyTenSeconds()
                 ->description('Send monthly report to users every 10 seconds');
    }
}
