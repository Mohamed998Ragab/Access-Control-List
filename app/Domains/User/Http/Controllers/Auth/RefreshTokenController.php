<?php

namespace App\Domains\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Domains\User\Services\UserServiceInterface;

class RefreshTokenController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function refresh()
    {
        try {
            $token = $this->userService->refreshToken();

            return response()->json([
                'message' => 'Token refreshed successfully',
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getCode());
        }
    }
}