<?php

namespace App\Domains\Group\Repositories;

use App\Domains\Group\Repositories\GroupRepositoryInterface;
use App\Domains\Group\Models\Group;

class GroupRepository implements GroupRepositoryInterface
{
    public function all()
    {
        return Group::with('permissions')->get();
    }

    public function find($id)
    {
        return Group::findOrFail($id);
    }

    public function create(array $data)
    {
        return Group::create($data);
    }

    public function update(Group $group, array $data)
    {
        $group->update($data);
        return $group;
    }

    public function delete(Group $group)
    {
        $group->delete();
    }

    public function assignPermissions(Group $group, array $permissions)
    {
        $group->permissions()->sync($permissions);
        return $group->load('permissions');
    }

    public function addUsers(Group $group, array $users): Group
    {
        $group->users()->syncWithoutDetaching($users);
        return $group->load('users');
    }
}