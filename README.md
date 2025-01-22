# Laravel ACL System

This is a Laravel-based Access Control List (ACL) system that allows you to manage users, groups, and permissions dynamically.

## Features
- **User Management**: Register, login, and manage users.
- **Group Management**: Create groups and assign permissions.
- **Permission Management**: Dynamically register permissions for controllers and methods.
- **JWT Authentication**: Secure your API with JSON Web Tokens (JWT).

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/your-repo.git
   cd your-repo
   
2. Install dependencies:
    - composer install
    - npm install
   
3. Set up the environment:
    - cp .env.example .env
    - php artisan key:generate
   
4. Update the .env file with your database credentials.

5. Run migrations:
    - php artisan migrate --seed
    
6. Seed the Database:
    - php artisan db:seed
       - This will:

- Create an admin user and a regular user.

- Create admin and user groups.

- Register all permissions.

- Assign all permissions to the admin group.

- Assign the admin user to the admin group.

   
7. Generate a JWT secret:
    - php artisan jwt:secret
    

8. Serve the application:
    - php artisan serve


# Folder Structure
## The project follows a Domain-Driven Design (DDD) structure. Here’s an overview of the key folders and files:
- app/
- ├── Domains/
- │   ├── Group/
- │   │   ├── Http/
- │   │   │   ├── Controllers/
- │   │   │   └── Requests/
- │   │   ├── Models/
- │   │   ├── Repositories/
- │   │   └── Services/
- │   ├── Permission/
- │   │   ├── Http/
- │   │   │   ├── Controllers/
- │   │   │   └── Requests/
- │   │   ├── Models/
- │   │   ├── Repositories/
- │   │   └── Services/
- │   └── User/
- │       ├── Http/
- │       │   ├── Controllers/
- │       │   └── Requests/
- │       ├── Models/
- │       ├── Repositories/
- │       └── Services/
- ├── Http/
- │   ├── Controllers/
- │   ├── Middleware/
- │   └── Requests/
- database/
- ├── migrations/
- ├── seeders/
- routes/
- ├── api.php
- ├── web.php


# How It Works
## 1. Permission Registration
- The PermissionRegistrationService scans all controllers in the app/Domains/*/Http/Controllers and app/Http/Controllers directories.

- It extracts the controller name (removing the Controller suffix) and method name to create a permission string (e.g., Group-index).

- Permissions are stored in the permissions table.

## 2. Access Control:

- Users are assigned to groups.

- Groups are assigned permissions.

- Users inherit permissions from their groups or have his permissions.

## 3. Middleware
- The CheckPermission middleware checks if the authenticated user has the required permission to access a route.

- It constructs the permission name in the format ControllerName-MethodName and verifies it against the user’s permissions.

## 3. JWT Authentication
- The JwtMiddleware ensures that the user is authenticated and has a valid JWT token.

- Authentication endpoints include /register, /login, /logout, and /refresh.


## Endpoints
# Authentication
- POST /register: Register a new user.

- POST /login: Log in and receive a JWT token.

- POST /logout: Log out and invalidate the JWT token.

- POST /refresh: Refresh the JWT token.

# Group Management
- GET /groups: List all groups.

- POST /groups: Create a new group.

- GET /groups/{id}: Get details of a specific group.

- PUT /groups/{id}: Update a group.

- DELETE /groups/{id}: Delete a group.

- POST /groups/{group}/permissions: Assign permissions to a group.

- POST /groups/{group}/users: Add users to a group.

# Permission Management
- GET /permissions: List all permissions.

- POST /permissions: Create a new permission.

- GET /permissions/{id}: Get details of a specific permission.

- PUT /permissions/{id}: Update a permission.

- DELETE /permissions/{id}: Delete a permission.

- POST /permissions/{permission}/groups: Assign a permission to groups.

# User Management
- POST /users/{user}/groups: Assign a user to groups.

- POST /users/{user}/permissions: Assign permissions to a user.

## Default Users
## Two users are created during seeding:

## Admin User:

- **Email: admin@example.com**

- **Password: password**

- **Has all permissions**.

## Regular User:

- **Email: user@example.com**

- **Password: password**

- **Has no permissions by default**.
