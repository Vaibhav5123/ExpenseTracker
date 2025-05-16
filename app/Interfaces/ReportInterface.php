<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ReportInterface
{
    public function generate(Request $request);
}
