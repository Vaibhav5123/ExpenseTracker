<?php

namespace App\Strategy;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ReportInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportByCategory implements ReportInterface
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
            return $transaction->category->name;
        })->map(function ($group) {
            return [
                'category' => $group->first()->category->name,
                'total' => $group->sum('amount'),
                'transaction_count' => $group->count(),
            ];
        })->sortByDesc('total')->values();

        return $report;
    }
}
