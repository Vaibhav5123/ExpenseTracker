<?php

namespace App\Providers;
use App\Services\AuthService;
use App\Repositories\UserRepository;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;
use App\Models\User;
use App\Models\Transaction;
use App\Observers\TransactionObserver;
use App\Interfaces\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Interfaces\TransactionsRepositoryInterface;
use App\Repositories\TransactionRepository;
use App\Interfaces\CategorySummaryInterface;
use App\Services\CategorySummaryService;
use App\Interfaces\PdfReportServiceInterface;
use App\Services\PdfReportService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    
    public function register(): void
    {
        $this->app->singleton(AuthService::class, function ($app) {
            return new AuthService();
        });

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);

        $this->app->bind(TransactionsRepositoryInterface::class, TransactionRepository::class);

        $this->app->bind(CategorySummaryInterface::class, CategorySummaryService::class);

        $this->app->bind(PdfReportServiceInterface::class,PdfReportService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Transaction::observe(TransactionObserver::class);
    }
}
