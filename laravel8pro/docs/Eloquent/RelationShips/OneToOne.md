### One To One 

- Example : One User Has Hone Phone.
```php 
$ php artisan make:model Phone -m

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
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
        Schema::dropIfExists('phones');
    }
}



<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    
    // OneToOne 
    public function phone()
    {
        return $this->hasOne(Phone::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $table = 'phones';


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


$ php artisan migrate


<?php
namespace App\Http\Controllers\Eloquent;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
       public function insertRecord(Request $request)
       {
            $phone = new Phone();
            $phone->phone = '+1234567890';

            $user = new User();
            $user->name = 'Jennifer';
            $user->email = 'jennifer@gmail.com';
            $user->password = encrypt('secret'); // Hash::make('secret');

            $user->save();
            $user->phone()->save($phone);

            return "Record has been created";
       }
}


# Eloquent RelationShip (OneToOne)
Route::get('/add-user', [\App\Http\Controllers\Eloquent\UserController::class, 'insertRecord'])
    ->name('user.insertRecord');


Route::get('/get-phone/{id}', [\App\Http\Controllers\Eloquent\UserController::class, 'fetchPhoneByUserId'])
    ->name('user.fetchByUser');
    
```
