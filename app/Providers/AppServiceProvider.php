<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserService;
use App\Contracts\IUserService;
use App\Repositories\UserRepository;
use App\Contracts\IUserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
