<?php

namespace App\Services;

use App\Models\Transaction;
use App\Interfaces\PdfReportServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Response;

class PdfReportService implements PdfReportServiceInterface
{
    public function generateMonthlyReportForUser($user, int $month, int $year): string
    {
        $formattedMonthYear = Carbon::create($year, $month)->format('F Y');

        $transactions = Transaction::with('category')
            ->where('user_id', $user->id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->orderByDesc('date')
            ->get();

        $totals = [
            'Income' => $transactions->where('category.type', 'Income')->sum('amount'),
            'Expense' => $transactions->where('category.type', 'Expense')->sum('amount'),
            'Saving' => $transactions->where('category.type', 'Saving')->sum('amount'),
        ];

        $report = $transactions->groupBy(function ($transaction) {
            return $transaction->category->name . '|' . $transaction->category->type;
        })->map(function ($group) {
            return [
                'category' => $group->first()->category->name,
                'type' => $group->first()->category->type,
                'total' => $group->sum('amount'),
            ];
        })->values();

        $pdf = Pdf::loadView('reports.report-pdf', [
            'user' => $user,
            'month' => $month,
            'year' => $year,
            'formattedMonthYear' => $formattedMonthYear,
            'totals' => $totals,
            'report' => $report,
            'transactions' => $transactions,
        ]);

        $pdfPath = storage_path("app/reports/Monthly_Report_{$month}_{$year}_{$user->id}.pdf");
        file_put_contents($pdfPath, $pdf->output());

        return $pdfPath;
    }

}
