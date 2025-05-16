<?php

namespace App\Strategy;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ReportInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportByMonth implements ReportInterface
{
    public function generate(Request $request)
    {
        $userId = Auth::id(); 
        $month = $request->input('month') ?? now()->month;
        $year = $request->input('year') ?? now()->year;


        $transactions = Transaction::with('category')
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->where('user_id', $userId)
            ->get();

        return $transactions->groupBy(function ($transaction) {
            return $transaction->category->type . '|' . $transaction->category->name;
        })->map(function ($group) {
            return [
                'category' => $group->first()->category->name,
                'type' => $group->first()->category->type,
                'total' => $group->sum('amount'),
            ];
        })->values();
    }

}
