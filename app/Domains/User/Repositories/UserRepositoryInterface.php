<?php 

namespace App\Domains\User\Repositories;

use App\Domains\User\Models\User;

interface UserRepositoryInterface
{
    public function assignToGroup(User $user, $group_id);

    public function assignPermissions(User $user, array $permissions);
}