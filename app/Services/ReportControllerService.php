<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Strategy\ReportByMonth;
use App\Strategy\ReportByType;
use App\Strategy\ReportByCategory;
use App\Services\ReportService;

class ReportControllerService
{
    public function generateReport(Request $request): array
    {
        $type = $request->input('type', 'month');

        $context = new ReportService();

        match ($type) {
            'type' => $context->setStrategy(new ReportByType()),
            'category' => $context->setStrategy(new ReportByCategory()),
            default => $context->setStrategy(new ReportByMonth()),
        };

        return [
            'report' => $context->generateReport($request),
            'type' => $type,
        ];
    }

    public function reportByMonth(Request $request): array
    {
        $context = new ReportByMonth();
        return [
            'report' => $context->generate($request),
        ];
    }
}
