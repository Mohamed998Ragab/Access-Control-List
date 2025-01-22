<?php

namespace App\Domains\User\Services;

use App\Domains\User\Models\User;

interface UserServiceInterface
{
    public function assignToGroup(User $user, $group_id);

    public function assignPermissions(User $user, array $permissions);

    public function register(array $data);

    public function login(array $credentials);

    public function logout();

    public function refreshToken();
}