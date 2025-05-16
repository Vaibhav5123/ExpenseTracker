<?php

namespace App\Interfaces;

interface CategorySummaryInterface
{
    public function getCategorySummaries(int $userId, ?string $startDate = null, ?string $endDate = null);
}
