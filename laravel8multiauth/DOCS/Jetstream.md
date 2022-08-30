### Multiple Authentication 


1. Installation JetStream and Laravel Livewire
```php 

$ composer require laravel/jetstream:*
$ php artisan jetstream:install livewire


Inside migration file users:

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
            ...
            
             // Add new columns (User Type)
            $table->string('utype')
                 ->default('USR')
                 ->comment('ADM for Admin and USR for Normal User')
            ;

            ...
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

./.env
...

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel8multiauth
DB_USERNAME=postgres
DB_PASSWORD=123456

...

$ npm install
$ npm run watch || npm run build

$ php artisan migrate

Fix styles and scripts JetStream 
Add inside files :
 - ./resources/views/layouts/app.blade.php 
 - ./resources/views/layouts/app.blade.php 
 
{{--  @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<script src="{{ mix('js/app.js') }}"></script>

```

2. Registration new Admin & User ( via https://mydomain/register )
```
Name             : Admin
Email            : admin@gmail.com
Pasword          : password
Confirm Password : password   

============================================================

Name             : Normal User
Email            : user@gmail.com
Pasword          : password
Confirm Password : password    
