### Many To Many 

- Example: 
- User Has Many Roles
- Role Has Many Users
- Related Table RoleUser

```php 

$ php artisan make:model User -m (Users Table has created by default in Laravel)

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }
}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};



$ php artisan make:model Role -m 


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = "roles";


    public function users()
    {
         return $this->belongsToMany(User::class, 'role_users);
    }
}



<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}


$ php artisan make:model RoleUser -m 


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('role_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('role_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('cascade');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_users');
    }
}


$ php artisan migrate

$  php artisan make:controller Eloquent/RelationShip/ManyToMany/RoleController


<?php

namespace App\Http\Controllers\Eloquent\RelationShip\ManyToMany;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;


/**
 *
*/
class RoleController extends Controller
{

      public function addRoles()
      {
           $roles = [
               ["name" => "Administrator"],
               ["name" => "Editor"],
               ["name" => "Author"],
               ["name" => "Contributor"],
               ["name" => "Subscribers"],
           ];

           Role::insert($roles);

           return "Role are created successfully!";
      }



      public function addUser()
      {
          /*
          $user = new User();
          $user->name = "John";
          $user->email = "john@gmail.com";
          $user->password = encrypt('secret');
          $user->save();

          // 1: ID Administrator
          // 2: ID Editor
          $roleIds = [1, 2];
          */

          $user = new User();
          $user->name = "Brown";
          $user->email = "brown@gmail.com";
          $user->password = encrypt('secret');
          $user->save();

          // 2: ID Editor
          // 3: ID Author
          // 4: ID Contributor
          $roleIds = [2, 3, 4];

          $user->roles()->attach($roleIds);

          return "Record has been created successfully!";
      }



      public function getAllRolesByUserId($userId)
      {
           $user  = User::find($userId);
           $roles = $user->roles;

           return $roles;
      }


      public function getAllUsersByRoleId($roleId)
      {
          $role = Role::find($roleId);
          $users = $role->users;

          return $users;
      }
}



=====================================================================



# Eloquent RelationShip (ManyToMany)
Route::get('/add-roles', [\App\Http\Controllers\Eloquent\RelationShip\ManyToMany\RoleController::class, 'addRoles'])
    ->name('add.roles');


Route::get('/add-user-and-roles', [\App\Http\Controllers\Eloquent\RelationShip\ManyToMany\RoleController::class, 'addUser'])
    ->name('add.user.and.roles');


Route::get('/get-roles-by-user/{userId}', [\App\Http\Controllers\Eloquent\RelationShip\ManyToMany\RoleController::class, 'getAllRolesByUserId'])
    ->name('get.roles.by_user');


Route::get('/get-users-by-role/{roleId}', [\App\Http\Controllers\Eloquent\RelationShip\ManyToMany\RoleController::class, 'getAllUsersByRoleId'])
    ->name('get.roles.by_role');
    
```
