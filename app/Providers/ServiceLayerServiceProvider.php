<?php

namespace App\Providers;

use App\Services\Interfaces\LogServiceInt;
use App\Services\Interfaces\PersonServiceInt;
use App\Services\LogService;
use App\Services\PersonService;
use Illuminate\Support\ServiceProvider;

class ServiceLayerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PersonServiceInt::class, PersonService::class);
        $this->app->bind(LogServiceInt::class, LogService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
