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

```


4. Make Request
```php 
$ php artisan make:request DeskStoreRequest
```
