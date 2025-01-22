<?php

namespace App\Providers;

use App\Domains\Group\Repositories\GroupRepository;
use App\Domains\Group\Repositories\GroupRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Domains\Group\Services\GroupServiceInterface;
use App\Domains\Group\Services\GroupService;

class GroupServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(GroupRepositoryInterface::class, GroupRepository::class);
        $this->app->bind(GroupServiceInterface::class, GroupService::class);
    }

    public function boot()
    {
        //
    }
}