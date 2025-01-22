<?php

namespace App\Providers;

use App\Domains\Permission\Repositories\PermissionRepository;
use App\Domains\Permission\Repositories\PermissionRepositoryInterface;
use App\Domains\Permission\Services\PermissionRegistrationService;
use Illuminate\Support\ServiceProvider;
use App\Domains\Permission\Services\PermissionServiceInterface;
use App\Domains\Permission\Services\PermissionService;
use Illuminate\Support\Facades\Schema;


class PermissionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(PermissionServiceInterface::class, PermissionService::class);
    }

    public function boot()
    {
        // // Only register permissions if the application is serving HTTP requests
        // if ($this->app->runningInConsole() === false) {
        //     // Check if the permissions table exists before registering permissions
        //     if (Schema::hasTable('permissions')) {
        //         PermissionRegistrationService::registerPermissions();
        //     }
        // }
        // Register permissions before the application starts handling requests
        if (!$this->app->runningInConsole() && Schema::hasTable('permissions')) {
            PermissionRegistrationService::registerPermissions();
        }
    }
    
}