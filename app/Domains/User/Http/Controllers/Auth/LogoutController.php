<?php

namespace App\Domains\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Domains\User\Services\UserServiceInterface;

class LogoutController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function logout()
    {
        try {
            $this->userService->logout();

            return response()->json([
                'message' => 'User logged out successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getCode());
        }
    }
}