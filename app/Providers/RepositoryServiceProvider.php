<?php

namespace App\Providers;

use App\Http\Database\Repositories\CountryRepository;
use App\Interfaces\ICountryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ICountryRepository::class,
            CountryRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
