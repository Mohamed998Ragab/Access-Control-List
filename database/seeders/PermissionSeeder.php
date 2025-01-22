<?php

namespace Database\Seeders;

use App\Domains\Permission\Services\PermissionRegistrationService;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Register permissions dynamically
        PermissionRegistrationService::registerPermissions();

        $this->command->info('Permissions registered successfully!');
    }
}