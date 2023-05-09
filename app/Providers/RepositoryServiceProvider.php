<?php

namespace App\Providers;

use App\Http\Database\Contracts\IAuthorRepository;
use App\Http\Database\Contracts\ICategoryRepository;
use App\Http\Database\Contracts\ICountryRepository;
use App\Http\Database\Contracts\ILanguageRepository;
use App\Http\Database\Contracts\IUserRepository;
use App\Http\Database\Repositories\AuthorRepository;
use App\Http\Database\Repositories\CategoryRepository;
use App\Http\Database\Repositories\CountryRepository;
use App\Http\Database\Repositories\LanguageRepository;
use App\Http\Database\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    private array $repositories = [
        ICountryRepository::class => CountryRepository::class,
        IAuthorRepository::class => AuthorRepository::class,
        ILanguageRepository::class => LanguageRepository::class,
        ICategoryRepository::class => CategoryRepository::class,
        IUserRepository::class => UserRepository::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        foreach ($this->repositories as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
