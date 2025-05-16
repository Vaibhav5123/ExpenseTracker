<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    public function getDashboardData(): array
    {
        $user = Auth::user();

        $transactions = Transaction::with('category')
            ->where('user_id', $user->id)
            ->orderByDesc('date')
            ->get();

        $totalIncome = $transactions->where('category.type', 'Income')->sum('amount');
        $totalExpense = $transactions->where('category.type', 'Expense')->sum('amount');
        $totalSaving = $transactions->where('category.type', 'Saving')->sum('amount');
        $remainignFunds = $totalIncome-($totalExpense+$totalSaving);

        $expensesByCategory = $transactions->where('category.type', 'Expense')
            ->groupBy(fn($txn) => $txn->category->name)
            ->map(fn($group) => $group->sum('amount'));

        $latestTransactions = $transactions->take(5);

        return compact(
            'totalIncome',
            'totalExpense',
            'totalSaving',
            'remainignFunds',
            'expensesByCategory',
            'latestTransactions',
        );
    }
}
