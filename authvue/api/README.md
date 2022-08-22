1. Create Laravel Project
```php 
$ composer create-project laravel/laravel:^6.4.0 api
```

2. Configuration database 
```php
$ sudo -u postgres psql -c 'create database authvue;'

... 

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=authvue
DB_USERNAME=postgres
DB_PASSWORD=123456

...

```


2. Postman 
```php 
Headers
=======================================================
Accept                  |  application/json
```


3. JWT-AUTH
- http://github.com/tymondesigns/jwt-auth
- https://jwt-auth.readthedocs.io/en/develop/
```php 
$ composer require tymon/jwt-auth:^1.0.0
$ composer require "tymon/jwt-auth 1.0.0-rc.5" | composer require tymon/jwt-auth


Publish the config 
$ php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

Generate JWT SECRET KEY
$ php artisan jwt:secret

.env
===============================================
....

JWT_SECRET=7gqSku93ByNAY1Vepk721gW21cjquw5d8mQPbzmb1oKluM9w40dFtBQu2cw2LTpE
JWT_TTL=9999999

....


```

4. Add implementation inside User Model 
```php 

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;



/**
 *
*/
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
         return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

```


5. Configuration auth (./config/auth.php)
```php 

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'api', // changed guard "web" to "api"
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'jwt', // changed driver "token" to "jwt"
            'provider' => 'users',
            'hash' => false,
        ],
    ],
    
    ....
];

```


6. Make Auth controllers (./app/Http/Controllers)
```php
$ php artisan make:controller Auth/SignInController  || Auth/LoginController
$ php artisan make:controller Auth/SignOutController || Auth/LogoutController
$ php artisan make:controller Auth/MeController      || Auth/ProfileController
```

7. Add auth routes (./routes/api.php)
```php 

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

    Route::post('signin', 'SignInController');
    Route::post('signout', 'SignOutController');

    Route::get('me', 'MeController');

});


$ php artisan route:list

+--------+----------+------------------+------+---------------------------------------------+------------+
| Domain | Method   | URI              | Name | Action                                      | Middleware |
+--------+----------+------------------+------+---------------------------------------------+------------+
|        | GET|HEAD | /                |      | Closure                                     | web        |
|        | GET|HEAD | api/auth/me      |      | App\Http\Controllers\Auth\MeController      | api        |
|        | POST     | api/auth/signin  |      | App\Http\Controllers\Auth\SignInController  | api        |
|        | POST     | api/auth/signout |      | App\Http\Controllers\Auth\SignOutController | api        |
+--------+----------+------------------+------+---------------------------------------------+------------+

```

8. Migrate tables 
```php 
$ php artisan migrate
```


9. Tinker
```php 
$ php artisan tinker

Psy Shell v0.11.8 (PHP 8.0.20 — cli) by Justin Hileman
>>> factory(App\User::class)->create(['name' => 'Yao Kouassi Jean-Claude', 'email' => 'jeanyao@ymail.com', 'password' => bcrypt('password')]);
=> App\User {#3375
     name: "Yao Kouassi Jean-Claude",
     email: "jeanyao@ymail.com",
     email_verified_at: "2022-08-22 16:27:20",
     #password: "$2y$10$ZZWJmYBsHUIC5Katw1QO0uae37vzw9nF/lXwWbkM32wC9NN5BMtgi",
     #remember_token: "WEhT3FlBHj",
     updated_at: "2022-08-22 16:27:20",
     created_at: "2022-08-22 16:27:20",
     id: 1,
   }

:...skipping...
=> App\User {#3375
     name: "Yao Kouassi Jean-Claude",
     email: "jeanyao@ymail.com",
     email_verified_at: "2022-08-22 16:27:20",
     #password: "$2y$10$ZZWJmYBsHUIC5Katw1QO0uae37vzw9nF/lXwWbkM32wC9NN5BMtgi",
     #remember_token: "WEhT3FlBHj",
     updated_at: "2022-08-22 16:27:20",
     created_at: "2022-08-22 16:27:20",
     id: 1,
   }

~

```

