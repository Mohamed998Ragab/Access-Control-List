<?php

namespace App\Domains\User\Services;

use App\Domains\User\Services\UserServiceInterface;
use App\Domains\User\Repositories\UserRepositoryInterface;
use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function assignToGroup(User $user, $group_id)
    {
        return $this->userRepository->assignToGroup($user, $group_id);
    }

    public function assignPermissions(User $user, array $permissions)
    {
        return $this->userRepository->assignPermissions($user, $permissions);
    }

    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $token = Auth::login($user);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function login(array $credentials)
    {
        // Attempt to authenticate the user
        if (!Auth::attempt($credentials)) {
            throw new \Exception('Invalid credentials', 401);
        }
    
        // Get the authenticated user
        $user = Auth::user();
    
        // Generate a JWT token for the user
        $token = JWTAuth::fromUser($user);
    
        return $token;
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (JWTException $e) {
            throw new \Exception('Failed to logout, please try again', 500);
        }
    }

    public function refreshToken()
    {
        try {
            return JWTAuth::refresh(JWTAuth::getToken());
        } catch (JWTException $e) {
            throw new \Exception('Token cannot be refreshed, please login again', 401);
        }
    }
}