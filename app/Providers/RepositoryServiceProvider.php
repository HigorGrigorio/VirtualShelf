<?php

namespace App\Providers;

use App\Http\Database\Repositories\AuthorRepository;
use App\Http\Database\Repositories\CategoryRepository;
use App\Http\Database\Repositories\CountryRepository;
use App\Http\Database\Repositories\LanguageRepository;
use App\Http\Database\Repositories\UserRepository;
use App\Presentation\Contracts\IAuthorRepository;
use App\Presentation\Contracts\ICategoryRepository;
use App\Presentation\Contracts\ICountryRepository;
use App\Presentation\Contracts\ILanguageRepository;
use App\Presentation\Contracts\IUserRepository;
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
