1. Installation Vue component for working with Laravel
```php 

$ composer require laravel/ui:*
$ php artisan ui vue --auth
$ npm install && npm run dev

$ php artisan serve

Всегда собрать все компоненты чтобы все корректо отобразились 
при помощью следующей команды и лучше не завершить команду :

$ npm run watch       (building components)


Install Vuew router ( https://router.vuejs.org/guide/ )
====================================================
$ npm install vue-router@4
$ npm i vue-router

"devDependencies": {
 ...
 "vue-router": "^3.2.0"
}

```


2. Create Model 
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
            $table->string('title')->nullable();
            $table->text('body')->nullable();
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


$ php artisan migrate

```

3. Make Controller 
```php 

$ php artisan make:controller Api/v1/PostController --resource
$ php artisan route:list

```

4. Install ```axios```
```php 
$ npm i vue-axios
```


Source template :
- https://getuikit.com/docs/cover
