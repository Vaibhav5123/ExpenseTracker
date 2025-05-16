<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategorySummaryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PdfReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonthlyReportMailController;


Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('dashboard', DashboardController::class);
    Route::resource('users', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('summary', CategorySummaryController::class);
    Route::resource('report', ReportController::class);

    Route::get('/report/month', [ReportController::class, 'reportByMonth'])->name('report.month');

    Route::get('/pdf-download', [PdfReportController::class, 'show'])->name('pdf');

    Route::post('/mail-report', [MonthlyReportMailController::class, 'send'])->name('mail.report');

});

require __DIR__.'/auth.php';
