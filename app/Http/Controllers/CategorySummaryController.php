<?php

namespace App\Http\Controllers;

use App\Services\CategorySummaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategorySummaryController extends Controller
{
    protected $categorySummaryService;

    public function __construct(CategorySummaryService $categorySummaryService)
    {
        $this->categorySummaryService = $categorySummaryService;
    }

    public function index(Request $request)
    {
        $userId = Auth::id();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $categorySummaries = $this->categorySummaryService->getCategorySummaries($userId, $startDate, $endDate);

        return view('category.category-summary', compact('categorySummaries'));
    }
}
