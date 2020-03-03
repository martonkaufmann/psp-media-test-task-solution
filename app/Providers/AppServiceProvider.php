<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Customer;
use App\Transaction;
use App\Observers\CustomerObserver;
use App\Observers\TransactionObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Customer::observe(CustomerObserver::class);
        Transaction::observe(TransactionObserver::class);
    }
}
