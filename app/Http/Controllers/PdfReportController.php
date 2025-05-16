<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\PdfReportServiceInterface;
use Illuminate\Support\Facades\Auth;

class PdfReportController extends Controller
{
    protected PdfReportServiceInterface $pdfReportService;

    public function __construct(PdfReportServiceInterface $pdfReportService)
    {
        $this->pdfReportService = $pdfReportService;
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $month = $request->input('month');
        $year = $request->input('year');

        $pdfPath = $this->pdfReportService->generateMonthlyReportForUser($user, $month, $year);

        return response()->download($pdfPath);
    }
}
