<?php

namespace App\Domains\Permission\Services;

use App\Domains\Permission\Models\Permission;

interface PermissionServiceInterface
{
    public function getAllPermissions();

    public function getPermissionById($id);

    public function createPermission(array $data);

    public function updatePermission(Permission $permission, array $data);

    public function deletePermission(Permission $permission);

    public function assignPermissionToGroups(Permission $permission, array $groups);
}