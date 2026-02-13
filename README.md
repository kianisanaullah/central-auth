Central Auth — Shared Users & Roles for Laravel

A lightweight package to use a centralized users/roles database across multiple Laravel projects or subdomains.

Perfect for organizations running many apps that need:
	•	Single source of truth for users
	•	Central role management
	•	Seamless integration into new projects
	•	Optional read-only access from apps
	•	Role-based middleware

⸻

✨ Features
	•	🔐 Central users & roles from shared DB
	•	🧩 Plug-and-play integration
	•	⚙️ Fully configurable (connection, tables, columns)
	•	🧠 Works with existing Laravel Auth
	•	🛡 Role-based middleware (central.role)
	•	🔄 Environment-driven model switching
	•	🚫 No code changes required per project (if using AUTH_MODEL)

⸻

📦 Installation

1) Require package
```bash
composer require kianisanaullah/central-auth
```
2) Publish config
```bash
php artisan vendor:publish --tag=central-auth-config
php artisan optimize:clear
```
⚙️ Configuration

Add central DB connection

In your app config/database.php:
```bash
'mysql_auth' => [
    'driver' => 'mysql',
    'host' => env('AUTH_DB_HOST'),
    'port' => env('AUTH_DB_PORT', 3306),
    'database' => env('AUTH_DB_DATABASE'),
    'username' => env('AUTH_DB_USERNAME'),
    'password' => env('AUTH_DB_PASSWORD'),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'strict' => false,
],
```
Environment variables
```bash
# Enable central auth
CENTRAL_AUTH_ENABLED=true

# Use shared DB connection
CENTRAL_AUTH_SHARED_DB=true
CENTRAL_AUTH_CONNECTION=mysql_auth

# DB credentials (read-only recommended)
AUTH_DB_HOST=127.0.0.1
AUTH_DB_PORT=3306
AUTH_DB_DATABASE=central_auth
AUTH_DB_USERNAME=auth_app_test
AUTH_DB_PASSWORD=********

# Tell Laravel to use CentralUser model
AUTH_MODEL=Kiani\CentralAuth\Models\CentralUser
```



