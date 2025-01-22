<?php

namespace App\Domains\Group\Services;

use App\Domains\Group\Models\Group;

interface GroupServiceInterface
{
    public function getAllGroups();

    public function getGroupById($id);

    public function createGroup(array $data);

    public function updateGroup(Group $group, array $data);

    public function deleteGroup(Group $group);

    public function assignPermissionsToGroup(Group $group, array $permissions);

    public function addUsersToGroup(Group $group, array $users);
}