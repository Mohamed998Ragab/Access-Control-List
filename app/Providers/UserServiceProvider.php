<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domains\User\Repositories\UserRepositoryInterface;
use App\Domains\User\Repositories\UserRepository;
use App\Domains\User\Services\UserServiceInterface;
use App\Domains\User\Services\UserService;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }

    public function boot()
    {
        //
    }
}