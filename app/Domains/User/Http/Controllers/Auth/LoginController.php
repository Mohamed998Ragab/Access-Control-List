<?php

namespace App\Domains\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Domains\User\Services\UserServiceInterface;
use App\Domains\User\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginRequest $request)
    {
        try {
            $token = $this->userService->login($request->validated());

            return response()->json([
                'message' => 'User logged in successfully',
                'token' => $token,
                'user' => Auth::user(), // Include user details in the response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getCode());
        }
    }
}