<?php

namespace App\Domains\Permission\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\Permission\Services\PermissionServiceInterface;
use App\Domains\Permission\Http\Requests\PermissionRequest;
use App\Domains\Permission\Http\Resources\PermissionResource;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionServiceInterface $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        $permissions = $this->permissionService->getAllPermissions();
        return PermissionResource::collection($permissions);
    }

    public function store(PermissionRequest $request)
    {
        $permission = $this->permissionService->createPermission($request->validated());
        return new PermissionResource($permission);
    }

    public function show($id)
    {
        $permission = $this->permissionService->getPermissionById($id);
        return new PermissionResource($permission);
    }

    public function update(PermissionRequest $request, $id)
    {
        $permission = $this->permissionService->getPermissionById($id);
        $permission = $this->permissionService->updatePermission($permission, $request->validated());
        return new PermissionResource($permission);
    }

    public function destroy($id)
    {
        $permission = $this->permissionService->getPermissionById($id);
        $this->permissionService->deletePermission($permission);
        return response()->json(null, 204);
    }

    public function assignToGroups(PermissionRequest $request, $id)
    {
        $permission = $this->permissionService->getPermissionById($id);
        $permission = $this->permissionService->assignPermissionToGroups($permission, $request->groups);
        return new PermissionResource($permission);
    }

    public function sss()
    {
        return 'test';
    }

}