<?php

namespace App\Domains\Group\Services;

use App\Domains\Group\Services\GroupServiceInterface;
use App\Domains\Group\Repositories\GroupRepositoryInterface;
use App\Domains\Group\Models\Group;

class GroupService implements GroupServiceInterface
{
    protected $groupRepository;

    public function __construct(GroupRepositoryInterface $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function getAllGroups()
    {
        return $this->groupRepository->all();
    }

    public function getGroupById($id)
    {
        return $this->groupRepository->find($id);
    }

    public function createGroup(array $data)
    {
        return $this->groupRepository->create($data);
    }

    public function updateGroup(Group $group, array $data)
    {
        return $this->groupRepository->update($group, $data);
    }

    public function deleteGroup(Group $group)
    {
        return $this->groupRepository->delete($group);
    }

    public function assignPermissionsToGroup(Group $group, array $permissions)
    {
        return $this->groupRepository->assignPermissions($group, $permissions);
    }

    public function addUsersToGroup(Group $group, array $users)
    {
        return $this->groupRepository->addUsers($group, $users);
    }
}