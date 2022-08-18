### SPA (Single Page Application)

- https://laravel.com/docs/8.x
- https://laravel.com/docs/8.x/sanctum


1. Configuration Database environment (.env)
```php 

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=spa_blog
DB_USERNAME=postgres
DB_PASSWORD=123456

```

2. Add routes (./routes/api.php)
```php 

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::get('posts', [PostController::class, 'index']);
});


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [LoginController::class, 'index']);
    Route::delete('logout', [LogoutController::class, 'index']);
});



```


2. List routes 
```php 


$ php artisan route:list

+--------+----------+---------------------+------+------------------------------------------------------------+------------------------------------------+
| Domain | Method   | URI                 | Name | Action                                                     | Middleware                               |
+--------+----------+---------------------+------+------------------------------------------------------------+------------------------------------------+
|        | GET|HEAD | /                   |      | Closure                                                    | web                                      |
|        | POST     | api/auth/login      |      | App\Http\Controllers\Auth\LoginController@index            | api                                      |
|        | DELETE   | api/auth/logout     |      | App\Http\Controllers\Auth\LogoutController@index           | api                                      |
|        | GET|HEAD | api/user            |      | Closure                                                    | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD | api/v1/posts        |      | App\Http\Controllers\Api\V1\PostController@index           | api                                      |
|        | GET|HEAD | sanctum/csrf-cookie |      | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show | web                                      |
+--------+----------+---------------------+------+------------------------------------------------------------+------------------------------------------+

``` 

3. Install Laravel Sanctum (Authentification CSRF-COOKIE) 
```php 

$ composer require laravel/sanctum:*
$ php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
$ php artisan migrate

and then :

app/Http/Kernel.php file:

'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],


```


4. Configuration Sanctum from (./config/sanctum.php)

```php 

|--------------------------------------------------------------------------
| Stateful Domains
|--------------------------------------------------------------------------
|
| Requests from the following domains / hosts will receive stateful API
| authentication cookies. Typically, these should include your local
| and production domains which access your API via a frontend SPA.
|
*/

'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
    '%s%s',
    'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1',
    env('APP_URL') ? ','.parse_url(env('APP_URL'), PHP_URL_HOST) : ''
))),

=====================================================
Configuration Global variables (.env) add this:

SANCTUM_STATEFUL_DOMAINS=localhost,localhost:8000

OR in real server
SANCTUM_STATEFUL_DOMAINS=https://mydomain

====================================================
Make sure has this configuration in ./config/session.php 

/*
|--------------------------------------------------------------------------
| Default Session Driver
|--------------------------------------------------------------------------
|
| This option controls the default session "driver" that will be used on
| requests. By default, we will use the lightweight native driver but
| you may specify any of the other wonderful drivers provided here.
|
| Supported: "file", "cookie", "database", "apc",
|            "memcached", "redis", "dynamodb", "array"
|
*/

'driver' => env('SESSION_DRIVER', 'file'),

Make sure has this configuration variables (.env) or add this configuration :

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_DOMAIN=localhost


```

4. Configuration CORS (./config/cors.php)

```php 

<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // false

];

just set 'supports_credentials' => true

```

5. Create a user via tinker :
```php 

Psy Shell v0.11.8 (PHP 8.0.20 — cli) by Justin Hileman
>>> use App\Models\User;
>>> User::factory()->create(['email' => 'test@email.com']);
=> App\Models\User {#3581
     name: "Bryce Kiehn III",
     email: "test@email.com",
     email_verified_at: "2022-08-18 11:05:16",
     #password: "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
     #remember_token: "KxJXqSw0E3",
     updated_at: "2022-08-18 11:05:16",
     created_at: "2022-08-18 11:05:16",
     id: 1,
:


```
