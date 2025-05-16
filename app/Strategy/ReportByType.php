<?php

namespace App\Strategy;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ReportInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportByType implements ReportInterface
{
    public function generate(Request $data)
    {
        $userId = Auth::id();
        $startDate = $data['startDate'];
        $endDate = $data['endDate'];

        $query = Transaction::with('category')
            ->where('user_id', $userId);

        if ($startDate) {
            $query->where('date', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('date', '<=', $endDate);
        }

        $transactions = $query->get();

        $report = $transactions->groupBy(function ($transaction) {
            return $transaction->category->type;
        })->map(function ($group) {
            return [
                'type' => $group->first()->category->type,
                'total' => $group->sum('amount'),
                'transaction_count' => $group->count(),
            ];
        })->values();

        return $report;
    }
}
