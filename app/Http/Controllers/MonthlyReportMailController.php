<?php

namespace App\Http\Controllers;

use App\Jobs\SendMonthlyReportJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class MonthlyReportMailController extends Controller
{
    public function send()
    {
        $user = Auth::user();
        $now = Carbon::now();

        SendMonthlyReportJob::dispatch($user, $now->month, $now->year);

        return back();
    }
}
