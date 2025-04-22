<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\CivilianPivotSubscription;
use App\Observers\CivilianPivotSubscriptionObserver;

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
            
    }
}
