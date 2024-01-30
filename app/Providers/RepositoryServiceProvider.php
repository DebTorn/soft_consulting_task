<?php

namespace App\Providers;

use App\Repositories\Interfaces\LogRepositoryInt;
use App\Repositories\Interfaces\PersonRepositoryInt;
use App\Repositories\LogRepository;
use App\Repositories\PersonRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LogRepositoryInt::class, LogRepository::class);
        $this->app->bind(PersonRepositoryInt::class, PersonRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
