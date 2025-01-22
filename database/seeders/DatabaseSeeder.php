<?php

namespace Database\Seeders;

use App\Domains\Group\Models\Group;
use App\Domains\Permission\Models\Permission;
use App\Domains\User\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            GroupSeeder::class,
            PermissionSeeder::class,
        ]);

        // Assign all permissions to the admin group
        $adminGroup = Group::where('name', 'Admin')->first();
        $permissions = Permission::all();
        $adminGroup->permissions()->sync($permissions->pluck('id'));

        // Assign the admin user to the admin group
        $adminUser = User::where('email', 'admin@example.com')->first();
        $adminUser->groups()->sync([$adminGroup->id]);

        $this->command->info('Database seeded successfully!');
    }
}