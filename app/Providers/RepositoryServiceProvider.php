<?php

namespace App\Providers;

use App\Repositories\Clients\ClientEloquentRepository;
use App\Repositories\Contract\ClientRepository;
use App\Repositories\Contract\UserRepository;
use App\Repositories\User\UserEloquentRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider.
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            UserRepository::class,
            UserEloquentRepository::class
        );
        $this->app->bind(
            ClientRepository::class,
            ClientEloquentRepository::class
        );
    }
}
