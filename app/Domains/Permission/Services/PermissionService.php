<?php

namespace App\Domains\Permission\Services;

use App\Domains\Permission\Services\PermissionServiceInterface;
use App\Domains\Permission\Repositories\PermissionRepositoryInterface;
use App\Domains\Permission\Models\Permission;

class PermissionService implements PermissionServiceInterface
{
    protected $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function getAllPermissions()
    {
        return $this->permissionRepository->all();
    }

    public function getPermissionById($id)
    {
        return $this->permissionRepository->find($id);
    }

    public function createPermission(array $data)
    {
        return $this->permissionRepository->create($data);
    }

    public function updatePermission(Permission $permission, array $data)
    {
        return $this->permissionRepository->update($permission, $data);
    }

    public function deletePermission(Permission $permission)
    {
        return $this->permissionRepository->delete($permission);
    }

    public function assignPermissionToGroups(Permission $permission, array $groups)
    {
        return $this->permissionRepository->assignToGroups($permission, $groups);
    }
}