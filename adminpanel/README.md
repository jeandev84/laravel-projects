1. Configuration ```.env```
```
./.env

...

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=lp_adminpanel
DB_USERNAME=postgres
DB_PASSWORD=123456

...


```


2. Create Database ```php artisan make:command db:create```

- app/Console/Commands/DatabaseCreateCommand.php

```php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DatabaseCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new MySQL database based on the database config file or the provided name';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
    */
    public function handle()
    {
        $schemaName = $this->argument('name') ?: config("database.connections.mysql.database");
        $charset = config("database.connections.mysql.charset",'utf8mb4');
        $collation = config("database.connections.mysql.collation",'utf8mb4_unicode_ci');

        config(["database.connections.mysql.database" => null]);

        $query = "CREATE DATABASE IF NOT EXISTS $schemaName CHARACTER SET $charset COLLATE $collation;";

        DB::statement($query);

        config(["database.connections.mysql.database" => $schemaName]);

    }
}


$ php artisan make:command db:create

```



3. Create models
```php 
$ php artisan make:model Post -m


<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
    */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('img');
            $table->text('text');
            $table->bigInteger('category_id')->unsigned();
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
        Schema::dropIfExists('posts');
    }
}



$ php artisan make:model Category -m

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
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
        Schema::dropIfExists('categories');
    }
}


$ php artisan migrate

```

4. Authentification 
 - https://github.com/laravel/fortify
 - https://laravel.com/docs/8.x/fortify
 - https://github.com/laravel/ui
```php 
$ composer require laravel/fortify
$ php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
$ php artisan migrate


$ composer require laravel/ui:*
$ php artisan ui bootstrap --auth

// Generate basic scaffolding...
php artisan ui bootstrap
php artisan ui vue
php artisan ui react

// Generate login / registration scaffolding...
php artisan ui bootstrap --auth
php artisan ui vue --auth
php artisan ui react --auth


$ npm install
$ npm run production

```


5. Install Laravel permission 

- https://spatie.be/docs/laravel-permission/v3/introduction
- https://github.com/spatie/laravel-permission/blob/master/config/permission.php
- https://spatie.be/docs/laravel-permission/v3/basic-usage/artisan

```php 

$ composer require spatie/laravel-permission

'providers' => [
    // ...
    Spatie\Permission\PermissionServiceProvider::class,
];

$ php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

$ php artisan optimize:clear || php artisan config:clear
 
$ php artisan migrate


Add Traits : HasRoles


<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

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



Create Role User :
php artisan permission:create-role user

Create Role Admin :
php artisan permission:create-role admin


```

6. Registration User with role 'user'

https://spatie.be/docs/laravel-permission/v3/basic-usage/middleware

```php 

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        /** @var \App\Models\User $user */
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('user');

        return $user;
    }
}


Routing :

// ???????????? ?????????? ???????????? ?? ???????? ???????????????? ???????????? ???????????????????????? ?? ?????????? 'admin'
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/test', function () {
        return view('access.demo');
    });
});


Package Middleware :

app/Http/Kernel.php


protected $routeMiddleware = [
    // ...
    'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
];

```

7. Templating Admin LTE : https://adminlte.io/

8. Create Resource Controller for admin 
```php 
$ php artisan make:controller Admin/HomeController 
$ php artisan make:controller Admin/CategoryController --resource --model=Category

```

9. Laravel elfinder (???????????????????? ???????? ?????? ??????????-????????????)
- https://github.com/barryvdh/laravel-elfinder
```php 
$ composer require barryvdh/laravel-elfinder:*

Add the ServiceProvider to the providers array in app/config/app.php
./config/app.php 

'providers' => [

    ....
    
    Barryvdh\Elfinder\ElfinderServiceProvider::class
    
    ....

];

You need to copy the assets to the public folder, using the following artisan command:
$ php artisan elfinder:publish


$ php artisan vendor:publish --provider='Barryvdh\Elfinder\ElfinderServiceProvider' --tag=config

Copied File [/vendor/barryvdh/laravel-elfinder/config/elfinder.php] To [/config/elfinder.php]
Publishing complete.


<script src="https://cdn.tiny.cloud/1/82php8bzgslrf500rugvnisjthndz5uq88crfe757v6b07ee/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script src="admin.js"></script>

<!--
<script>

    tinymce.init({
        selector: 'textarea',
        plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
        toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
    });

</script>
-->

<textarea class="editor" id="mc_e"></textared>

tinymce.init({
    selector: '.editor',
    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    toolbar_mode: 'floating',
    relative_urls : false,
    file_picker_callback : elFinderBrowser
});

function elFinderBrowser (callback, value, meta) {
    tinymce.activeEditor.windowManager.openUrl({
        title: 'File Manager',
        url: '/elfinder/tinymce5', // or "{{ route('elfinder.tinymce5') }}"
        /**
         * On message will be triggered by the child window
         *
         * @param dialogApi
         * @param details
         * @see https://www.tiny.cloud/docs/ui-components/urldialog/#configurationoptions
         */
        onMessage: function (dialogApi, details) {
            if (details.mceAction === 'fileSelected') {
                const file = details.data.file;

                // Make file info
                const info = file.name;

                // Provide file and text for the link dialog
                if (meta.filetype === 'file') {
                    callback(file.url, {text: info, title: info});
                }

                // Provide image and alt text for the image dialog
                if (meta.filetype === 'image') {
                    callback(file.url, {alt: info});
                }

                // Provide alternative source and posted for the media dialog
                if (meta.filetype === 'media') {
                    callback(file.url);
                }

                dialogApi.close();
            }
        }
    });
}


Create a directory named "files" in ./public because inside ./app/config/elfinder.php
directory where uploaded files named will be saved  named "files".

/*
|--------------------------------------------------------------------------
| Upload dir
|--------------------------------------------------------------------------
|
| The dir where to store the images (relative from public)
|
*/
'dir' => ['files'],


http://www.jacklmoore.com/colorbox/


$(document).on('click','.popup_selector',function (event) {
    event.preventDefault();
    var updateID = $(this).attr('data-inputid'); // Btn id clicked
    var elfinderUrl = '/elfinder/popup/';

    // trigger the reveal modal with elfinder inside
    var triggerUrl = elfinderUrl + updateID;
    $.colorbox({
        href: triggerUrl,
        fastIframe: true,
        iframe: true,
        width: '70%',
        height: '80%'
    });

});
// function to update the file selected by elfinder
function processSelectedFile(filePath, requestingField) {
    $('#' + requestingField).val(filePath).trigger('change');
    $('.img-uploaded').attr('src', '/' + filePath).trigger('change');
}


```
