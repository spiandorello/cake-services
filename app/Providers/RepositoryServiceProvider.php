<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\CakeRepository\CakeRepository;
use App\Repositories\CakeRepository\CakeRepositoryInterface;
use App\Repositories\UserRepository\UserRepository;
use App\Repositories\UserRepository\UserRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            abstract: CakeRepositoryInterface::class,
            concrete: CakeRepository::class,
        );

        $this->app->bind(
            abstract: UserRepositoryInterface::class,
            concrete: UserRepository::class,
        );
    }

    public function boot(): void
    {
    }
}
