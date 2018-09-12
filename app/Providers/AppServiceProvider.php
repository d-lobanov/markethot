<?php

namespace Market\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Market\Console\Services\CachePool;
use Market\Console\Services\MarketTopFetcher;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MarketTopFetcher::class, function () {
            return new MarketTopFetcher(config('app.markethot.url'));
        });

        $this->app->singleton(CachePool::class, function () {
            return new CachePool(Cache::tags('product'));
        });
    }
}
