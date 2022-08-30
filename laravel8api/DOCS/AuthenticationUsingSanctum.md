### Authentication Using Sanctum 

```php 
$ composer require laravel/sanctum:*

$ composer require laravel/sanctum
$ composer install --ignore-platform-reqs || composer update --ignore-platform-reqs

$ php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

$ php artisan migrate


<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
 
    ....

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        ...

        'api' => [
            ...
             \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            ....
        ],
    ];

    ...
}



<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;




class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}


$ php artisan make:controller Auth/AuthController

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
     public function register(Request $request)
     {
          $validator = Validator::make($request->all(), [
               'name'     => 'required',
               'email'    => 'required|email',
               'password' => 'required'
          ]);


          if ($validator->fails()) {
              return response()->json(['status_code' => 400, 'message' => 'Bad Request']);
          }

          $user           = new User();
          $user->name     = $request->name;
          $user->email    = $request->email;
          $user->password = bcrypt($request->password);
          $user->save();

          return response()->json([
              'status_code' => 200,
              'message'     => 'User created successfully!'
          ]);
     }


     public function login(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'email'    => 'required|email',
             'password' => 'required'
         ]);

         if ($validator->fails()) {
             return response()->json(['status_code' => 400, 'message' => 'Bad Request']);
         }


         $credentials = request(['email', 'password']);

         if (! Auth::attempt($credentials)) {

              return response()->json([
                   'status_code' => 500,
                   'message'     => 'Unauthorized'
              ]);

         }


         $user = User::where('email', $request->email)->first();

         $token = $user->createToken('authToken')->plainTextToken;

         return response()->json([
             'status_code'  => 200,
             'token'        => $token
         ]);

     }


     public function logout(Request $request)
     {
          $request->user()->currentAccessToken()->delete();

         return response()->json([
             'status_code'  => 200,
             'message'      => 'Token deleted successfully!'
         ]);
     }
}


# API routes version 1 :
Route::group(['prefix' => 'v1', 'middleware' => 'sanctum'], function () {
    Route::apiResources([
        'posts' => PostController::class
    ]);
});


# Auth controller
Route::group(['prefix' => 'auth'], function () {
     Route::post('/register', [AuthController::class, 'register']);
     Route::post('/login', [AuthController::class, 'login']);
     Route::post('/logout', [AuthController::class, 'logout'])
           ->middleware('sanctum');
});



```
