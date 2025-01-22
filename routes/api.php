<?php

use App\Domains\Group\Http\Controllers\GroupController;
use App\Domains\Permission\Http\Controllers\PermissionController;
use App\Domains\User\Http\Controllers\Auth\LoginController;
use App\Domains\User\Http\Controllers\Auth\LogoutController;
use App\Domains\User\Http\Controllers\Auth\RefreshTokenController;
use App\Domains\User\Http\Controllers\Auth\RegisterController;
use App\Domains\User\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware(['jwt.auth','permission'])->group(function () {

    Route::get('testt', [PermissionController::class, 'sss']);
    // Groups Management Routes
    Route::apiResource('groups', controller: GroupController::class);
    Route::post('/groups/{group}/permissions', [GroupController::class, 'assignPermissions']);
    Route::post('/groups/{group}/users', [GroupController::class, 'addUsers']);

    // Permissions Management Routes
    Route::apiResource('permissions', PermissionController::class);
    Route::post('/permissions/{permission}/groups', [PermissionController::class, 'assignToGroups']);   
    
    // User Management Routes
    Route::post('/users/{user}/groups', [UserController::class, 'assignToGroup']);
    Route::post('/users/{user}/permissions', [UserController::class, 'assignPermissions']);
});

// Authentication Routes
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout']);
Route::post('/refresh', [RefreshTokenController::class, 'refresh']);




