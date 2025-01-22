<?php

namespace App\Domains\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\User\Services\UserServiceInterface;
use App\Domains\User\Http\Requests\UserRequest;
use App\Domains\User\Http\Resources\UserResource;
use App\Domains\User\Models\User;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function assignToGroup(UserRequest $request, User $user)
    {
        $user = $this->userService->assignToGroup($user, $request->group_id);
        return new UserResource($user);
    }

    public function assignPermissions(UserRequest $request, User $user)
    {
        $user = $this->userService->assignPermissions($user, $request->permissions);
        return new UserResource($user);
    }
}