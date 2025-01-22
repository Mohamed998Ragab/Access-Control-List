<?php

namespace App\Domains\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Domains\User\Services\UserServiceInterface;
use App\Domains\User\Http\Requests\RegisterRequest;
use App\Domains\User\Http\Resources\UserResource;

class RegisterController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $this->userService->register($request->validated());

        return response()->json([
            'message' => 'User registered successfully',
            'user' => new UserResource($data['user']),
            'token' => $data['token'],
        ], 201);
    }
}