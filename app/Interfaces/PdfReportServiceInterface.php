<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

interface PdfReportServiceInterface
{
    public function generateMonthlyReportForUser($user, int $month, int $year): string;
}
