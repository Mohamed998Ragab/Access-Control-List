<?php

namespace App\Domains\Permission\Repositories;

use App\Domains\Permission\Repositories\PermissionRepositoryInterface;
use App\Domains\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function all()
    {
        return Permission::all();
    }

    public function find($id)
    {
        return Permission::findOrFail($id);
    }

    public function create(array $data)
    {
        return Permission::create($data);
    }

    public function update(Permission $permission, array $data)
    {
        $permission->update($data);
        return $permission;
    }

    public function delete(Permission $permission)
    {
        $permission->delete();
    }

    public function assignToGroups(Permission $permission, array $groups)
    {
        $permission->groups()->sync($groups);
        return $permission->load('groups');
    }
}