<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Jobs\SendMonthlyReportJob;

class SendMonthlyReport extends Command
{
    protected $signature = 'send-monthly-report';
    protected $description = 'Queue monthly report emails for all users';

    public function handle()
    {
        $month = now()->month;
        $year = now()->year;

        $users = User::all();

        foreach ($users as $user) {
            SendMonthlyReportJob::dispatch($user, $month, $year);
        }

        $this->info('Monthly report jobs dispatched successfully.');
    }
}
