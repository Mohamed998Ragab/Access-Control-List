<?php

namespace App\Domains\Group\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\Group\Services\GroupServiceInterface;
use App\Domains\Group\Http\Requests\GroupRequest;
use App\Domains\Group\Http\Resources\GroupResource;

class GroupController extends Controller
{
    protected $groupService;

    public function __construct(GroupServiceInterface $groupService)
    {
        $this->groupService = $groupService;
    }

    public function index()
    {
        $groups = $this->groupService->getAllGroups();
        return GroupResource::collection($groups);
    }

    public function store(GroupRequest $request)
    {
        $group = $this->groupService->createGroup($request->validated());
        return new GroupResource($group);
    }

    public function show($id)
    {
        $group = $this->groupService->getGroupById($id);
        return new GroupResource($group);
    }

    public function update(GroupRequest $request, $id)
    {
        $group = $this->groupService->getGroupById($id);
        $group = $this->groupService->updateGroup($group, $request->validated());
        return new GroupResource($group);
    }

    public function destroy($id)
    {
        $group = $this->groupService->getGroupById($id);
        $this->groupService->deleteGroup($group);
        return response()->json(null, 204);
    }

    public function assignPermissions(GroupRequest $request, $id)
    {
        $group = $this->groupService->getGroupById($id);
        $group = $this->groupService->assignPermissionsToGroup($group, $request->permissions);
        return new GroupResource($group);
    }

    public function addUsers(GroupRequest $request, $id)
    {
        $group = $this->groupService->getGroupById($id);
        $group = $this->groupService->addUsersToGroup($group, $request->users);
        return new GroupResource($group);
    }
}