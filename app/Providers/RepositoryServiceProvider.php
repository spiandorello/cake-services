<?php

namespace App\Providers;

use App\Repositories\CakeRepository\CakeRepository;
use App\Repositories\CakeRepository\CakeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            abstract: CakeRepositoryInterface::class,
            concrete: CakeRepository::class,
        );
    }

    public function boot(): void
    {
    }
}
