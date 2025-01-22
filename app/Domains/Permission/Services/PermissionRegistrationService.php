<?php

namespace App\Domains\Permission\Services;

use App\Domains\Permission\Models\Permission;
use Illuminate\Support\Facades\File;
use ReflectionClass;

class PermissionRegistrationService
{
    // List of controllers to exclude from permission registration
    protected static $excludedControllers = [
        'LoginController',
        'LogoutController',
        'RefreshTokenController',
        'RegisterController',
    ];

    // List of methods to exclude from permission registration
    protected static $excludedMethods = [
        '__construct', // Exclude constructors
        'middleware',  // Exclude middleware methods
    ];

    public static function registerPermissions()
    {
        // Define the base path for domains
        $domainsPath = app_path('Domains');

        // Get all domain folders
        $domainFolders = File::directories($domainsPath);

        // Scan controllers in the global Http/Controllers folder
        self::scanControllers(app_path('Http/Controllers'));

        // Scan controllers in each domain folder
        foreach ($domainFolders as $domainFolder) {
            $controllerPath = $domainFolder . '/Http/Controllers';
            if (File::exists($controllerPath)) {
                self::scanControllers($controllerPath);
            }
        }
    }

    protected static function scanControllers($controllerPath)
{
    // Get all controller files in the specified path
    $files = File::allFiles($controllerPath);

    foreach ($files as $file) {
        // Build the fully qualified class name
        $className = self::buildClassName($controllerPath, $file);

        if (class_exists($className)) {
            $reflection = new ReflectionClass($className);

            // Extract the controller name (without namespace)
            $controllerName = class_basename($className);

            // Remove the 'Controller' suffix if it exists
            $controllerName = preg_replace('/Controller$/', '', $controllerName);

            // Skip excluded controllers
            if (in_array($controllerName, self::$excludedControllers)) {
                continue;
            }

            foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                // Skip excluded methods
                if (in_array($method->name, self::$excludedMethods)) {
                    continue;
                }

                // Ensure the method belongs to the current controller (not a parent class)
                if ($method->class === $className && !$method->isConstructor()) {
                    // Format permission name as "ControllerName-MethodName"
                    $permissionName = "{$controllerName}-{$method->name}";

                    // Format description
                    $description = "Allows {$method->name} action on {$controllerName}";

                    // Create or update the permission
                    Permission::firstOrCreate([
                        'name' => $permissionName,
                    ], [
                        'description' => $description,
                    ]);
                }
            }
        }
    }
}

    protected static function buildClassName($controllerPath, $file)
    {
        // Determine the namespace based on the controller path
        if (strpos($controllerPath, app_path('Domains')) === 0) {
            // Domain controller
            $domainName = basename(dirname($controllerPath, 2)); // Get the domain name
            return 'App\\Domains\\' . $domainName . '\\Http\\Controllers\\' . str_replace(
                ['/', '.php'],
                ['\\', ''],
                $file->getRelativePathname()
            );
        } else {
            // Global controller
            return 'App\\Http\\Controllers\\' . str_replace(
                ['/', '.php'],
                ['\\', ''],
                $file->getRelativePathname()
            );
        }
    }
}
