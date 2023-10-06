<?php

namespace App\Providers;

use App\Client\RandomUserClient;
use App\Client\RandomUserClientInterface;
use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RandomUserClientInterface::class, RandomUserClient::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
