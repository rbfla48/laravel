<?php

namespace App\Providers;

//use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Algolia\AlgoliaSearch\Log\DebugLogger;

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
        //페이지네이션:부트스트랩5
        Paginator::useBootstrapFive();

        DebugLogger::enable();
    }
}
