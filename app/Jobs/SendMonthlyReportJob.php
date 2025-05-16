<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\MonthlyReportMail;
use App\Services\PdfReportService;
use App\Notifications\MonthlyReportNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Throwable;

class SendMonthlyReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = 10;

    protected $user;
    protected $month;
    protected $year;

    public function __construct(User $user, $month, $year)
    {
        $this->user = $user;
        $this->month = $month;
        $this->year = $year;
    }

    public function handle(PdfReportService $pdfReportService)
    {
        $pdfPath = $pdfReportService->generateMonthlyReportForUser($this->user, $this->month, $this->year);

        if (!$pdfPath) {
            Log::info("No transactions for {$this->user->email} — skipping email.");
            return;
        }

        Mail::to($this->user->email)->send(new MonthlyReportMail($pdfPath));
        $this->user->notify((new MonthlyReportNotification($pdfPath)));

        unlink($pdfPath);
    }

    public function failed(Throwable $exception)
    {
        Log::error("Monthly report job failed for user {$this->user->email}: " . $exception->getMessage());
    }
}
