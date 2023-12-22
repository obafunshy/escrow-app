<?php

namespace App\Providers;

use App\Services\BlockonomicsService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $apiKey = env('BLOCKONOMICS_API');

        $this->app->bind(BlockonomicsService::class, function ($app) use ($apiKey) {
            return new BlockonomicsService($apiKey);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
