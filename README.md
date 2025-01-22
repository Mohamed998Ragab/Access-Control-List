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
    ```composer install
    npm install
   
3. Set up the environment:
    ```cp .env.example .env
    php artisan key:generate
   
4. Update the .env file with your database credentials.

5.Run migrations and seeders:
    ```php artisan migrate --seed
    
    
6.Generate a JWT secret:
    ```php artisan jwt:secret
    

7.Serve the application:
    ```php artisan serve
    
