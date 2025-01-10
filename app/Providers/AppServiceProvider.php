<?php

namespace App\Providers;

use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\AuthRepositoryInterface;
use App\Repositories\Song\SongRepository;
use App\Repositories\Song\SongRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(SongRepositoryInterface::class, SongRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
