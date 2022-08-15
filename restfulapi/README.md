### REST API 

1. Create models

- https://trello.com/uk
```php 
$ php artisan make:model Desk -mf
$ php artisan make:model DeskList -mf
$ php artisan make:model Card -mf
$ php artisan make:model Task -mf

$php artisan migrate
``` 

2. Create Controller 
```php 
$ php artisan make:controller Api/DeskController --resource
```
