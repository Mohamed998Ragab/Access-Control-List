<?php

namespace App\Domains\Permission\Repositories;

use App\Domains\Permission\Models\Permission;

interface PermissionRepositoryInterface
{
    public function all();

    public function find($id);

    public function create(array $data);

    public function update(Permission $permission, array $data);

    public function delete(Permission $permission);

    public function assignToGroups(Permission $permission, array $groups);
}