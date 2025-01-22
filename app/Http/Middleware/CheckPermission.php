<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     // Get the controller and method being called
    //     $action = $request->route()->getActionName();
    //     list($controller, $method) = explode('@', $action);

    //     // Extract the controller name (without namespace)
    //     $controllerName = class_basename($controller);

    //     // Build the permission name (e.g., "UserController-index")
    //     $permissionName = "{$controllerName}-{$method}";

    //     // Get the authenticated user
    //     $user = Auth::user();

    //     // Check if the user has the required permission (directly or via groups)
    //     if (!$user || !$user->hasPermission($permissionName)) {
    //         abort(403, 'Unauthorized action.');
    //     }

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next): Response
{
    // Get the controller and method being called
    $action = $request->route()->getActionName();
    list($controller, $method) = explode('@', $action);

    // Extract the controller name (without namespace)
    $controllerName = class_basename($controller);

    // Remove the 'Controller' suffix if it exists
    $controllerName = preg_replace('/Controller$/', '', $controllerName);

    // Build the permission name (e.g., "GroupControl-index")
    $permissionName = "{$controllerName}-{$method}";

    // Get the authenticated user
    $user = Auth::user();

    // Check if the user has the required permission (directly or via groups)
    if (!$user || !$user->hasPermission($permissionName)) {
        abort(403, 'Unauthorized action.');
    }

    return $next($request);
}
}
