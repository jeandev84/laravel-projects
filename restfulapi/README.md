### API in Laravel

1. Make Model 
```php 
$ php artisan make:model Desk -mf
$ php artisan make:model DeskList -mf
$ php artisan make:model Task -mf
$ php artisan make:model Card -mf

```

2. Make API Controller
```php 
$ php artisan make:controller DeskController --api
```


3. Install package for authentication pages and controller in Laravel 8.x
```php 

$ composer require laravel/fortify
$ php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
$ php artisan migrate



WORK WIWTH VUE JS
=========================================

$ composer require laravel/ui:*
$ php artisan ui vue --auth
$ php artisan ui bootstrap --auth
$ npm install bootstrap
$ npm install && npm run dev

$ php artisan serve

========================================


$ composer require laravel/ui:*
$ php artisan ui bootstrap --auth
$ php artisan ui vue --auth


// Generate basic scaffolding...
php artisan ui bootstrap
php artisan ui vue
php artisan ui react

// Generate login / registration scaffolding...
php artisan ui bootstrap --auth
php artisan ui vue --auth
php artisan ui react --auth

```


4. Make Request
```php 
$ php artisan make:request DeskStoreRequest
```

5. Install Vue 

- https://laravel-mix.com/docs/6.0/vue
- 
```
$ npm i vue
$ npm install

$ npm install boostrap


(2 times lunch)
$ npm run watch
$ npm run watch


Install bootstrap

$ npm run watch
$ npm run watch

Compile


https://laravel-mix.com/docs/6.0/vue

```

```
1) composer create-project --prefer-dist laravel/laravel:^8.5 laravel-api ( курс по laravel api)
2) помогла статья Manually Setting up Vue without Using laravel/ui
3) composer require laravel/ui
4) php artisan ui vue
5) npm install && npm run dev
6) paсkage.json -> "laravel-mix": "^6.0.6", -> npm install
7) npm update vue-loader
8) npm i vue-loader
9) пробовать запустить паралельно в терминалах php artisan serve и npm run watch
10) создать компонент SpaController -> App.vue ( далее по видео) 
11) web.php -> Route::get('/{any}',[\App\Http\Controllers\SpaController::class, 'index'])->where('any','.*');
12) тестировать))

    "devDependencies": {
        "@popperjs/core": "^2.10.2",
        "axios": "^0.19",
        "bootstrap": "^5.1.3",
        "cross-env": "^7.0",
        "laravel-mix": "^6.0.6",
        "lodash": "^4.17.19",
        "resolve-url-loader": "^3.1.2",
        "sass": "^1.32.11",
        "sass-loader": "^11.0.1",
        "vue": "^2.6.12",
        "vue-loader": "^15.9.8",
        "vue-router": "^3.2.0",
        "vue-template-compiler": "^2.6.12",
        "webpack-cli": "^4.9.2"
    }
```

5. Install Vue Router
```php 
$ npm i vue-router

"devDependencies": {
    "@popperjs/core": "^2.10.2",
    "axios": "^0.19",
    "bootstrap": "^5.1.3",
    "cross-env": "^7.0",
    "laravel-mix": "^6.0.6",
    "lodash": "^4.17.19",
    "resolve-url-loader": "^3.1.2",
    "sass": "^1.32.11",
    "sass-loader": "^11.0.1",
    "vue": "^2.6.12",
    "vue-loader": "^15.9.8",
    "vue-router": "^3.2.0",
    "vue-template-compiler": "^2.6.12",
    "webpack-cli": "^4.9.2"
}
    
```

6. Vuelidate (Using for validation data in frontend)
- https://vuelidate.js.org/
- https://vuelidate.js.org/#sub-basic-usage
```php 

$ npm install vuelidate --save

```

7. Refresh migrate && Lunch seeder
```php 
$ php artisan migrate:refresh
$ php artisan db:seed
```


8. Create Resource Controller "Api/V1/DeskListController"
```php 
$ php artisan make:controller Api/V1/DeskListController --resource --api
```



Source: 
- https://getbootstrap.com/docs/4.4/getting-started/introduction/
- https://vuelidate.js.org/
