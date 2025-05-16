<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportControllerService;

class ReportController extends Controller
{
    protected ReportControllerService $reportService;

    public function __construct(ReportControllerService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function show()
    {
        return view('reports.report-view');
    }

    public function index(Request $request)
    {
        $data = $this->reportService->generateReport($request);
        return view('reports.report-view', $data);
    }

    public function reportByMonth(Request $request)
    {
        $data = $this->reportService->reportByMonth($request);
        return view('reports.monthly', $data);
    }
}
