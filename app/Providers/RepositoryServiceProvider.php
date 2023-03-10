<?php

namespace App\Providers;

use App\Repositories\CakeRepository\CakeRepository;
use App\Repositories\CakeRepository\CakeRepositoryInterface;
use App\Repositories\CakeSubscriberRepository\CakeSubscriberRepository;
use App\Repositories\CakeSubscriberRepository\CakeSubscriberRepositoryInterface;
use App\Repositories\UserRepository\UserRepository;
use App\Repositories\UserRepository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            abstract: CakeSubscriberRepositoryInterface::class,
            concrete: CakeSubscriberRepository::class,
        );

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
