<?php

namespace App\Domains\Group\Repositories;

use App\Domains\Group\Models\Group;

interface GroupRepositoryInterface
{
    public function all();

    public function find($id);

    public function create(array $data);

    public function update(Group $group, array $data);

    public function delete(Group $group);

    public function assignPermissions(Group $group, array $permissions);

    public function addUsers(Group $group, array $users): Group;
}