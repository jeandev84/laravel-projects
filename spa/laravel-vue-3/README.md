### Laravel 9 + Vue-3 [ SPA (Single Page Application) ]


1. Create a new project
```
$ composer create-project laravel/laravel laravel-vue-3
$ composer create-project laravel/laravel:^9.19 laravel-vue-3
```


2. Configuration Database (.env)
```
...

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=spa_laravel
DB_USERNAME=postgres
DB_PASSWORD=123456

...

```



3. Install Vue3 + Some dependencies
```
$ npm i vue@next vue-router@next
$ npm i -D @vue/compiler-sfc vue-loader@next
$ npm install autoprefixer@10.4.5 --save-exact
```

4. Laravel/ui 
```php 
$ composer require laravel/ui:^3.4.5 || composer require laravel/ui
$ php artisan ui bootstrap
$ npm run watch || npm i && npm run development
```

