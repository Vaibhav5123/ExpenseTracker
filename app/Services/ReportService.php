<?php

namespace App\Services;

use App\Interfaces\ReportInterface;
use Illuminate\Http\Request;

class ReportService
{
    protected ReportInterface $strategy;

    public function setStrategy(ReportInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function generateReport(Request $request)
    {
        return $this->strategy->generate($request);
    }
}
