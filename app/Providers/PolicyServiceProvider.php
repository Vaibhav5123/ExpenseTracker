<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Transaction;
use App\Models\User;
use App\Policies\TransactionPolicy;
use App\Policies\UserPolicy;

class PolicyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::policy(Transaction::class, TransactionPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
    }
}

