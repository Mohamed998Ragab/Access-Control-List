<?php

namespace Database\Seeders;

use App\Domains\Group\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run()
    {
        // Create an admin group
        $adminGroup = Group::create([
            'name' => 'Admin',
        ]);

        // Create a user group
        $userGroup = Group::create([
            'name' => 'User',
        ]);

        $this->command->info('Groups created successfully!');
    }
}