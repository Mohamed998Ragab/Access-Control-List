<?php 

namespace App\Domains\User\Repositories;

use App\Domains\User\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function assignToGroup(User $user, $group_id)
    {
        $user->groups()->syncWithoutDetaching($group_id);
        return $user->load('groups');
    }

    public function assignPermissions(User $user, array $permissions)
    {
        $user->permissions()->sync($permissions);
        return $user->load('permissions');
    }
}