10. Vue JS CLI
- https://cli.vuejs.org
- https://stackoverflow.com/questions/48910876/error-eacces-permission-denied-access-usr-local-lib-node-modules
```php 
Install vue globally
$ sudo snap install vue (Linux)
$ sudo chown -R $USER /usr/local/lib
$ sudo chown -R $USER /usr/local/lib/node_modules (Give access to node_modules)
$ sudo npm install | sudo npm install -g
$ sudo npm install -g @vue/cli

==================================================
Create a new project vue-js
==================================================
$ vue create client

1. Step 1
Vue CLI v5.0.8
? Please pick a preset: 
  Default ([Vue 3] babel, eslint) 
  Default ([Vue 2] babel, eslint) 
❯ Manually select features  (CHOICE Manually

2. Step 2
Vue CLI v5.0.8
? Please pick a preset: Manually select features
? Check the features needed for your project: (Press <space> to select, <a> to toggle all, <i> to invert selection, and <enter> to proceed)
 ◉ Babel
 ◯ TypeScript
 ◯ Progressive Web App (PWA) Support
 ◉ Router   (CHOICE ROUTER) [ clavier space pour selectionner ]
❯◉ Vuex     (CHOICE Vuex + ENTER)  
 ◯ CSS Pre-processors
 ◉ Linter / Formatter
 ◯ Unit Testing
 ◯ E2E Testing

3. Step 3
Vue CLI v5.0.8
? Please pick a preset: Manually select features
? Check the features needed for your project: Babel, Router, Vuex, Linter
? Choose a version of Vue.js that you want to start the project with (Use arrow keys)
❯ 3.x 
  2.x 


4. Step 4
Vue CLI v5.0.8
? Please pick a preset: Manually select features
? Check the features needed for your project: Babel, Router, Vuex, Linter
? Choose a version of Vue.js that you want to start the project with 3.x
? Use history mode for router? (Requires proper server setup for index fallback in production) (Y/n)  Yes



5. Step 5
Vue CLI v5.0.8
? Please pick a preset: Manually select features
? Check the features needed for your project: Babel, Router, Vuex, Linter
? Choose a version of Vue.js that you want to start the project with 3.x
? Use history mode for router? (Requires proper server setup for index fallback in production) Yes
? Pick a linter / formatter config: (Use arrow keys)
❯ ESLint with error prevention only  (Enter)
  ESLint + Airbnb config 
  ESLint + Standard config 
  ESLint + Prettier 


6. Step 6
Vue CLI v5.0.8
? Please pick a preset: Manually select features
? Check the features needed for your project: Babel, Router, Vuex, Linter
? Choose a version of Vue.js that you want to start the project with 3.x
? Use history mode for router? (Requires proper server setup for index fallback in production) Yes
? Pick a linter / formatter config: Basic
? Pick additional lint features: (Press <space> to select, <a> to toggle all, <i> to invert selection, and <enter> to proceed)
❯◉ Lint on save  (ENTER)
 ◯ Lint and fix on commit


7. Step 7
Vue CLI v5.0.8
? Please pick a preset: Manually select features
? Check the features needed for your project: Babel, Router, Vuex, Linter
? Choose a version of Vue.js that you want to start the project with 3.x
? Use history mode for router? (Requires proper server setup for index fallback in production) Yes
? Pick a linter / formatter config: Basic
? Pick additional lint features: Lint on save
? Where do you prefer placing config for Babel, ESLint, etc.? (Use arrow keys)
❯ In dedicated config files  (ENTER)
  In package.json 

8. Step 8
Vue CLI v5.0.8
? Please pick a preset: Manually select features
? Check the features needed for your project: Babel, Router, Vuex, Linter
? Choose a version of Vue.js that you want to start the project with 3.x
? Use history mode for router? (Requires proper server setup for index fallback in production) Yes
? Pick a linter / formatter config: Basic
? Pick additional lint features: Lint on save
? Where do you prefer placing config for Babel, ESLint, etc.? In dedicated config files
? Save this as a preset for future projects? (y/N) Yes (ENTER)



AFTER CONFIGURATION RUN SERVER :

$ npm run serve
http://localhost:8080/

https://eslint.vuejs.org/rules/multi-word-component-names.html

```

11. Install Laravel CORS ```$ composer require fruitcake/laravel-cors```
- https://github.com/barryvdh/laravel-cors
```php 
$composer require fruitcake/laravel-cors
$ composer remove barryvdh/laravel-cors fruitcake/laravel-cors
$ composer require fruitcake/laravel-cors

To allow CORS for all your routes, add the HandleCors middleware at the top of the $middleware property of app/Http/Kernel.php class:

protected $middleware = [
  \Fruitcake\Cors\HandleCors::class,
    // ...
];

``

